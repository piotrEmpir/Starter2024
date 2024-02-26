<?php
/**
 * Block template file: contact-card.php
 *
 * Contact Card Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'contact-card-' . $block['id'].rand(0,9999);;
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-contact-card';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>


<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
	<h2><?php the_field( 'title' ); ?></h2>
	<div class="wrap <?php the_field( 'style' ); ?>">
        <?php if ( have_rows( 'card' ) ) : ?>
            <?php while ( have_rows( 'card' ) ) : the_row(); ?>
                <div class="card">
                        <?php $image = get_sub_field( 'image' ); ?>
                        <?php if ( $image ) : ?>
                            <div class="thumb"><img src="<?php echo esc_url( $image['sizes']['image-tablet'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_html( $image['sizes']['image-tablet-width'] ); ?>" height="<?php echo esc_html( $image['sizes']['image-tablet-height'] ); ?>" srcset="<?php echo wp_get_attachment_image_srcset( $image['ID'], 'large' ); ?>"  loading="lazy" /></div>
                        <?php endif; ?>
                        <div class="info">
                            <?php if ( $name = get_sub_field( 'name' ) ) : ?>
                                <h3><?php echo esc_html( $name ); ?></h3>
                            <?php endif; ?>
                            <?php if ( $position = get_sub_field( 'position' ) ) : ?>
                                <div class="pos"><?php echo esc_html( $position ); ?></div>
                            <?php endif; ?>
                            <?php if ( $phone = get_sub_field( 'phone' ) ) : ?>
                                <a href="tel:<?php the_sub_field( 'phone' ); ?>"><?php the_sub_field( 'phone' ); ?></a>
                            <?php endif; ?>
                            <?php if ( $email = get_sub_field( 'email' ) ) : ?>
                                <a href="tel:<?php the_sub_field( 'email' ); ?>"><?php the_sub_field( 'email' ); ?></a>
                            <?php endif; ?>

                        </div>
                    </div>
            <?php endwhile; ?>
        <?php else : ?>
            <?php if(is_admin()) echo '<p>Please go to edit mode to add content</p>'; ?>
        <?php endif; ?>
    </div>
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
