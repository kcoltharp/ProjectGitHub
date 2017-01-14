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
                            rect: ['83', '-339', '90px', '85px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"E.png",'0px','0px']
                        },
                        {
                            id: 'D',
                            type: 'image',
                            rect: ['77', '-256', '96px', '85px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"D.png",'0px','0px']
                        },
                        {
                            id: 'G',
                            type: 'image',
                            rect: ['79', '-173', '97px', '89px', 'auto', 'auto'],
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
                            rect: ['77', '-88', '90px', '85px', 'auto', 'auto'],
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
                            "eid42",
                            "rotateZ",
                            363,
                            207,
                            "easeOutBounce",
                            "${E}",
                            '0deg',
                            '-10deg'
                        ],
                        [
                            "eid43",
                            "rotateZ",
                            571,
                            166,
                            "easeOutBounce",
                            "${E}",
                            '-10deg',
                            '0deg'
                        ],
                        [
                            "eid49",
                            "rotateZ",
                            1363,
                            207,
                            "easeOutBounce",
                            "${G}",
                            '0deg',
                            '-10deg'
                        ],
                        [
                            "eid50",
                            "rotateZ",
                            1571,
                            166,
                            "easeOutBounce",
                            "${G}",
                            '-10deg',
                            '0deg'
                        ],
                        [
                            "eid45",
                            "scaleX",
                            0,
                            1000,
                            "easeOutBounce",
                            "${shadow}",
                            '0',
                            '1'
                        ],
                        [
                            "eid51",
                            "top",
                            2000,
                            1000,
                            "easeOutBounce",
                            "${D}",
                            '-256px',
                            '163px'
                        ],
                        [
                            "eid52",
                            "rotateZ",
                            2363,
                            207,
                            "easeOutBounce",
                            "${D}",
                            '0deg',
                            '-10deg'
                        ],
                        [
                            "eid53",
                            "rotateZ",
                            2571,
                            166,
                            "easeOutBounce",
                            "${D}",
                            '-10deg',
                            '0deg'
                        ],
                        [
                            "eid55",
                            "rotateZ",
                            3363,
                            207,
                            "easeOutBounce",
                            "${E2}",
                            '0deg',
                            '-10deg'
                        ],
                        [
                            "eid56",
                            "rotateZ",
                            3571,
                            166,
                            "easeOutBounce",
                            "${E2}",
                            '-10deg',
                            '0deg'
                        ],
                        [
                            "eid47",
                            "scaleY",
                            0,
                            1000,
                            "easeOutBounce",
                            "${shadow}",
                            '0',
                            '1'
                        ],
                        [
                            "eid40",
                            "top",
                            0,
                            1000,
                            "easeOutBounce",
                            "${E}",
                            '-88px',
                            '331px'
                        ],
                        [
                            "eid54",
                            "top",
                            3000,
                            1000,
                            "easeOutBounce",
                            "${E2}",
                            '-339px',
                            '80px'
                        ],
                        [
                            "eid48",
                            "top",
                            1000,
                            1000,
                            "easeOutBounce",
                            "${G}",
                            '-173px',
                            '246px'
                        ]
                    ]
                }
            }
        };

    AdobeEdge.registerCompositionDefn(compId, symbols, fonts, scripts, resources, opts);

    if (!window.edge_authoring_mode) AdobeEdge.getComposition(compId).load("edgeTestAnimation-byPC_edgeActions.js");
})("EDGE-109228010");
