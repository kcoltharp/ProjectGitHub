jQuery(document).ready(function($) {
	var mapTypeId = wundermap.getMapTypeId("ter");
	var googlemap = new google.maps.Map($("#map")[0], {
		center: new google.maps.LatLng(33.338657, -79.295837),
		zoom: 11,
		mapTypeId: mapTypeId,
		mapTypeControl: true,
		mapTypeControlOptions: {
		style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
		},
		panControlOptions: {
		position: google.maps.ControlPosition.LEFT_TOP
		},
		scaleControl: true,
		scrollwheel: true,
		streetViewControl: false,
		zoomControlOptions: {
		position: google.maps.ControlPosition.LEFT_TOP,
		style: ($("#map").height() > 740) ? google.maps.ZoomControlStyle.DEFAULT : google.maps.ZoomControlStyle.SMALL
		}
	});
	wundermap.setOptions({
		map: googlemap,
		refreshPeriod: 60000,
		units: "english",
		debug: 0,
		source: "wxmap",
		StreetsOverlay: true,
		layers: [
		{
		layer: "WeatherStations",
		active: "off",
		//clickable: false,
		mode: "temp"
		},
		{
		layer: "Radar",
		active: "on",
		opacity: 70,
		type: "N0R",
		type2: "",
		animation: {
		num: 6,
		max: 6,
		delay: 25
		},
		stormtracks: "off",
		smooth: "on",
		subdomain: "radblast"
		},
		{
		layer: "Satellite",
		defaultUI: 0,
		opacity: "85",
		source: "",
		active: "off",
		animation: {
		num: 1,
		max: 8,
		delay: 25
		}
		},
		{
		layer: "Webcams",
		defaultUI: 1,
		active: "off"
		},
		{
		layer: "Severe",
		defaultUI: 0,
		active: "off",
		opacity: "70"
		},
		{
		layer: "Tornado",
		defaultUI: 1,
		active: "off",
		//show: "now"
		show: "now"
		}
		],
		top: "",
		pin: {
		title: "",
		lat: "33.338657",
		lon: "-79.295837",
		type: ""
		},
		linkToThisPage: {
		rawlink: "#linkToThisPage",
		rawlink_input: "#linkToThisPageInput",
		panel: {
		button: "#linkButton",
		panel: "#linkPanel",
		shortlink: "#miniLinkToThisPage",
		shortlink_input: "#miniLinkToThisPageInput",
		fb_share: "#fb_share"
		}
		}
	});
	wundermap.initialize();
	// YAZ 20120423 - Chrome packaged app combined with big picture mode
	if ($("#appbutton")[0]) {
		// padding between the AppButton and pan/zoom control
		wundermap.addHTMLControl({
		controlText: "",
		index: -1,
		position: google.maps.ControlPosition.LEFT_TOP,
		styles: {
		width: "30px",
		height: $("#appbutton").outerHeight()
		}
		});
	}
});