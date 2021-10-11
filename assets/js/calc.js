plateHtml = `<option value="">Select Plateform</option>`;
for (plateIndex in plateform) {
    plateHtml += `<option value="${plateIndex}">${plateform[plateIndex].name}</option>`;
}
$("#platform").html(plateHtml);

$("#platform").change(function(e) {
    campaignHtml = `<option value="">Select Campaign Type</option>`;
    platform = $(this).val();
    campaign = plateform[platform].campaign;

    for (campaignIndex in campaign) {
        campaignHtml += `<option value="${campaignIndex}">${campaign[campaignIndex].name}</option>`;
    }
    $("#campaign").html(campaignHtml);
});

$("#campaign").change(function(e) {
    resultHtml = `<option value="">Select Result Type</option>`;
    platform = $("#platform").val();
    campaign = $(this).val();
    results = plateform[platform]["campaign"][campaign]["result"];
    for (resultsIndex in results) {
        resultHtml += `<option value="${resultsIndex}">${results[resultsIndex].name}</option>`;
    }
    $("#result").html(resultHtml);
});

$(".calc").click(function() {
    budget = $("#budget").val();
    platform = $("#platform").val();
    campaign = $("#campaign").val();
    result = $("#result").val();
    if (budget && platform && campaign && result) {
        matric =
            plateform[platform]["campaign"][campaign]["result"][result][
                "matric"
            ];
        $("#est_from").val((matric * budget * 0.75).toFixed(2));
        $("#est_to").val((matric * budget * 1.25).toFixed(2));
    } else {
        alert("Input all point");
    }
});

$("#result").change(function() {
    budget = $("#budget").val();
    platform = $("#platform").val();
    campaign = $("#campaign").val();
    result = $("#result").val();
    if (budget && platform && campaign && result) {
        matric =
            plateform[platform]["campaign"][campaign]["result"][result][
                "matric"
            ];
        amountHtml =
            (matric * budget * 0.75).toFixed(2) +
            " ~ " +
            (matric * budget * 1.25).toFixed(2);
        $("#est_from").val((matric * budget * 0.75).toFixed(2));
        $("#est_to").val((matric * budget * 1.25).toFixed(2));
    } 
});
