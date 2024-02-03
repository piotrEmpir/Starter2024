<?php
/**
 * Block template file: features-grid.php
 *
 * Features Grid Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'features-grid-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-features-grid';
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
    <h2><?php the_field( 'title' ); ?></h2>
	<?php if ( have_rows( 'features' ) ) : ?>
		<div class="grid">
            <?php while ( have_rows( 'features' ) ) : the_row(); ?>
                <div class="item">
                    <?php $image = get_sub_field( 'image' ); ?>
                    <?php if ( $image ) : ?>
                        <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>"  />
                    <?php endif; ?>
                    <h3><?php the_sub_field( 'title' ); ?></h3>
                    <div class="desc"><?php the_sub_field( 'description' ); ?></div>
                </div>
            <?php endwhile; ?>
        </div>
	<?php else : ?>
		endswitch
	<?php endif; ?>
</div>