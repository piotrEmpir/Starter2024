<?php
/**
 * Block template file: steps.php
 *
 * Steps Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'steps-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-steps';
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
	<?php if ( have_rows( 'steps' ) ) : ?>
		<div class="wrap">
            <?php while ( have_rows( 'steps' ) ) : the_row(); ?>
                <div class="item">
                    <?php the_sub_field( 'number' ); ?>
                    <h3><?php the_sub_field( 'title' ); ?></h3>
                    <?php $image = get_sub_field( 'image' ); ?>
                    <?php if ( $image ) : ?>
                        <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                    <?php endif; ?>
                    <?php the_sub_field( 'description' ); ?>
                </div>
            <?php endwhile; ?>
        </div>
	<?php else : ?>
		<?php // No rows found ?>
	<?php endif; ?>
    <?php $link = get_field( 'link' ); ?>
    <?php if ( $link ) : ?>
        <div class="wp-block-buttons is-content-justification-center is-layout-flex wp-container-core-buttons-layout-2 wp-block-buttons-is-layout-flex">
            <div class="wp-block-button">
                <a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $link['url'] ); ?>"
            target="<?php echo esc_attr( $link['target'] ); ?>"><?php echo esc_html( $link['title'] ); ?></a>
            </div>
        </div>
    <?php endif; ?>
</div>