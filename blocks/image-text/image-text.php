<?php
/**
 * Block template file: image-text.php
 *
 * Image Text Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'image-text-' . $block['id'].rand(0,9999);
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-image-text';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$attrs = $is_preview ? ' class="'.esc_attr( $classes ).'" ' : get_block_wrapper_attributes([ 'class' => $classes]); ?>

<div id="<?php echo esc_attr( $id ); ?>" <?php echo $attrs; ?>  >
	<div class="wrap <?php the_field( 'order' ); ?> <?php the_field( 'style' ); ?>">

		<div class="image">
			<?php $image = get_field( 'image' ); ?>
			<?php if ( $image ) : ?>
				<figure class="thumb"><img src="<?php echo esc_url( $image['sizes']['image-tablet'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_html( $image['sizes']['image-tablet-width'] ); ?>" height="<?php echo esc_html( $image['sizes']['image-tablet-height'] ); ?>" srcset="<?php echo wp_get_attachment_image_srcset( $image['ID'], 'large' ); ?>" loading="lazy" /></figure>
			<?php endif; ?>
		</div>

		<div class="text">
			<?php if(get_field( 'title' )) {?>
				<h2><?php the_field( 'title' ); ?></h2>
			<?php } ?>
			<?php if(get_field( 'text' )) {?>
				<?php the_field( 'text' ); ?>
			<?php } ?>
			<?php $link = get_field( 'link' ); ?>
			<?php if ( $link ) : ?>
				<div class="wp-block-buttons wp-block-buttons-is-layout-flex">
					<div class="wp-block-button">
						<a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $link['url'] ); ?>"
					target="<?php echo esc_attr( $link['target'] ); ?>"><?php echo esc_html( $link['title'] ); ?></a>
					</div>
				</div>
			<?php endif; ?>
		</div>

	</div>


</div>