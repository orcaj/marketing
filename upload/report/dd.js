"use strict";

console.log("Loading function");

require("es6-promise").polyfill();
require("isomorphic-fetch");

const AWS = require("aws-sdk");
const docClient = new AWS.DynamoDB.DocumentClient();
const attr = require("dynamodb-data-types").AttributeValue;
const moment = require("moment");
const axios = require("axios");
const queryString = require("querystring");
const uuid = require("uuid/v1");

const uploadToDropBox = require("./dropbox");
const uploadToBoxNet = require("./box.net");

const environment = require("./environment");

let permBucketName = "";

/**
 * Handler
 * @param {*} event
 * @param {*} context
 * @param {*} callback
 */
exports.handler = (event, context, callback) => {
  event.Records.forEach((data) => {
    // check if this is deleted record
    if (data.dynamodb.NewImage === undefined) {
      console.log("deleted record ...");
      callback(null, "deleted record ...");
      return;
    }

    // transform image into readable type
    let newImage = attr.unwrap(data.dynamodb.NewImage);

    console.log("Record: " + JSON.stringify(newImage));

    // read record again to prevent repetitive execution of lambda function
    getRecord(newImage.publish_id)
      .then((res) => {
        const processStatus = record.process_status;
        const startTime = new Date();

        // process file if current status is 'queued'
        if (processStatus === "queued") {
          // compare file size and determine it should be processed here or on external app ...
          const destinationFileSize = record.file_size;

          if (destinationFileSize < environment.MAX_PROCESSING_SIZE) {
            console.log("start processing inside lambda ...");

            // go into processing
            updateRecordStatus(record, "processing")
              .then((res) => {
                // load bucket name from system_settings
                return loadSystemSetting("BR_PERM_VAULT");
              })
              .then((res) => {
                permBucketName = res;

                // retrieve project destination info
                return getProjectDestination(record.project_id);
              })
              .then((res) => {
                logAppTransaction(
                  record,
                  "964 File Publish",
                  "Retrieve project destination",
                  "Retrieved project destination info",
                  "Completed",
                  "detail"
                );

                // acquire necessary parameters
                const destinationRootPathSetting = res.find(
                  (projectSetting) =>
                    projectSetting.setting_name === "PROJECT_DESTINATION_PATH"
                );
                const destinationTypeIdSetting = res.find(
                  (projectSetting) =>
                    projectSetting.setting_name ===
                    "PROJECT_DESTINATION_TYPE_ID"
                );
                const destinationTokenSetting = res.find(
                  (projectSetting) =>
                    projectSetting.setting_name === "PROJECT_DESTINATION_TOKEN"
                );

                const destinationRootPath = destinationRootPathSetting
                  ? destinationRootPathSetting.setting_value
                  : "/";
                const destinationTypeId = destinationTypeIdSetting
                  ? destinationTypeIdSetting.setting_value
                  : "dropbox";
                const destinationToken = destinationTokenSetting
                  ? destinationTokenSetting.setting_value
                  : "";

                record.destination_sys_type_id = destinationTypeId;

                const destinationFileName = record.destination_filename;
                const destinationRelativePath = record.destination_path;
                const fileHash = record.file_id;
                const s3Bucket = permBucketName;

                let s3Key = "";
                if (destinationFileName.lastIndexOf(".") === -1) {
                  s3Key =
                    fileHash.substring(0, 2) +
                    "/" +
                    fileHash.substring(2, 3) +
                    "/" +
                    fileHash +
                    "/" +
                    fileHash;
                } else {
                  s3Key =
                    fileHash.substring(0, 2) +
                    "/" +
                    fileHash.substring(2, 3) +
                    "/" +
                    fileHash +
                    "/" +
                    fileHash +
                    destinationFileName
                      .substring(destinationFileName.lastIndexOf("."))
                      .toLowerCase();
                }

                const destinationNameNodes = destinationFileName.split("/");
                const destinationTrimedNameNodes = destinationNameNodes.map(
                  (node) => node.trim()
                );
                const destinationFullPath = `${destinationRootPath}/${destinationRelativePath}/${destinationTrimedNameNodes.join(
                  "/"
                )}`;

                let data = null;

                // download
                downloadFile(s3Bucket, s3Key)
                  .then((res) => {
                    data = res;
                    return logAppTransaction(
                      record,
                      "964 File Publish",
                      "Download file from S3",
                      "Downloaded file from permanent vault",
                      "Completed",
                      "detail"
                    );
                  })
                  .then((res) => {
                    // upload to corresponding destination system
                    switch (destinationTypeId) {
                      case "dropbox":
                        uploadToDropBox(
                          data,
                          destinationFullPath,
                          destinationToken
                        )
                          .then((res) => {
                            return logAppTransaction(
                              record,
                              "964 File Publish",
                              "Upload file to Dropbox",
                              "Uploaded file to Dropbox",
                              "Completed",
                              "summary"
                            );
                          })
                          .then((res) => {
                            processSuccess(
                              record,
                              startTime,
                              new Date(),
                              callback
                            );
                          })
                          .catch((err) => {
                            logAppTransaction(
                              record,
                              "964 File Publish",
                              "Upload file to Dropbox",
                              "Failed to upload file to Dropbox",
                              "Failed",
                              "summary"
                            ).then((res) => {
                              processFailure(
                                record,
                                startTime,
                                new Date(),
                                callback
                              );
                            });
                          });
                        break;
                      case "box.net":
                        uploadToBoxNet(
                          data,
                          destinationFileName,
                          `${destinationRootPath}/${destinationRelativePath}`.substring(
                            1
                          ),
                          destinationToken
                        )
                          .then((res) => {
                            return logAppTransaction(
                              record,
                              "964 File Publish",
                              "Upload file to Box.net",
                              "Uploaded file to Box.net",
                              "Completed",
                              "summary"
                            );
                          })
                          .then((res) => {
                            processSuccess(
                              record,
                              startTime,
                              new Date(),
                              callback
                            );
                          })
                          .catch((err) => {
                            logAppTransaction(
                              record,
                              "964 File Publish",
                              "Upload file to Box.net",
                              "Failed to upload file to Box.net",
                              "Failed",
                              "summary"
                            ).then((res) => {
                              processFailure(
                                record,
                                startTime,
                                new Date(),
                                callback
                              );
                            });
                          });
                        break;
                      default:
                        console.log("invalid destination system type!");
                        processFailure(record, startTime, new Date(), callback);
                        break;
                    }
                  })
                  .catch((err) => {
                    logAppTransaction(
                      record,
                      "964 File Publish",
                      "Download file from S3",
                      "Failed to download file from permanent vault",
                      "Failed",
                      "detail"
                    ).then((res) => {
                      processFailure(record, startTime, new Date(), callback);
                    });
                  });
              })
              .catch((err) => {
                logAppTransaction(
                  record,
                  "964 File Publish",
                  "Retrieve Project Destination",
                  "Failed to retrieve project destination info",
                  "Failed",
                  "transaction"
                ).then((res) => {
                  processFailure(record, startTime, new Date(), callback);
                });
              });
          } else {
            // this is large file, moving to fargate ...
            console.log("moving to fargate ...");
            logAppTransaction(
              record,
              "964 File Publish",
              "Large file processing",
              "Handed over to 964 external application",
              "Completed",
              "summary"
            )
              .then((res) => {
                return handleLargeFile(record);
              })
              .then((res) => {
                callback(null, "record is being processed by fargate service");
              })
              .catch((err) => {
                processFailure(record, startTime, new Date(), callback);
              });
          }
        } else {
          // current status is not 'queued', just ignore
          console.log("No need to process this record ...");
          callback(null, "record is already under processing or processed");
        }
      })
      .catch((err) => {
        console.log("Failed to read record ...");
        callback(null, "failed to read record");
      });
  });
};

