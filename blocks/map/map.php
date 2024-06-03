
<?php
/**
 * Block template file: map.php
 *
 * Map Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'map-' . $block['id'].rand(0,9999);;
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-map';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$attrs = $is_preview ? ' class="'.esc_attr( $classes ).'" ' : get_block_wrapper_attributes([ 'class' => $classes]); ?>

<div id="<?php echo esc_attr( $id ); ?>" <?php echo $attrs; ?>  >

<style>
    .custom-info-window,
    .gm-style .gm-style-iw-d::-webkit-scrollbar-track,
    .gm-style .gm-style-iw-d::-webkit-scrollbar-track-piece,
    .gm-style .gm-style-iw-c,
    .gm-style .gm-style-iw-t::after,
    .gm-style .gm-style-iw-tc::after{

    }
</style>


	<?php if ( have_rows( 'points' ) ) : ?>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php the_field( 'google_maps_api_key', 'option' ); ?>&callback=initMap"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/markerclustererplus/2.1.4/markerclusterer.min.js"></script>

        <div id="map" style="width: 100%; height: 500px;"></div>

        <script>
            function initMap() {
            // Map initialization
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 3,
                center: {lat: 37.09024, lng: -95.712891}
            });

            // Sample set of marker locations with associated data
            var locations = [
            <?php while ( have_rows( 'points' ) ) : the_row(); ?>
                <?php $point = get_sub_field( 'point' ); ?>
                <?php if ( $point ) : ?>
                    {lat: <?php echo $point['lat']; ?>, lng: <?php echo $point['lng']; ?>, info: '<?php echo trim(preg_replace('/\s+/', ' ', get_sub_field( 'description' ))); ?>'},
                <?php endif; ?>

            <?php endwhile; ?>
            ];

            // Create an array to hold the markers
            var markers = [];
            // Create an infoWindow
            var infoWindow = new google.maps.InfoWindow();

            // Loop over the locations to create markers and attach info windows
            for (var i = 0; i < locations.length; i++) {

                var markerIcon = 'path_to_default_icon.png';

                if (locations[i].type === 'special') {
                    markerIcon = 'path_to_special_icon.png';
                }

                var marker = new google.maps.Marker({
                    position: locations[i],
                    map: map,
                    //icon: markerIcon
                });

                // Add click listener to the marker to show info
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infoWindow.setContent('<div class="custom-info-window">' + locations[i].info + '</div>');
                        infoWindow.open(map, marker);
                    }
                })(marker, i));

                markers.push(marker);
            }

            // Use LatLngBounds to center map and fit all markers
            var bounds = new google.maps.LatLngBounds();
            for (var j = 0; j < markers.length; j++) {
                bounds.extend(markers[j].getPosition());
            }
            map.fitBounds(bounds);

            // Add a marker clusterer to manage the markers.
            new MarkerClusterer(map, markers, {
                imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
            });
        }
        </script>
	<?php else : ?>
		<?php if(is_admin()) echo '<p>Please go to edit mode to add content</p>'; ?>
	<?php endif; ?>
</div>