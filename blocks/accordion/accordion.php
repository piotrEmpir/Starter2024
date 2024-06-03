<?php
/**
 * Block template file: accordion.php
 *
 * Accordion Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'accordion-' . $block['id'].rand(0,9999);;
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-accordion';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$attrs = $is_preview ? ' class="'.esc_attr( $classes ).'" ' : get_block_wrapper_attributes([ 'class' => $classes]); ?>

<div id="<?php echo esc_attr( $id ); ?>" <?php echo $attrs; ?>  >
	<div class="ac-title has-md-font-size">
		<?php the_field( 'title' ); ?>
		<span class="toggler"></span>
	</div>
	<div class="ac-content" style="display: none;"><?php the_field( 'description' ); ?></div>
</div>