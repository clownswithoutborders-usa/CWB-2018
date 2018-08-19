jQuery(document).ready( function($) {
	var map					= null;
	var formOptions			= new Object();
		//formOptions.countFilter 	= 10;
		formOptions.yearFilter 	= 'all';
		formOptions.countryFilter 	= 'all';
		formOptions.searchTerm 	= '';
	var markers 	= new Array;	
	var infowindow 			= null;
	var defaultCenter		= new google.maps.LatLng(15,0);
	var defaultZoom			= 2;
	var cluster				= null;
	var clusterOptions = {gridSize: 10, maxZoom: 15,
		styles: [{
			url: '/wp-content/themes/cwb-usa/js/js-marker-clusterer/images/pin.png',
			height: 48,
			width: 30,
			anchor: [-18, 0],
			textColor: '#ffffff',
			textSize: 14,
			iconAnchor: [15, 48]
		}]
	};
	var message 			= '';
	var numResults 			= 0;
	var projectsLoad		= $.Deferred();
	var countriesLoad		= $.Deferred();
	var page				= '';

	function initializeProjectMap() {
		getProjects();
		$.when( projectsLoad ).done(function (ret) {
			projects = ret.projects;
			setYears(ret.years);
			setCountries(ret.countries);
			var mapOptions = {
				zoom		: defaultZoom,
				center		: defaultCenter,
				mapTypeId	: google.maps.MapTypeId.ROADMAP
				//maxZoom		: 14
			};
			map = new google.maps.Map(document.getElementById('cwb-map'),mapOptions);
			setMarkers(projects);
			showList(projects);
			infowindow = new google.maps.InfoWindow({
				content: ' ',
				//maxWidth: 230
			});
		});
	}
	
	function getProjects() {
		var ret = null;
		$.ajax({
			url: getprojects.ajax_url,
			async: true,
			type: 'get',
			data : {
				action : 'cwb_init_projects',
			},
			success: function( data ) {
				ret = $.parseJSON(data);
				projectsLoad.resolve(ret);
			}
		});
	};
	function setYears(years) {
		$.each(years,function(idx,year){
			$("#yearFilter").append('<option value="' + year + '">' + year + '</option>');
		});
	}
	function setCountries(countries) {
		//console.log(countries);
		var countries = $.map(countries, function(value, index) {
   			return [value];
		});
		countries.sort(function(a,b) {
			return ((a.title < b.title) ? -1 : ((a.title > b.title) ? 1 : 0));
		});
		$.each(countries,function(ID,country){
			$("#countryFilter").append('<option value="' + country.ID + '">' + country.title + '</option>');
		});
	}
	function filterSearch(searchResults) {
		message = formOptions.searchTerm;
		$.each(projects,function(idx,proj){
			if ($.inArray(projects[idx].ID,searchResults.IDs) == -1) {
				projects[idx].visible = false;
			}else{
				projects[idx].visible = true;
			}		
		});
		showList(projects);
		updateMarkers();
	}
	function filterResults() {
		//k = 0;
		$.each(projects,function(idx,proj){
			projects[idx].visible = true;
			//if (formOptions.countFilter == 'all' || k < formOptions.countFilter) {
			if (formOptions.yearFilter != 'all') {
				if (formOptions.yearFilter != projects[idx].year) {
					projects[idx].visible = false;
				}
				message = formOptions.yearFilter;
			}else if(formOptions.countryFilter != 'all' ) {
				if (projects[idx].countryIDs.indexOf(formOptions.countryFilter) == -1) {
					projects[idx].visible = false;
				}
				message = $("#countryFilter option:selected").text();
			}
			//}//if countFilter
		});
		showList(projects);
		updateMarkers();
	}
	function updateMap(){
		if (map) {
			if (numResults > 0) {	
				google.maps.event.trigger(map, 'resize');
				if (map.getZoom() > 7) {
					map.setZoom(7);
				}
			}else{
				map.setZoom(defaultZoom);
				map.setCenter(defaultCenter);
			}
		}
	}
	
	function showList(projects) {
		string = '';
		//console.log(projects);
		numResults = 0;
		$.each(projects,function(idx,project){
			if (project.visible) {
				numResults++;		
				string += '<li class="project" id="' + project.ID + '">';
				if (project.thumbnail != '') {
					string += '<div class="feat-img">';
					string += project.thumbnail;
					string += '</div>';//feat-img
				}

				string += '<h2><a href="' + project.permalink + '">' + project.title + '</a></h2>';
				string += '<div class="entry-meta">';
				if (project.project_start_date) {
					string += '<p><span>' + project.project_start_date + '</span>';
					if (project.project_end_date) {
						string += ' &mdash; ' + project.project_end_date + '</span>';
					}
					string += '</p>';
				}
				string += '</div>';	//entry-meta	
				
				string += '<div class="entry-content">';
				string += project.excerpt;
				string += '</div>';	//	entry-content
				
				string += '</li>';
			}
			//console.log(project.visible);
		});
		
		if (numResults == 0) {
			string = '<li>No results found</li>';
			message = 'You searched for <strong>' + message + '</strong>.'
		}else{
			if (formOptions.searchTerm) {
				message = 'You searched for <strong>' + formOptions.searchTerm + '</strong>. ' + numResults + ' results found:';
			}else if (formOptions.yearFilter != 'all' || formOptions.countryFilter != 'all') {
				message =  numResults + ' projects found in <strong>' + message + '</strong>:';
			}else {
				message = 'Viewing ' + numResults + ' projects 1998-present</strong>:';//initial message
			}
		}
		$('ul#project-container').html(string).promise().done(function(){
			$("#message").html(message);
			$("#resultsWrapper .loading").fadeOut();	
		});
	}
	function updateMarkers() {
		if (infowindow != null) {
			infowindow.close();
		}
        cluster.clearMarkers();  
		if (numResults > 0) {
			var bounds = new google.maps.LatLngBounds();
			clusterList = new Array();
			for (k = 0; k < markers.length; k++) {
				project = getObjectByID(projects,markers[k].ID);
				if (project.visible) {
					markers[k].setVisible(true);
					clusterList.push(markers[k]);
					bounds.extend(markers[k].position);
				}else{
					markers[k].setVisible(false);
				}
			}
			cluster = new MarkerClusterer(map, clusterList, clusterOptions);
			if (map && bounds){
				map.fitBounds(bounds);
			}
		}
		updateMap();
	}
	
	function setMarkers(objects) {
		for (var m = 0; m < objects.length; m++) {
			var object = objects[m];
			if (object.location) {
				var image = {
					url: '/wp-content/themes/cwb-usa/js/js-marker-clusterer/images/pin1.png',
					size: new google.maps.Size(30, 48),
					//origin: new google.maps.Point(0,0),
					anchor: new google.maps.Point(15, 48)
				};
			
				var point = new google.maps.LatLng(object.location.lat, object.location.lng);
			
				var marker = new google.maps.Marker({
					position: point,
					map: map,
					icon: image,
					title: object.title,
					ID: object.ID,
					zIndex: 1
				});
				google.maps.event.addListener(marker, 'click', function() {
					setInfoWindow(this,objects);
				});
				markers.push(marker);
			}
		}
		
		if (page == 'projects') {
			cluster = new MarkerClusterer(map, markers, clusterOptions);
		}
	}
	function getObjectByID(objects,ID) {
		for (var p = 0; p < objects.length; p++) {
			if (objects[p].ID == ID) {
				return objects[p];
			}
		}
		return false;
	}
	function setInfoWindow(thisMarker,objects) {
		if (thisMarker != false) {
			infowindow.setContent(getInfoWindowContent(thisMarker.ID,objects));
			infowindow.open(map,thisMarker);
		}
	}
	function getInfoWindowContent(ID,objects) {
		var contentString = '';
		if (page == 'projects') {
			project = getObjectByID(objects,ID); 	
			contentString += '<div class="infoWindow projectWindow">';
			contentString += '<h4>' + project.title + '</h4>';
			contentString += '<p>' + project.year + '</p>';
			contentString += '<p>' + project.excerpt + '<span class="readmore"><a href="' + project.permalink + '"> Continue reading &rarr;</a></span></p>';
			contentString += '</div>';
			
		}else if (page == 'countries') {
			country = getObjectByID(objects,ID); 	
			contentString += '<div class="infoWindow countryWindow">';
			contentString += '<a href="' + country.permalink + '">';
			if (country.flag_image) {
				contentString += '<img class="flag_image" src="' + country.flag_image.src + '" alt="' + country.title + ' flag" style="height: ' + country.flag_image.h + 'px; width: ' + country.flag_image.w + 'px;">';
			}
			contentString += '<h4>' + country.title + ' &raquo;</h4>';
			contentString += '</a>';
			contentString += '</div>';
		}
		return contentString;
	}

	function showLoader() {
		$("#resultsWrapper .loading").show();
		return;
	}
	
	function doSearch() {
		var ret = null;
		$.ajax({
			url: searchprojects.ajax_url,
			async: true,
			type: 'post',
			data : {
				action : 'cwb_search_projects',
	            query : formOptions.searchTerm
			},
			success: function( data ) {
				ret = $.parseJSON(data);
				filterSearch(ret);
			}
		});
	};
	function resetFields() {
		$("#yearFilter").prop('selectedIndex',0);
		$("#countryFilter").prop('selectedIndex',0);
		$("#search").val('');
	}
	function submitForm() {
		//formOptions.countFilter = $("#countFilter").val();
		formOptions.yearFilter = $("#yearFilter").val();
		formOptions.countryFilter = $("#countryFilter").val() - 0;
		$.when (showLoader()).done(function() {
			if ($("#search").val() != '') {
				formOptions.searchTerm = $("#search").val();
				doSearch();
			}else{
				filterResults();
			}
			resetFields();
		});
	}
	/* specific to Countries */
	
	function initializeCountryMap() {
		getCountries();
		$.when( countriesLoad ).done(function (countries) {
			var mapOptions = {
				zoom		: defaultZoom,
				center		: defaultCenter,
				mapTypeId	: google.maps.MapTypeId.ROADMAP
			};
			map = new google.maps.Map(document.getElementById('country-map'),mapOptions);
			setMarkers(countries);
			infowindow = new google.maps.InfoWindow({
				content: ' '
			});
		});
	}

	function getCountries() {
		var ret = null;
		$.ajax({
			url: getcountries.ajax_url,
			async: true,
			type: 'get',
			data : {
				action : 'cwb_init_countries',
			},
			success: function( data ) {
				ret = $.parseJSON(data);
				countriesLoad.resolve(ret);
			}
		});
	};
	
	
	
	/* EVENTS */
	$("#search").keypress(function (e) {
		if (e.which == 13) {
			submitForm();
			return false;
		}
	});
	$("#go").click(function() {
		submitForm();	
	}); 
	$("#reset").click(function() {
		resetFields();
	}); 
	
	/* INIT */
	if ($("#cwb-map").length) {
		page = 'projects';
		initializeProjectMap();
	}
	
	if ($("#country-map").length) {
		page = 'countries';
		initializeCountryMap();
	}
	   
	if ($("#countriesList").length) {
		$('#countriesList').DataTable({
			'paging':	false,
			'info':		false,
			'searching':	false,
			"columns": [
				{ data: "country" },
				{ data: "projectCount",
				   render: $.fn.dataTable.render.number( ',', '.', 0) 
				},
				{ data: "peopleServed",
					"type": "num",
				  	render: $.fn.dataTable.render.number( ',', '.', 0)
				}
			]	
		});//datatable
	}//if
})


