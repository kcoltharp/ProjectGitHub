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
                scaleToFit: "none",
                centerStage: "none",
                resizeInstances: false,
                content: {
                    dom: [
                        {
                            id: 'E2',
                            type: 'image',
                            rect: ['83', '80', '90px', '85px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"E.png",'0px','0px']
                        },
                        {
                            id: 'D',
                            type: 'image',
                            rect: ['77', '163', '96px', '85px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"D.png",'0px','0px']
                        },
                        {
                            id: 'G',
                            type: 'image',
                            rect: ['79', '246', '97px', '89px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"G.png",'0px','0px']
                        },
                        {
                            id: 'shadow',
                            type: 'image',
                            rect: ['60', '416', '124px', '15px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"shadow.png",'0px','0px'],
                            transform: [[],[],[],['0','0']]
                        },
                        {
                            id: 'E',
                            type: 'image',
                            rect: ['77', '-90px', '90px', '85px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"E.png",'0px','0px']
                        }
                    ],
                    style: {
                        '${Stage}': {
                            isStage: true,
                            rect: ['null', 'null', '550', '440', 'auto', 'auto'],
                            overflow: 'hidden',
                            fill: ["rgba(255,255,255,1)"]
                        }
                    }
                },
                timeline: {
                    duration: 4000,
                    autoPlay: true,
                    data: [
                        [
                            "eid47",
                            "rotateZ",
                            364,
                            208,
                            "easeOutBounce",
                            "${E}",
                            '0deg',
                            '-10deg'
                        ],
                        [
                            "eid48",
                            "rotateZ",
                            572,
                            163,
                            "easeOutBounce",
                            "${E}",
                            '-10deg',
                            '0deg'
                        ],
                        [
                            "eid58",
                            "rotateZ",
                            1364,
                            208,
                            "easeOutBounce",
                            "${G}",
                            '0deg',
                            '-10deg'
                        ],
                        [
                            "eid59",
                            "rotateZ",
                            1572,
                            163,
                            "easeOutBounce",
                            "${G}",
                            '-10deg',
                            '0deg'
                        ],
                        [
                            "eid44",
                            "scaleX",
                            0,
                            1000,
                            "easeOutBounce",
                            "${shadow}",
                            '0',
                            '1'
                        ],
                        [
                            "eid60",
                            "top",
                            2000,
                            1000,
                            "easeOutBounce",
                            "${D}",
                            '-258px',
                            '163px'
                        ],
                        [
                            "eid61",
                            "rotateZ",
                            2364,
                            208,
                            "easeOutBounce",
                            "${D}",
                            '0deg',
                            '-10deg'
                        ],
                        [
                            "eid62",
                            "rotateZ",
                            2572,
                            163,
                            "easeOutBounce",
                            "${D}",
                            '-10deg',
                            '0deg'
                        ],
                        [
                            "eid64",
                            "rotateZ",
                            3364,
                            208,
                            "easeOutBounce",
                            "${E2}",
                            '0deg',
                            '-10deg'
                        ],
                        [
                            "eid65",
                            "rotateZ",
                            3572,
                            163,
                            "easeOutBounce",
                            "${E2}",
                            '-10deg',
                            '0deg'
                        ],
                        [
                            "eid63",
                            "top",
                            3000,
                            1000,
                            "easeOutBounce",
                            "${E2}",
                            '-341px',
                            '80px'
                        ],
                        [
                            "eid41",
                            "top",
                            0,
                            1000,
                            "easeOutBounce",
                            "${E}",
                            '-90px',
                            '331px'
                        ],
                        [
                            "eid45",
                            "scaleY",
                            0,
                            1000,
                            "easeOutBounce",
                            "${shadow}",
                            '0',
                            '1'
                        ],
                        [
                            "eid57",
                            "top",
                            1000,
                            1000,
                            "easeOutBounce",
                            "${G}",
                            '-175px',
                            '246px'
                        ]
                    ]
                }
            }
        };

    AdobeEdge.registerCompositionDefn(compId, symbols, fonts, scripts, resources, opts);

    if (!window.edge_authoring_mode) AdobeEdge.getComposition(compId).load("edgeTestAnimation_edgeActions.js");
})("EDGE-109228010");
