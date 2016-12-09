function initSPPageBuilderGMap() {
  jQuery('.sppb-addon-gmap-canvas').each(function(index) {
    var mapId = jQuery(this).attr('id'),
    //self = this,
    zoom = Number(jQuery(this).attr('data-mapzoom')),
    mousescroll = jQuery(this).attr('data-mousescroll'),
    mousescroll = (mousescroll === 'true') ? true : false,
    maptype = jQuery(this).attr('data-maptype'),
    latlng = {lat: Number(jQuery(this).attr('data-lat')), lng: Number(jQuery(this).attr('data-lng'))};

    var map = new google.maps.Map(document.getElementById(mapId), {
      center: latlng,
      zoom: zoom,
      scrollwheel: mousescroll
    });

    var marker = new google.maps.Marker({
      position: latlng,
      map: map
    });

    map.setMapTypeId(google.maps.MapTypeId[maptype]);

    //Get colors
    var water_color = jQuery(this).attr('data-water_color');
    var highway_stroke_color = jQuery(this).attr('data-highway_stroke_color');
    var highway_fill_color = jQuery(this).attr('data-highway_fill_color');
    var local_stroke_color = jQuery(this).attr('data-local_stroke_color');
    var local_fill_color = jQuery(this).attr('data-local_fill_color');
    var poi_fill_color = jQuery(this).attr('data-poi_fill_color');
    var administrative_color = jQuery(this).attr('data-administrative_color');
    var landscape_color = jQuery(this).attr('data-landscape_color');
    var road_text_color = jQuery(this).attr('data-road_text_color');
    var road_arterial_fill_color = jQuery(this).attr('data-road_arterial_fill_color');
    var road_arterial_stroke_color = jQuery(this).attr('data-road_arterial_stroke_color');

    var styles = [
        {
            "featureType": "water",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": water_color
                }
            ]
        },
        {
            "featureType": "transit",
            "stylers": [
                {
                    "color": "#808080"
                },
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": highway_stroke_color
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": highway_fill_color
                }
            ]
        },
        {
            "featureType": "road.local",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": local_stroke_color
                }
            ]
        },
        {
            "featureType": "road.local",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": local_fill_color
                },
                {
                    "weight": 1.8
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": poi_fill_color
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": administrative_color
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": road_arterial_fill_color
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": road_arterial_fill_color
                }
            ]
        },
        {
            "featureType": "landscape",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": landscape_color
                }
            ]
        },
        {
            "featureType": "road",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": road_text_color
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": "#737373"
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "labels.icon",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "labels",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": road_arterial_stroke_color
                }
            ]
        },
        {
            "featureType": "road",
            "elementType": "labels.icon",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {},
        {
            "featureType": "poi",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#dadada"
                }
            ]
        }

    ]; // END gmap styles

    // Set styles to map
    map.setOptions({styles: styles});

  });
};

jQuery(window).load(function() {
  initSPPageBuilderGMap();
});
