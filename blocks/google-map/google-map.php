<?php
/**
 * Block template file: google-map.php
 *
 * Google Map Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'google-map-' . $block['id'].rand(0,9999);;
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-google-map';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$attrs = $is_preview ? ' class="'.esc_attr( $classes ).'" ' : get_block_wrapper_attributes([ 'class' => $classes]); ?>

<div id="<?php echo esc_attr( $id ); ?>" <?php echo $attrs; ?>  >


    <style type="text/css">
    .acf-map {
        width: 100%;
        height: 400px;
        border: #ccc solid 1px;
        margin: 20px 0;
    }

    // Fixes potential theme css conflict.
    .acf-map img {
        max-width: inherit !important;
    }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php the_field( 'google_maps_api_key', 'option' ); ?>">
    </script>
    <script type="text/javascript">
    function initMap(el) {
        var markers = el.querySelectorAll('.marker');
        var mapArgs = {
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(el, mapArgs);
        map.markers = [];
        markers.forEach(function(markerEl) {
            initMarker(markerEl, map);
        });
        centerMap(map);
        return map;
    }

    function initMarker(markerEl, map) {
        var lat = parseFloat(markerEl.dataset.lat);
        var lng = parseFloat(markerEl.dataset.lng);
        var latLng = {
            lat: lat,
            lng: lng
        };
        var marker = new google.maps.Marker({
            position: latLng,
            map: map
        });
        map.markers.push(marker);
        if (markerEl.innerHTML) {
            var infowindow = new google.maps.InfoWindow({
                content: markerEl.innerHTML
            });
            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });
        }
    }

    function centerMap(map) {
        var bounds = new google.maps.LatLngBounds();
        map.markers.forEach(function(marker) {
            bounds.extend({
                lat: marker.position.lat(),
                lng: marker.position.lng()
            });
        });
        if (map.markers.length == 1) {
            map.setCenter(bounds.getCenter());
        } else {
            map.fitBounds(bounds);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.acf-map').forEach(function(mapEl) {
            var map = initMap(mapEl);
        });
    });
    </script>

    <?php
$location = get_field('point');
if( $location ): ?>
    <div class="acf-map">
        <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>"
            data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
    </div>
    <?php endif; ?>

</div>