/**
 * Get record with publish_id
 * @param {*} publish_id
 */
const getRecord = function (publish_id) {
  return new Promise((resolve, reject) => {
    let params = {
      TableName: environment.Tables.PUBLISH_FILES,
      Key: {
        publish_id: publish_id,
      },
    };
    docClient.get(params, function (err, data) {
      if (err) {
        console.log(err);
        reject(err);
      } else {
        if (data.Item) {
          resolve(data.Item);
        } else {
          reject();
        }
      }
    });
  });
};

/**
 * Handle large file, send request to fargate
 * @param {*} record
 */
const handleLargeFile = function (record) {
  return new Promise((resolve, reject) => {
    const partitionKey = record.publish_id;
    const params = {
      partitionKey: partitionKey,
    };

    axios
      .post(environment.LARGE_UPLOAD_API_URL, queryString.stringify(params))
      .then((res) => {
        resolve(res);
      })
      .catch((err) => {
        console.log(err);
        reject(err);
      });
  });
};

/**
 * Update record' status
 * @param {*} record
 * @param {*} status
 */
const updateRecordStatus = function (record, status) {
  return new Promise((resolve, reject) => {
    const currentDateTime = moment().format("YYYY-MM-DDTHH:mm:ss.SSSSSS") + "Z";

    let params = {
      TableName: environment.Tables.PUBLISH_FILES,
      Key: {
        publish_id: record.publish_id,
      },
      UpdateExpression:
        "set #process_status = :process_status, #edit_datetime = :edit_datetime",
      ExpressionAttributeNames: {
        "#process_status": "process_status",
        "#edit_datetime": "edit_datetime",
      },
      ExpressionAttributeValues: {
        ":process_status": status,
        ":edit_datetime": currentDateTime,
      },
    };

    docClient.update(params, (err, data) => {
      if (err) {
        console.log(err);
        reject(err);
      } else {
        resolve();
      }
    });
  });
};

