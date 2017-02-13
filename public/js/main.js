$(function() {

	initScrollPane();
	resizeScrollPanes();
	resizeMapArea();

	$(window).on("resize", function () {
		resizeScrollPanes();
		resizeMapArea();
	});

	$("#searchSubmit").on("click", function(){
		$("#searchForm").submit();
	});

	$("#searchForm input").on("keypress", function(e) {
		if (e.which == 13) {
		    $("#searchForm").submit();
	  	}
	});

	$(".chosen-select").chosen({
		width: "100%"
	});

	$("#routeNumberSelect").on("change", function() {
		var routeID = $("#routeNumberSelect option:selected").val();
		window.location.href = htmURL+"?route="+routeID;
	});


	var map;
	if( $("#map-canvas").length > 0 ) {
		resizeMapArea();
		initMap();
	}


	$(document).on("click", ".closeMsg", function() {
		$.fancybox.close();
	});

	$(document).on("click", "#aTest", function() {
		console.log('passed');
	});

	

});

/************************************************************
*						Functions
************************************************************/


function initMap() {
	map = new GMaps({
	  div: '#map-canvas',
	  zoom: 14,
	  lat: 40.177636,
	  lng: 44.512623
	});

	// map.setOptions({draggableCursor:'crosshair'});

	// map.addControl({
	//   position: 'top_center',
	//   content: $("#gmapControl").html(),
	//   style: {
	//     margin: '5px',
	//     // padding: '1px 6px',
	//     // border: 'solid 1px #717B87',
	//     // background: '#fff'
	//   },
	//   events: {
	//     // click: function(){
	//     //   console.log(this);
	//     // }
	//   }
	// });
}


var scrollPaneApi;
var scrollPaneApis = [];
function initScrollPane() {

	$('.scrollPane').each(function(i) {

		var that = $(this);

		var scrollPane = $(this).jScrollPane({
			horizontalGutter:5,
		    verticalGutter:5,
		    'showArrows': false,
		    mouseWheelSpeed: 70
		});

		that.data('apiId', i);
		scrollPaneApis[i]= scrollPane.data('jsp');

	});	

	// console.log(scrollPaneApis);
}

function reinitScrollPane($obj) {
	var apiId = $obj.data('apiId');
	scrollPaneApis[apiId].reinitialise();
}

function resizeScrollPane($scrollPane) {
	var jspContainerHeight = $scrollPane.find('.jspPane').height();

	$scrollPane.find('.jspContainer').height(jspContainerHeight);
	$scrollPane.height('auto');

	var scrollPaneAreaHeight = 	$(window).height() - 
							 	$scrollPane.parent().find('.scrollPaneFooter').outerHeight() - 
							 	$scrollPane.parent().find('.scrollPaneHeader').outerHeight() - 
							 	60,
		scrollPaneActualHeight = $scrollPane.outerHeight(),
		scrollPaneHeight = Math.min(scrollPaneAreaHeight, scrollPaneActualHeight);

	$scrollPane.height(scrollPaneHeight);

	reinitScrollPane($scrollPane);
}

function resizeScrollPanes() {
	$(".scrollPane").each(function() {
		resizeScrollPane($(this));
	});
}

function resizeScrollPanesOld() {

	// console.log('resize');

	$(".jspPane").each(function() {

		var jspContainerHeight = $(this).height();
		$(this).closest('.jspContainer').height(jspContainerHeight);
		$(this).closest('.scrollPane').height('auto');

		var scrollPaneAreaHeight = 	$(window).height() - 
								 	$(this).closest(".scrollPane").parent().find('.scrollPaneFooter').outerHeight() - 
								 	$(this).closest(".scrollPane").parent().find('.scrollPaneHeader').outerHeight() - 
								 	60,
			scrollPaneActualHeight = $(this).closest('.scrollPane').outerHeight(),
			scrollPaneHeight = Math.min(scrollPaneAreaHeight, scrollPaneActualHeight);

		$(this).closest('.scrollPane').height(scrollPaneHeight);

	});

	for (var i in scrollPaneApis) {
		scrollPaneApis[i].reinitialise();
	}

}

function resizeMapArea() {
	var parrentVerticalPaddings = $("#map-content").outerHeight() - $("#map-content").height();
	$("#map-canvas").height( $(window).height() - parrentVerticalPaddings);
}

function msgBox(data) {
	var width = (isset(data.width)) ?  data.width  : 300;
	$('#modalMsg').width(width);

	$('#modalMsg .modal-title, #modalMsg .modal-body').hide();
		

	if(isset(data.title)) {
		$("#modalMsg .modal-title").html(data.title).show();
	}

	if(isset(data.content)) {
		$("#modalMsg .modal-body").html(data.content).show();
	}

	
	$.fancybox.open({
		href: '#modalMsg',
		modal: true,
		padding : 5,
	});

}

function msgConfirm(data) {
	var width = (isset(data.width)) ?  data.width  : 350;
	$('#modalConfirm').width(width);

	$('#modalConfirm .modal-title, #modalConfirm .modal-body').hide();

	var yes = isset(data.yes) ? data.content : 'Այո',
		no = isset(data.no) ? data.content : 'Ոչ';	

	if(isset(data.title)){
		$("#modalConfirm .modal-title").html(data.title).show();
	}

	if(isset(data.content)){
		$("#modalConfirm .modal-body").html(data.content).show();
	}

	$("#modalConfirm .modal-footer .yes").html(yes);
	$("#modalConfirm .modal-footer .no").html(no);

	// $('#modalConfirm').modal('show');

	$.fancybox.open({
		href: '#modalConfirm',
		modal: true,
		padding : 5,
	});
	
	$("#modalConfirm .yes").off().on('click', function() {
		if(isset(data.onYes)) {
			data.onYes();
		}

		$.fancybox.close();
	});

}

function isset(variable) {
	if ((typeof (variable) === 'undefined') || (variable === null)) {
        return false;
	}
    else {
        return true;
    }
}

function countArray(array) {
	var count = 0;

	for (var i = 0; i < array.length; i++) {
		if(isset(array[i])) {
			count++;
		}
	}

	return count;
}

function countObject(obj) {
    var count = 0;

    for(var prop in obj) {
        if(obj.hasOwnProperty(prop))
            ++count;
    }

    return count;
}

// Array.prototype.count = function() {
// 	var asdsadasf = 0;

// 	for (var i = 0; i < this.length; i++) {
// 		// if(isset(this[i])) {
// 		// 	count++;
// 		// }
// 		// if (this[i] == deleteValue) {         
// 		//   this.splice(i, 1);
// 		//   i--;
// 		// }
// 	}

// 	//return count;
// };