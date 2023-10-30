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
$id = 'google-map-' . $block['id'];
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
?>

<style type="text/css">
	<?php echo '#' . $id; ?> {
		/* Add styles that use ACF values here */
	}
</style>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
	<?php $point = get_field( 'point' ); ?>
	<?php if ( $point ) : ?>
		<?php echo $point['address']; ?>
		<?php echo $point['lat']; ?>
		<?php echo $point['lng']; ?>
		<?php echo $point['zoom']; ?>
		<?php $optional_data_keys = array('street_number', 'street_name', 'city', 'state', 'post_code', 'country'); ?>
		<?php foreach ( $optional_data_keys as $key ) : ?>
			<?php if ( isset( $point[ $key ] ) ) : ?>
				<?php echo $point[ $key ]; ?>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>
</div>