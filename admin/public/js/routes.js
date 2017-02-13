var selectedDirection = 'direct',
	map,
	$waypointTemplate;

$(function() {
	
	if($(".routes-map").length > 0) {
		var routeId = $("#routeId").val();

		// Get all waypoints from DB
		getWaypoints(function(waypoints) {

			// Display waypoint markers on the map
			for (var i in waypoints) {
				addRouteWaypointMarker(waypoints[i]);
			}

			// Get route waypoints
			routeWaypoints = parseRouteWaypoints();

			// Set route waypoint markers
			setRouteWaypointIcons(routeWaypoints.direct);
		});

		// Get all trackpoints from DB
		var routeTrackpoints = {};

		getRouteTrackpoints(routeId, function(result) {
			routeTrackpoints = result;
			drawTrack(routeTrackpoints.direct);
		});
	}

	$(".waypointsContainer").sortable({
		group: 'dra',
		containerSelector: ".waypointsContainer",
		itemSelector : ".waypoint",
		handle: ".dragArea",
		drag: true,
		placeholder : '<div class="waypoint"/>',
		onDrop: function($item, container, _super) {
			setWaypointNumbers();
			reorderRouteWaypoints();
	        _super($item)
	    }
	});

	// Switch direct and back directions
	$("input[name=routeTypeRadio]").on("change", function() {
		selectedDirection = $("input[name=routeTypeRadio]:checked").val();
		setWaypointIcons(waypointMarkers);

		if(selectedDirection=="direct") {
			$("#waypointsDirect").show();
			$("#waypointsBack").hide();
			resizeScrollPane($("#waypointsScrolPane"));

			setRouteWaypointIcons(routeWaypoints.direct);

			clearTracks();
			drawTrack(routeTrackpoints.direct);
		}
		else if(selectedDirection=="back") {
			$("#waypointsDirect").hide();
			$("#waypointsBack").show();
			resizeScrollPane($("#waypointsScrolPane"));

			setRouteWaypointIcons(routeWaypoints.back);

			clearTracks();
			drawTrack(routeTrackpoints.back);
		}
	});

	// Remove waypoint
	$(document).on("click", ".waypointRemoveButton", function() {
		var waypointId = $(this).closest(".waypoint").data('id');
		removeRouteWaypoint(waypointId);
	});

	/******************************************************/
	/******************************************************/
	/******************************************************/
	/******************************************************/
	/******************************************************/
	/******************************************************/
	/******************************************************/

	var directionsService = new google.maps.DirectionsService();

	$("#generateRoute").on("click", function() {

		var trackWaypoints = {};
			trackWaypoints[selectedDirection] = {};

		clearTracks();
		routeTrackpoints[selectedDirection] = [];


		// Get create waypoint latLang object
		for (var i in routeWaypoints[selectedDirection]) {

			var order = routeWaypoints[selectedDirection][i].order,
				position = waypointMarkers[i].getPosition();

			trackWaypoints[selectedDirection][order] = {
				position :	position
			}
		}

		// Get directions for each two naighbour points
		for (i = 1; i< countObject(trackWaypoints[selectedDirection]); i++) {

			var request = {
				origin: trackWaypoints[selectedDirection][i].position,
				destination: trackWaypoints[selectedDirection][i+1].position,
				waypoints: [],
				travelMode: "DRIVING"
			};

			doSetTimeout(request, 1000*i);
		}
			function doSetTimeoutMessage() {
				msgBox({
					title : "Ավարտվեց",
					content : "<strong>Չմոռանա՛ք պահպանել երթուղին</strong>"
				});
			}
			setTimeout(doSetTimeoutMessage, 1000*i);

		function doSetTimeout(request, timeout) {
			setTimeout(function() { 

		  		countTrack(request, function(coords) {

		  			coordsArray = [];
		  			for (var i in coords) {
		  				var x = coords[i].lat,
							y = coords[i].lng;

						coordsArray.push([x,y]);
		  				routeTrackpoints[selectedDirection].push([x,y]);
		  			}

		  			drawTrack(coordsArray);
		  		});

			}, timeout);
		}
	});


	// Offset ~=0.000005
	function offsetPath(path) {

		var offset = 0.00005;

		if(selectedDirection=="back") {
			offset = -offset;
		}

		//console.log(offset);

		for (i = 0; i<path.length-1; i=i+2) {

			var x1 = path[i][0];
			var y1 = path[i][1];

			var x2 = path[i+1][0];
			var y2 = path[i+1][1];

			var a = x2-x1,
				b = y2-y1,
				c = Math.sqrt(a*a+b*b),
				sin = b/c,
				cos = a/c;

				//console.log(sin*sin+cos*cos);

			path[i][0] = x1-(offset*sin);
			path[i][1] = y1+(offset*cos);

			path[i+1][0] = x2-(offset*sin);
			path[i+1][1] = y2+(offset*cos);
		}

		return path;
	}



	/******************************************************/
	/******************************************************/
	/******************************************************/
	/******************************************************/
	/******************************************************/
	/******************************************************/
	/******************************************************/

	// Save route data
	$("#routeSaveButton").on("click", function() {
		saveRoute({
			routeId : $("#routeId").val(),
			routeNumber : $("#routeNumber").val(),
			routeType : $("#routeType option:selected").val(),
			routeTitle : $("#routeTitle").val(),
			routeDescription : $("#routeDescription").val(),
			routeNotes : $("#routeNotes").val(),
			routeWaypoints : routeWaypoints,
			routeTrackpoints : routeTrackpoints
		});
	});


	// Waypoints scroll pane APIs
	var waypointsScrolPaneApiId = $("#waypointsScrolPane").data('apiId'),
		waypointsScrolPaneApi = scrollPaneApis[waypointsScrolPaneApiId],
		$waypointTemplate = $("#waypointTemplate").clone();

	


	/***************************************************
	*				  ROUTE FUNCTIONS
	****************************************************/

	function getRouteTrackpoints(routeId, callback) {
		var URL = htmURL+'?ajaxGetRouteTrackpoints&route_id='+routeId;

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


	function saveRoute(routeData) {

		console.log(routeData);

		var URL = admURL+'/ajaxUpdateRoute';

		$.ajax({ 
			type: "POST", 
			url: URL, 
			dataType: 'json',
			data: routeData,
			success: function (result) {
				msgBox({
					title : "Երթուղու տվյալները պահպանված են"
				});
			}
			,
			error: function(result){
				console.log("ERROR on "+URL+"\nOutPut result is \n'"+result.responseText+"'");
			}
		});
	}


	var routeWaypoints = {};
	function parseRouteWaypoints() {
		
			routeWaypoints.direct = {};
			routeWaypoints.back = {};

		$("#waypointsDirect .waypoint").each(function() {
			var id = $(this).data('id');

			routeWaypoints.direct[id] = {
				// order : routeWaypoints.direct.length+1
				order : countObject(routeWaypoints.direct)+1
			};
		});

		$("#waypointsBack .waypoint").each(function() {
			var id = $(this).data('id');

			routeWaypoints.back[id] = {
				// order : routeWaypoints.back.length+1
				order : countObject(routeWaypoints.back)+1
			};
		});

		// console.log(routeWaypoints);

		return routeWaypoints;
	}

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


	var waypointMarkers = [];
	function addRouteWaypointMarker(waypoint) {
		var waypointMarker = map.addMarker({
			lat: waypoint.lat,
			lng: waypoint.lng,
			// draggable: false,
			title: waypoint.title,
			data : {
	    		id : waypoint.id,
				type : waypoint.type,
			}
	    });

	    var id = waypointMarker.data.id;
	    waypointMarkers[id] = waypointMarker;

	    bindRouteWaypointEvents(waypointMarkers[id]);
	}

	function setWaypointIcons(waypointMarkers) {
		for (var i in waypointMarkers) {
			setWaypointIcon(waypointMarkers[i]);
		}
	}

	function setWaypointIcon(waypointMarker) {
		// if is bus stantion
		if(waypointMarker.data.type == 1) {
			var icon = htmDIR+'mapicons/green/busstop.png';
		}
		else {
			var icon = htmDIR+'mapicons/green/harbor.png';
		}

		waypointMarker.setIcon(icon);
	}

	function setRouteWaypointIcons(routeWaypoints) {
		var busstopCounter = 1,
			icon;

		setWaypointIcons(waypointMarkers);

		for (var i in routeWaypoints) {

			var number = routeWaypoints[i].order;

			icon = htmDIR+'mapicons/numbers/number_'+number+'.png';

			waypointMarkers[i].setIcon(icon);
			waypointMarkers[i].setZIndex(google.maps.Marker.MAX_ZINDEX + 1);
			google.maps.Marker.MAX_ZINDEX++;
		}
	}

	function bindRouteWaypointEvents(waypoint) {

		google.maps.event.addListener(waypoint, 'click', function() {

			var waypointId = waypoint.data.id;

			if(isset(routeWaypoints[selectedDirection][waypointId])) {
				removeRouteWaypoint(waypointId);
			}
			else {
				addRouteWaypoint(waypointId);
			}

			setRouteWaypointIcons(routeWaypoints[selectedDirection]);
		});
	}

	function addRouteWaypoint(waypointId) {
		var order = countObject(routeWaypoints[selectedDirection])+1;

		routeWaypoints[selectedDirection][waypointId] = {
			order : order
		}

		var $newWaypointTemplate = $waypointTemplate.clone();
		$newWaypointTemplate.data('id', waypointId);
		$newWaypointTemplate.removeClass();
		$newWaypointTemplate.addClass("waypoint waypoint-"+waypointId);
		$newWaypointTemplate.find('.number span').html(order);

		$(".waypointsContainer:visible").append($newWaypointTemplate);


		resizeScrollPane($("#waypointsScrolPane"));
		waypointsScrolPaneApi.scrollToBottom();
	}

	function removeRouteWaypoint(waypointId) {
		delete routeWaypoints[selectedDirection][waypointId];

		$(".waypointsContainer:visible .waypoint-"+waypointId).remove();
		
		setWaypointNumbers();
		parseRouteWaypoints();
		setRouteWaypointIcons(routeWaypoints[selectedDirection]);

		resizeScrollPane($("#waypointsScrolPane"));
		// waypointsScrolPaneApi.scrollToBottom();
	}

	function reorderRouteWaypoints() {
		routeWaypoints = parseRouteWaypoints();
		setRouteWaypointIcons(routeWaypoints[selectedDirection]);
	}

	function setWaypointNumbers() {
		$('.waypointsContainer:visible .waypoint').each(function(i) {
			$(this).find('.number .label').html(i+1);
		});
	}

	function countTrack(request, callback) {
		directionsService.route(request,  function(result) {
			var coords = result.routes[0].overview_path;
			callback(coords);
		});
	}

	var polylines = {};
		polylines.direct = [];
		polylines.back = [];
	function drawTrack(coordsArray) {

		if(coordsArray.length==0) {
			return false;
		}

		if(selectedDirection=="direct") {
			var color = "#BB201B";
		}
		else {
			var color = "#428BCA";
		}

		var line = map.drawPolyline({
			path: coordsArray,
			strokeColor: color,
			strokeOpacity: 0.7,
			strokeWeight: 4
		});

		polylines[selectedDirection].push(line);
	}

	function clearTracks() {
		// Clear all lines created before
		for (var i in polylines['direct']) {
			polylines['direct'][i].setMap(null);
		}

		// Clear all lines created before
		for (var i in polylines['back']) {
			polylines['back'][i].setMap(null);
		}

		polylines['direct'] = [];
		polylines['back'] = [];



		// polylines[selectedDirection] = [];
	}

});

