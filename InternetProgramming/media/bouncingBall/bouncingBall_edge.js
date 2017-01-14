/*jslint */
/*global AdobeEdge: false, window: false, document: false, console:false, alert: false */
(function (compId) {

    "use strict";
    var im='images/',
        aud='media/',
        vid='media/',
        js='js/',
        fonts = {
        },
        opts = {
            'gAudioPreloadPreference': 'auto',
            'gVideoPreloadPreference': 'auto'
        },
        resources = [
        ],
        scripts = [
        ],
        symbols = {
            "stage": {
                version: "5.0.1",
                minimumCompatibleVersion: "5.0.0",
                build: "5.0.1.386",
                scaleToFit: "both",
                centerStage: "horizontal",
                resizeInstances: false,
                content: {
                    dom: [
                        {
                            id: 'Ellipse',
                            type: 'ellipse',
                            rect: ['212px', '380px', '22px', '20px', 'auto', 'auto'],
                            borderRadius: ["50%", "50%", "50%", "50%"],
                            fill: ["rgba(245,33,33,1.00)"],
                            stroke: [0,"rgba(0,0,0,1)","none"]
                        }
                    ],
                    style: {
                        '${Stage}': {
                            isStage: true,
                            rect: [undefined, undefined, '550px', '400px'],
                            overflow: 'hidden',
                            fill: ["rgba(151,205,233,1.00)"]
                        }
                    }
                },
                timeline: {
                    duration: 4000,
                    autoPlay: true,
                    data: [
                        [
                            "eid3",
                            "left",
                            0,
                            1000,
                            "linear",
                            "${Ellipse}",
                            '200px',
                            '0px'
                        ],
                        [
                            "eid6",
                            "left",
                            1000,
                            1000,
                            "linear",
                            "${Ellipse}",
                            '0px',
                            '282px'
                        ],
                        [
                            "eid7",
                            "left",
                            2000,
                            1000,
                            "linear",
                            "${Ellipse}",
                            '282px',
                            '528px'
                        ],
                        [
                            "eid10",
                            "left",
                            3000,
                            1000,
                            "linear",
                            "${Ellipse}",
                            '528px',
                            '212px'
                        ],
                        [
                            "eid4",
                            "top",
                            0,
                            1000,
                            "linear",
                            "${Ellipse}",
                            '380px',
                            '214px'
                        ],
                        [
                            "eid5",
                            "top",
                            1000,
                            1000,
                            "linear",
                            "${Ellipse}",
                            '214px',
                            '0px'
                        ],
                        [
                            "eid8",
                            "top",
                            2000,
                            1000,
                            "linear",
                            "${Ellipse}",
                            '0px',
                            '172px'
                        ],
                        [
                            "eid9",
                            "top",
                            3000,
                            1000,
                            "linear",
                            "${Ellipse}",
                            '172px',
                            '380px'
                        ]
                    ]
                }
            }
        };

    AdobeEdge.registerCompositionDefn(compId, symbols, fonts, scripts, resources, opts);

    if (!window.edge_authoring_mode) AdobeEdge.getComposition(compId).load("bouncingBall_edgeActions.js");
})("EDGE-8272906");
