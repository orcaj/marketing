variable = {
    impressions: {
        snapchat: 8,
        snapchatNonSkip: 27.3,
        twitter: 9,
        instagram: 7,
        facebook: 7,
        youtube: 14,
        youtubeBumper: 11,
        linkedin: 94,
        googleDisplay: 4,
        tiktok: 8
    },
    voice:{
        sms:0.044,
    },
    sms:{
        sms:0.06
    },
    engagement: {
        twitter: 0.1,
        instagram: 0.35,
        facebook: 0.35
    },
    swipeUps:{
        snapchat: 0.8
    },
    videoView:{
        snapchat:0.156,
        twitter:0.02,
        instagram:0.2,
        facebook:0.2,
        youtube:0.07,
        tiktok:0.15
    },
    followers:{
        twitter:3
    },
    traffic:{
        instagram:2,
        facebook:2,
        youtube:1,
        linkedin:15,
        twitter:1.26,
        google_search:1,
        google_display:1,
        tiktok:1
    },
    appInstall:{
        snapchat:7,
        instagram:6.5,
        facebook:6.5,
        twitter:6,
        google_app:8,
        tiktok:7
    }
};

plateform = {
    google: {
        name: "Google",
        campaign: {
            search_traffic: {
                name: "Google Search | Traffic",
                result: {
                    visit: {
                        name: "Visit",
                        matric: 1 / variable.traffic.google_search
                    }
                }
            },
            display_traffic: {
                name: "Google Display | Traffic",
                result: {
                    visit: {
                        name: "Visit",
                        matric: 1 / variable.traffic.google_search
                    }
                }
            },
            display_awareness: {
                name: "Google Display | Awareness",
                result: {
                    visit: {
                        name: "Impression",
                        matric: 1000 / variable.impressions.googleDisplay
                    }
                }
            },
            app_installs: {
                name: "App Installs",
                result: {
                    visit: {
                        name: "Impression",
                        matric: 1 / variable.appInstall.google_app
                    }
                }
            },
            youtube: {
                name: "Youtube",
                result: {
                    impression: {
                        name: "impression",
                        matric: 1000 / variable.impressions.youtube
                    },
                    video_views: {
                        name: "Video Views",
                        matric: 1 / variable.videoView.youtube
                    },
                    traffic: {
                        name: "Traffic",
                        matric: 1 / variable.traffic.youtube
                    }
                }
            },
            youtube_bumper: {
                name: "YouTube Bumper",
                result: {
                    impression: {
                        name: "impression",
                        matric: 1000 / variable.impressions.youtubeBumper
                    }
                }
            }
        }
    },
    snapchat: {
        name: "Snapchat",
        campaign: {
            awareness: {
                name: "Awareness",
                result: {
                    impression: {
                        name: "impression",
                        matric: 1000 / variable.impressions.snapchat
                    }
                }
            },
            non_skip: {
                name: `Snapchat "Non-Skippable" | Awareness`,
                result: {
                    impression: {
                        name: "impression",
                        matric: 1000 / variable.impressions.snapchatNonSkip,
                    }
                }
            },
            traffic: {
                name: "Traffic",
                result: {
                    swipe_ups: {
                        name: "Swipe Ups",
                        matric: 1 / variable.swipeUps.snapchat,
                    }
                }
            },
            video_views: {
                name: "Video Views",
                result: {
                    views: {
                        name: "views",
                        matric: 1 / variable.videoView.snapchat
                    }
                }
            },
            app_installs: {
                name: "App Installs",
                result: {
                    installs: {
                        name: "installs",
                        matric: 1 / variable.appInstall.snapchat
                    },
                }
            },
        }
    },
    twitter: {
        name: "Twitter",
        campaign: {
            awareness: {
                name: "Awareness",
                result: {
                    impression: {
                        name: "impression",
                        matric: 1000 / variable.impressions.twitter
                    }
                }
            },
            traffic: {
                name: "Traffic",
                result: {
                    clicks: {
                        name: "clicks",
                        matric: 1 / variable.traffic.twitter,
                    }
                }
            },
            video_views: {
                name: "Video Views",
                result: {
                    views: {
                        name: "views",
                        matric: 1 / variable.videoView.twitter
                    }
                }
            },
            engagement: {
                name: "Engagement",
                result: {
                    engagement: {
                        name: "Engagement",
                        matric: 1 / variable.engagement.twitter
                    }
                }
            },
            followers: {
                name: "Followers",
                result: {
                    followers: {
                        name: "followers",
                        matric: 1 / variable.followers.twitter
                    }
                }
            },
            app_installs: {
                name: "App Installs",
                result: {
                    installs: {
                        name: "installs",
                        matric: 1 / variable.appInstall.twitter
                    },
                }
            },
        }
    },

    instagram: {
        name: "instagram",
        campaign: {
            awareness: {
                name: "Awareness",
                result: {
                    impression: {
                        name: "impression",
                        matric: 1000 / variable.impressions.instagram
                    }
                }
            },
            traffic: {
                name: "Traffic",
                result: {
                    clicks: {
                        name: "clicks",
                        matric: 1 / variable.traffic.instagram,
                    }
                }
            },
            video_views: {
                name: "Video Views",
                result: {
                    views: {
                        name: "views",
                        matric: 1 / variable.videoView.instagram
                    }
                }
            },
            engagement: {
                name: "Engagement",
                result: {
                    engagement: {
                        name: "Engagement",
                        matric: 1 / variable.engagement.instagram
                    }
                }
            },
            app_installs: {
                name: "App Installs",
                result: {
                    installs: {
                        name: "installs",
                        matric: 1 / variable.appInstall.instagram
                    },
                }
            },
        }
    },

    facebook: {
        name: "Facebook",
        campaign: {
            awareness: {
                name: "Awareness",
                result: {
                    impression: {
                        name: "impression",
                        matric: 1000 / variable.impressions.facebook
                    }
                }
            },
            traffic: {
                name: "Traffic",
                result: {
                    clicks: {
                        name: "clicks",
                        matric: 1 / variable.traffic.facebook,
                    }
                }
            },
            video_views: {
                name: "Video Views",
                result: {
                    views: {
                        name: "views",
                        matric: 1 / variable.videoView.facebook
                    }
                }
            },
            engagement: {
                name: "Engagement",
                result: {
                    engagement: {
                        name: "Engagement",
                        matric: 1 / variable.engagement.facebook
                    }
                }
            },
            app_installs: {
                name: "App Installs",
                result: {
                    installs: {
                        name: "installs",
                        matric: 1 / variable.appInstall.facebook
                    },
                }
            },
        }
    },

    linkedin: {
        name: "LinkedIn",
        campaign: {
            awareness: {
                name: "Awareness",
                result: {
                    impression: {
                        name: "impression",
                        matric: 1000 / variable.impressions.linkedin
                    }
                }
            },
            traffic: {
                name: "Traffic",
                result: {
                    clicks: {
                        name: "clicks",
                        matric: 1 / variable.traffic.linkedin,
                    }
                }
            }
        }
    },

    tiktok: {
        name: "TikTok",
        campaign: {
            awareness: {
                name: "Awareness",
                result: {
                    impression: {
                        name: "impression",
                        matric: 1000 / variable.impressions.tiktok
                    }
                }
            },
            traffic: {
                name: "Traffic",
                result: {
                    clicks: {
                        name: "clicks",
                        matric: 1 / variable.traffic.tiktok,
                    }
                }
            },
            video_views: {
                name: "Video Views",
                result: {
                    views: {
                        name: "views",
                        matric: 1 / variable.videoView.tiktok
                    }
                }
            },
            app_installs: {
                name: "App Installs",
                result: {
                    installs: {
                        name: "installs",
                        matric: 1 / variable.appInstall.tiktok
                    },
                }
            },
        }
    },

    sms: {
        name: "SMS",
        campaign: {
            voice: {
                name: "Voice Messages",
                result: {
                    default: {
                        name: "default",
                        matric: 1 / variable.voice.sms
                    }
                }
            },
            text: {
                name: "Text Messages",
                result: {
                    default: {
                        name: "default",
                        matric: 1 / variable.sms.sms,
                    }
                }
            }
        }
    },
};