/**
 * Download file from S3
 * @param {*} s3Bucket
 * @param {*} s3Key
 */
const downloadFile = function (s3Bucket, s3Key) {
  return new Promise((resolve, reject) => {
    let s3 = new AWS.S3({ apiVersion: "2006-03-01" });
    let params = {
      Bucket: s3Bucket,
      Key: s3Key,
    };

    s3.getObject(params, (err, data) => {
      if (err) {
        console.log("failed to retrieve s3 object: " + s3Key + " " + err);
        reject(err);
      } else {
        resolve(data);
      }
    });
  });
};

/**
 * Process success status
 * @param {*} record
 * @param {*} startTime
 * @param {*} endTime
 * @param {*} callback
 */
const processSuccess = function (record, startTime, endTime, callback) {
  let userData = null;

  retrieveUserInfo(record.submitter_email)
    .then((res) => {
      userData = res;
      return createPublishedDocumentRecord(
        record,
        "completed",
        userData,
        startTime,
        endTime
      );
    })
    .then((res) => {
      logAppTransaction(
        record,
        "964 File Publish",
        "Create document published record",
        "Created project document published record",
        "Completed",
        "detail"
      );

      // mark record status to completed
      const partitionKey = record.publish_id;
      const currentDateTime =
        moment().format("YYYY-MM-DDTHH:mm:ss.SSSSSS") + "Z";

      let params = {
        TableName: environment.Tables.PUBLISH_FILES,
        Key: {
          publish_id: partitionKey,
        },
        UpdateExpression:
          "set #process_status = :process_status, #edit_datetime = :edit_datetime",
        ExpressionAttributeNames: {
          "#process_status": "process_status",
          "#edit_datetime": "edit_datetime",
        },
        ExpressionAttributeValues: {
          ":process_status": "completed",
          ":edit_datetime": currentDateTime,
        },
      };

      console.log("updating status as completed ... ");
      docClient.update(params, function (err, data) {
        if (err) {
          console.log("status update failed ...");
        }
        callback(null, "finalized publish");
      });
    })
    .catch((err) => {
      console.log(err);
      processFailure(record, startTime, endTime, callback);
    });
};

/**
 * Process failure status
 * @param {*} record
 * @param {*} startTime
 * @param {*} endTime
 * @param {*} callback
 */
const processFailure = function (record, startTime, endTime, callback) {
  const attempts = record.process_attempts + 1;
  const newStatus =
    attempts < environment.MAX_ATTEMPTS_COUNT ? "queued" : "errored";

  // mark record status to 'queued' again with attempts count increment, or 'errored' if already exceeded max retry
  console.log("updating count of attempts to " + attempts.toString());
  const partitionKey = record.publish_id;
  const currentDateTime = moment().format("YYYY-MM-DDTHH:mm:ss.SSSSSS") + "Z";

  let params = {
    TableName: environment.Tables.PUBLISH_FILES,
    Key: {
      publish_id: partitionKey,
    },
    UpdateExpression:
      "set #process_status = :process_status, #edit_datetime = :edit_datetime, #process_attempts = :process_attempts",
    ExpressionAttributeNames: {
      "#process_status": "process_status",
      "#edit_datetime": "edit_datetime",
      "#process_attempts": "process_attempts",
    },
    ExpressionAttributeValues: {
      ":process_status": newStatus,
      ":edit_datetime": currentDateTime,
      ":process_attempts": attempts,
    },
  };

  docClient.update(params, function (err, data) {
    if (err) {
      console.log("status update failed ...");
    }
    callback(null, "failed to publish");
  });
};

/**
 * Retrieve user info
 * @param {*} user_email
 */
const retrieveUserInfo = function (user_email) {
  return new Promise((resolve, reject) => {
    axios
      .get(`${process.env.BR_API_ENDPOINT}/GetUser`, {
        params: {
          user_email: user_email,
          detail_level: "basic",
        },
      })
      .then((res) => {
        if (res.status === 200) {
          if (Array.isArray(res.data)) {
            resolve(res.data[0]);
          } else {
            resolve(res.data);
          }
        } else {
          reject(res.data);
        }
      })
      .catch((err) => {
        reject(err);
      });
  });
};

/**
 * Log app transaction
 * @param {*} record
 * @param {*} function_name
 * @param {*} operation_name
 * @param {*} operation_description
 * @param {*} operation_status
 * @param {*} transaction_level
 */
