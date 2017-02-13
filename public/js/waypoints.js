$(function() {

	if($(".waypoints-map").length > 0) {
		getWaypoints(function(waypoints) {
			initWaypoints(waypoints);
		});
	}

	$("#saveWaypointButton").on("click", function() {
		saveWaypoint({
			id: $("#waypointId").val(),
			title:$("#waypointTitle").val(),
			lat: $("#waypointLat").val(),
			lng: $("#waypointLng").val(),
			type: ($("#waypointType").prop("checked")) ? 1 : 0
		});
	});

	$("#removeWaypointButton").on("click", function() {

		msgConfirm({
			title : '<span class="red">'+
					'<i class="glyphicon glyphicon-exclamation-sign"></i>'+
					'</span> Իսկապես ջնջել?',
			content : "Ջնջելու դեպքում այս կետը <strong>անվերադարձ</strong> կհեռացվի որպես բոլոր երթուղիներից:",
			onYes : function() {
				removeWaypoint(waypoints[activeWaypoint]);
			}
		})

	});

});

/************************************************************
*						Functions
************************************************************/


function saveWaypoint(waypointData) {


	var URL = admURL+'?ajaxUpdateWaypoint';

	$.ajax({ 
		type: 'GET', 
		url: URL, 
		dataType: 'json',
		data: {
			id : waypointData.id,
			title : waypointData.title,
			lat : waypointData.lat,
			lng : waypointData.lng,
			type : waypointData.type,
		},
		success: function (result) {
			// alert('saved!');
			waypoints[activeWaypoint].details.id = result;
			waypoints[activeWaypoint].details.type = waypointData.type;
			waypoints[activeWaypoint].details.unsaved = false;

			setWaypointIcon(waypoints[activeWaypoint]);

			msgBox({
				title : "Տվյալները պահպանված են"
			});
		},
		error: function(result){
			console.log("ERROR on "+URL+"\nOutPut result is \n'"+result.responseText+"'");
		}
	});
}

function getWaypoints(callback) {
	var URL = htmURL+'?ajaxGetWaypoints';

	$.ajax({ 
		type: 'GET', 
		url: URL, 
		dataType: 'json',
		success: function (json) {
			callback(json);
		},
		error: function(result){
			console.log("ERROR on "+URL+"\nOutPut result is \n'"+result.responseText+"'");
		}
	});
}

function initWaypoints(waypoints) {

	// Display waypoints on map
	for (var i in waypoints) {
		addWaypointMarker(waypoints[i]);
	}

	// Add waypoints on map click
	GMaps.on('click', map.map, function(event) {
	    addWaypointMarker({
	    	id : '',
	    	lat : event.latLng.lat(),
	    	lng : event.latLng.lng(),
	    	title : '',
	    	type : 1,
	    });
	});

}


var waypoints = [],
	activeWaypointPrev = null,
	activeWaypoint = null;

function addWaypointMarker(waypoint) {

	var draggable = ($("#routeEditorForm").length == 0) ? true : false;

		// $("#routeEditorForm").hide();
		// console.log(draggable);

	var waypoint = map.addMarker({
		lat: waypoint.lat,
		lng: waypoint.lng,
		draggable: draggable,
		title: waypoint.title,
		details : {
    		id : waypoint.id,
			type : waypoint.type,
			unsaved : false,
			gmId : false,
		}
    });

    var gmId =  waypoint.__gm_id;
    waypoint.details.gmId = gmId;

    waypoints[gmId] = waypoint;

    // if(isset(callback)) {
    // callback(waypoints[gmId]);	
    // }


    bindWaypointEvents(waypoints[gmId]);
    setWaypointIcon(waypoints[gmId]);
}

