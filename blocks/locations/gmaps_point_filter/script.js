// script.js
$(document).ready(function() {
    // Initialize variables and locations
    var map;
    var infowindow = new google.maps.InfoWindow();
    var markers = [];
    var locations = [
    {'title' : 'Oslo', 'description' : 'Description for city Oslo'	, 'lat': 59.9133, 'lng' :	10.7389},
    {'title' : 'Bergen', 'description' : 'Description for city Bergen'	, 'lat': 60.3894, 'lng' :	5.3300},
    {'title' : 'Stavanger', 'description' : 'Description for city Stavanger'	, 'lat': 58.9700, 'lng' :	5.7314},
    {'title' : 'Sandnes', 'description' : 'Description for city Sandnes'	, 'lat': 58.8517, 'lng' :	5.7361},
    {'title' : 'Trondheim', 'description' : 'Description for city Trondheim'	, 'lat': 63.4297, 'lng' :	10.3933	},
    {'title' : 'Sandvika', 'description' : 'Description for city Sandvika'	, 'lat': 59.8833, 'lng' :	10.5167	},
    {'title' : 'Kristiansand', 'description' : 'Description for city Kristiansand'	, 'lat': 58.1472, 'lng' :	7.9972	},
    {'title' : 'Drammen', 'description' : 'Description for city Drammen'	, 'lat': 59.7378, 'lng' :	10.2050	},
    {'title' : 'Asker', 'description' : 'Description for city Asker'	, 'lat': 59.8331, 'lng' :	10.4392	},
    {'title' : 'Tønsberg', 'description' : 'Description for city Tønsberg'	, 'lat': 59.2981, 'lng' :	10.4236	},
    {'title' : 'Skien', 'description' : 'Description for city Skien'	, 'lat': 59.2081, 'lng' :	9.5528	},
    {'title' : 'Bodø', 'description' : 'Description for city Bodø'	, 'lat': 67.2827, 'lng' :	14.3751	},
    {'title' : 'Ålesund', 'description' : 'Description for city Ålesund'	, 'lat': 62.4740, 'lng' :	6.1582	},
    {'title' : 'Moss', 'description' : 'Description for city Moss'	, 'lat': 59.4592, 'lng' :	10.7008	},
    {'title' : 'Arendal', 'description' : 'Description for city Arendal'	, 'lat': 58.4608, 'lng' :	8.7664	},
    {'title' : 'Lørenskog', 'description' : 'Description for city Lørenskog'	, 'lat': 59.8989, 'lng' :	10.9642	},
    {'title' : 'Tromsø', 'description' : 'Description for city Tromsø'	, 'lat': 69.6828, 'lng' :	18.9428	},
    {'title' : 'Haugesund', 'description' : 'Description for city Haugesund'	, 'lat': 59.4464, 'lng' :	5.2983	},
    {'title' : 'Molde', 'description' : 'Description for city Molde'	, 'lat': 62.7375, 'lng' :	7.1591	},
    {'title' : 'Askøy', 'description' : 'Description for city Askøy'	, 'lat': 60.4667, 'lng' :	5.1500	},
    {'title' : 'Hamar', 'description' : 'Description for city Hamar'	, 'lat': 60.7945, 'lng' :	11.0679	},
    {'title' : 'Oppegård', 'description' : 'Description for city Oppegård'	, 'lat': 59.7925, 'lng' :	10.7903	},
    {'title' : 'Rygge', 'description' : 'Description for city Rygge'	, 'lat': 59.3747, 'lng' :	10.7147	},
    {'title' : 'Steinkjer', 'description' : 'Description for city Steinkjer'	, 'lat': 64.0148, 'lng' :	11.4954	},
    {'title' : 'Randaberg', 'description' : 'Description for city Randaberg'	, 'lat': 59.0017, 'lng' :	5.6153	},
    {'title' : 'Lommedalen', 'description' : 'Description for city Lommedalen'	, 'lat': 59.9500, 'lng' :	10.4667	},
    {'title' : 'Barbu', 'description' : 'Description for city Barbu'	, 'lat': 58.4664, 'lng' :	8.7781	},
    {'title' : 'Tiller', 'description' : 'Description for city Tiller'	, 'lat': 63.3550, 'lng' :	10.3790	},
    {'title' : 'Kolbotn', 'description' : 'Description for city Kolbotn'	, 'lat': 59.8112, 'lng' :	10.8000	},
    {'title' : 'Lillestrøm', 'description' : 'Description for city Lillestrøm'	, 'lat': 59.9500, 'lng' :	11.0833	}
    ];

    // Initialize Google Map
    function initMap() {
        var nor = { lat: 59.9133, lng: 10.7389 };
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: nor
        });

        var bounds = new google.maps.LatLngBounds();

        // Add markers to map and save them in an array
        locations.forEach(function (location) {

            var position = new google.maps.LatLng(location.lat, location.lng);
            bounds.extend(position);


            var marker = new google.maps.Marker({
                position: { lat: location.lat, lng: location.lng },
                map: map,
                title: location.title
            });

            // Add click listener for each marker
            marker.addListener('click', function () {
                infowindow.setContent('<strong>' + location.title + '</strong><p>' + location.description + '</p>');
                infowindow.open(map, marker);
            });

            // Save the marker and its associated data
            markers.push({ marker: marker, title: location.title.toLowerCase(), description: location.description.toLowerCase(), data: location });
        });

        map.fitBounds(bounds);
    }

        // Function to calculate distance between two coordinates
        function calculateDistance(lat1, lon1, lat2, lon2) {
            var R = 6371; // Radius of the earth in km
            var dLat = deg2rad(lat2 - lat1);
            var dLon = deg2rad(lon2 - lon1);
            var a =
                Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            var d = R * c; // Distance in km
            return d;
        }

        function deg2rad(deg) {
            return deg * (Math.PI / 180)
        }

        // Find closest marker to the given location
        $('#findClosest').click(function () {
            var userLocation = $('#closestLocationInput').val();
            if (!userLocation) return; // If input is empty, exit the function

            // Geocode the user-entered location
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'address': userLocation }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var lat = results[0].geometry.location.lat();
                    var lng = results[0].geometry.location.lng();
                    var closestMarker = null;
                    var closestDistance = Number.MAX_VALUE;

                    // Loop through markers to find the closest
                    markers.forEach(function (item) {
                        var distance = calculateDistance(lat, lng, item.data.lat, item.data.lng);
                        if (distance < closestDistance) {
                            closestDistance = distance;
                            closestMarker = item;
                        }
                    });

                    if (closestMarker) {
                        map.setCenter(closestMarker.marker.getPosition());
                        infowindow.setContent('<strong>' + closestMarker.data.title + '</strong><p>' + closestMarker.data.description + '</p>');
                        infowindow.open(map, closestMarker.marker);
                    }
                } else {
                    alert("Geocode was not successful for the following reason: " + status);
                }
            });
        });

    $('#filterInput').on('keyup', function () {
        var value = $(this).val().toLowerCase();
        markers.forEach(function (item) {
            // Check if the search term is in the title or description
            var match = item.title.indexOf(value) > -1 || item.description.indexOf(value) > -1;
            item.marker.setVisible(match); // Show or hide the marker
        });

        // Show or hide the list item
        var list = document.getElementById('locationsList');
        var items = list.getElementsByTagName('li');
        for (var i = 0; i < items.length; i++) {
            var item = items[i];
            var text = item.textContent.toLowerCase();
            var match = text.indexOf(value) > -1;
            item.style.display = match ? 'block' : 'none';
        }
    });

    // Call the map initializer function
    initMap();


    //print locations as html list
    var list = document.getElementById('locationsList');
    locations.forEach(function (location) {
        var li = document.createElement('li');
        li.textContent = location.title + ' - ' + location.description;
        list.appendChild(li);
    });
});