const logAppTransaction = function (
  record,
  function_name,
  operation_name,
  operation_description,
  operation_status,
  transaction_level
) {
  return new Promise((resolve, reject) => {
    let params = {
      submission_id: record.submission_id,
      routine_name: "964 publish files",
      function_name: function_name,
      project_id: record.project_id,
      file_id: record.file_id,
      operation_name: operation_name,
      operation_datetime: moment().format("YYYY-MM-DDTHH:mm:ss.SSSSSS") + "Z",
      operation_status: operation_status,
      operation_status_desc: operation_description,
      transaction_level: transaction_level,
    };

    axios
      .post(
        `${process.env.BR_API_ENDPOINT}/LogAppOpp`,
        queryString.stringify(params)
      )
      .then((res) => {
        resolve(res);
      })
      .catch((err) => {
        reject(err);
      });
  });
};

/**
 * Create published document record
 * @param {*} record
 * @param {*} process_status
 * @param {*} user
 * @param {*} upload_starttime
 * @param {*} upload_endtime
 */
const createPublishedDocumentRecord = function (
  record,
  process_status,
  user,
  upload_starttime,
  upload_endtime
) {
  return new Promise((resolve, reject) => {
    getDocument(record.doc_id)
      .then((document) => {
        let params = {
          doc_id: record.doc_id,
          file_id: record.file_id,
          project_id: record.project_id,
          customer_id: user.customer_id || "not available",
          customer_name: user.customer_name || "not available",
          submitter_id: user.user_id,
          project_name: record.project_name,
          submission_id: record.submission_id,
          submission_datetime: record.publish_datetime,
          destination_sys_type_id: record.destination_sys_type_id,
          destination_name: record.destination_sys_type_id,
          destination_url: "<DESTINATION_URL>",
          destination_username: "<DESTINATION_USERNAME>",
          destination_folder_path: record.destination_path,
          destination_file_name: record.destination_filename,
          publish_datetime:
            moment(upload_endtime).format("YYYY-MM-DDTHH:mm:ss.SSSSSS") + "Z",
          publish_status: process_status,
          destination_file_size: record.file_size,
          destination_transfer_time: moment(upload_endtime).diff(
            moment(upload_starttime),
            "ms"
          ),
          file_original_filename: record.file_original_filename,
          doc_name: document ? document.doc_name : "",
          doc_number: document ? document.doc_number : "",
          doc_revision: document ? document.doc_revision : "",
          bucket_name: permBucketName,
          doc_discipline: "<DOC_DISCIPLINE>",
          status: "active",
        };

        return axios.post(
          `${process.env.BR_API_ENDPOINT}/CreatePublishedDocument`,
          queryString.stringify(params)
        );
      })
      .then((res) => {
        resolve();
      })
      .catch((err) => {
        reject(err);
      });
  });
};

/**
 * Get document info
 * @param {*} doc_id
 */
const getDocument = function (doc_id) {
  return new Promise((resolve, reject) => {
    axios
      .get(`${process.env.BR_API_ENDPOINT}/GetDocument?doc_id=${doc_id}`)
      .then((res) => {
        resolve(res.data[0]);
      })
      .catch((err) => {
        console.log(err);
        reject(err);
      });
  });
};

/**
 * Get project destination info from project settings
 * @param {*} project_id
 */
const getProjectDestination = function (project_id) {
  return new Promise((resolve, reject) => {
    axios
      .get(
        `${process.env.BR_API_ENDPOINT}/GetProjectSettings?project_id=${project_id}`
      )
      .then((res) => {
        resolve(Array.isArray(res.data) ? res.data : [res.data]);
      })
      .catch((err) => {
        console.log(err);
        reject(err);
      });
  });
};

/**
 * Load system setting with given id
 * @param {*} system_setting_id
 */
const loadSystemSetting = function (system_setting_id) {
  return new Promise((resolve, reject) => {
    axios
      .get(
        `${process.env.BR_API_ENDPOINT}/GetSystemSettings?system_setting_id=${system_setting_id}`
      )
      .then((res) => {
        resolve(res.data.setting_value);
      })
      .catch((err) => {
        console.log(err);
        reject(err);
      });
  });
};

/**
 * Update project/submission status/message
 * @param {*} project_id
 * @param {*} submission_id
 * @param {*} process_status
 * @param {*} process_message
 */
const updateProjectStatus = function (
  project_id,
  submission_id,
  process_status,
  process_message
) {
  return Promise.all([
    axios.post(
      `${process.env.BR_API_ENDPOINT}/UpdateProject`,
      queryString.stringify({
        search_project_id: project_id,
        project_process_status: process_status,
        project_process_message: process_message,
      })
    ),
    axios.post(
      `${process.env.BR_API_ENDPOINT}/UpdateProjectSubmission`,
      queryString.stringify({
        search_project_submission_id: submission_id,
        submission_process_status: process_status,
        submission_process_message: process_message,
      })
    ),
  ]);
};
