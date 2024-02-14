<?php
/**
 * Block template file: employees.php
 *
 * Employees Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'employees-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-employees';
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
	<?php if ( have_rows( 'employees' ) ) : ?>
		<?php while ( have_rows( 'employees' ) ) : the_row(); ?>
			<?php $image = get_sub_field( 'image' ); ?>
			<?php if ( $image ) : ?>
                <figure class="thumb"><img src="<?php echo esc_url( $image['sizes']['large'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_html( $image['sizes']['large-width'] ); ?>" height="<?php echo esc_html( $image['sizes']['large-height'] ); ?>" srcset="<?php echo wp_get_attachment_image_srcset( $image['ID'], 'large' ); ?>" loading="lazy" /></figure>
            <?php endif; ?>
			<h4><?php the_sub_field( 'name' ); ?></h4>
			<p class="phone"><?php the_sub_field( 'phone' ); ?></p>
			<p class="email"><?php the_sub_field( 'email' ); ?></p>
		<?php endwhile; ?>
	<?php else : ?>
		<?php if(is_admin()) echo '<p>Please go to edit mode to add content</p>'; ?>s
	<?php endif; ?>
</div>