function bindWaypointEvents(waypoint) {

	google.maps.event.addListener(waypoint, 'click', function() {

		activeWaypoint = waypoint.details.gmId;
		switchIcons();
		
    	loadWaypointToEditor({
    		id: waypoint.details.id,
    		title: waypoint.title,
    		lat : waypoint.position.lb,
    		lng : waypoint.position.mb,
    		type : waypoint.details.type
    	});
	});

	google.maps.event.addListener(waypoint, 'dragstart', function() {
		activeWaypoint = waypoint.details.gmId;
		switchIcons();
	});

	google.maps.event.addListener(waypoint, 'dragend', function() {
		loadWaypointToEditor({
    		id: waypoint.details.id,
    		title: waypoint.title,
    		lat : waypoint.position.lb,
    		lng : waypoint.position.mb,
    		type : waypoint.details.type
    	});

    	waypoints[activeWaypoint].details.unsaved = true;
	});

	// google.maps.event.addListener(waypoint, 'drag', function() {
 //    	loadWaypointToEditor({
 //    		id: waypoint.details.id,
 //    		title: waypoint.title,
 //    		lat : waypoint.position.lb,
 //    		lng : waypoint.position.mb,
 //    		type : waypoint.details.type
 //    	});
	// });

	google.maps.event.addListener(waypoint, 'rightclick', function() {
		if(waypoint.details.id=='') {
			removeWaypoint(waypoint);
		}
	});
}

function switchIcons() {
	// If active point has change
	if(activeWaypoint!=activeWaypointPrev) {

		if(activeWaypoint) {
			setWaypointIcon(waypoints[activeWaypoint]);
		}

		if(activeWaypointPrev) {
			setWaypointIcon(waypoints[activeWaypointPrev]);
		}

		activeWaypointPrev = activeWaypoint;
	}
}


// icon: "http://maps.google.com/mapfiles/marker.png",
// icon: "http://maps.google.com/mapfiles/marker_green.png",
// http://maps.google.com/mapfiles/ms/micons/orange-dot.png
// http://maps.google.com/mapfiles/ms/micons/blue-dot.png

function setWaypointsIcons() {
	// console.log('setWaypointIcon');

	for(var i in waypoints) {
		setWaypointIcon(waypoints[i]);
	}
}

function setWaypointIcon(waypoint) {

	var icon;

	if( isset(waypoint.details.gmId) && waypoint.details.gmId == activeWaypoint) {
		icon = "http://maps.google.com/mapfiles/marker.png";
	}
	// If is unsaved waypoint
	else if (waypoint.details.id=='') {
		// icon = "http://mapicons.nicolasmollet.com/wp-content/uploads/mapicons/shape-default/color-ff8a22/shapecolor-color/shadow-1/border-dark/symbolstyle-white/symbolshadowstyle-dark/gradient-no/orienteering.png";
		icon = "http://maps.google.com/intl/en_us/mapfiles/ms/micons/orange.png";
	}
	else if(waypoint.details.unsaved) {
		icon = "http://maps.google.com/intl/en_us/mapfiles/ms/micons/red.png";
	}
	// If is bus stop
	else if(waypoint.details.type == 1) {
		icon = "http://maps.google.com/mapfiles/ms/micons/green-dot.png";
		// icon = "http://mapicons.nicolasmollet.com/wp-content/uploads/mapicons/shape-default/color-3a64d6/shapecolor-color/shadow-1/border-dark/symbolstyle-white/symbolshadowstyle-dark/gradient-no/busstop.png";
	}
	// Else (non-bus stop)
	else {
		icon = "http://maps.google.com/mapfiles/ms/micons/blue-dot.png";
		// icon = htmURL+"/public/img/icons/anchor-blue.gif";

		// console.log(icon);
	}

	waypoint.setIcon(icon);
}

function addMarkerListeners(markers) {

}

function loadWaypointToEditor(waypointData) {
	console.log(waypointData);

	$("#waypointId").val(waypointData.id);
	$("#waypointTitle").val(waypointData.title);
	$("#waypointLat").val(waypointData.lat);
	$("#waypointLng").val(waypointData.lng);
	$("#waypointType").prop("checked", (waypointData.type == 1) );
}

function removeWaypoint(waypoint) {
	
	if(waypoint.details.id=='') {
		waypoint.setMap(null); 	
	}
	else {
		var id = waypoint.details.id,
			URL = admURL+'?ajaxRemoveWaypoint';

		$.ajax({ 
			type: 'GET', 
			url: URL, 
			dataType: 'json',
			data: {
				id : id,
			},
			success: function (json) {
				waypoint.setMap(null); 
			},
			error: function(result){
				console.log("ERROR on "+URL+"\nOutPut result is \n'"+result.responseText+"'");
			}
		});
	}

}