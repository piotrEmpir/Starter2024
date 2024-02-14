<?php
/**
 * Block template file: logo-slider.php
 *
 * Logo Slider Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'logo-slider-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

$rand_num = rand(0,1000);

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-logo-slider';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}


?>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
	<div class="wrap">
        <?php if ( have_rows( 'logos' ) ) : ?>
            <div id="logo_slider<?=$rand_num;?>" class="splide" aria-label="Logo slider">
            <div class="splide__track">
                <ul class="splide__list">
                <?php while ( have_rows( 'logos' ) ) : the_row(); ?>
                    <?php $image = get_sub_field( 'image' ); ?>
                    <?php $link = get_sub_field( 'link' ); ?>


                    <?php if ( $image ) : ?>
                        <li class="splide__slide">
                        <?php if ( $link ) : ?>
                            <a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>">
                        <?php endif; ?>
				        <figure class="thumb"><img src="<?php echo esc_url( $image['sizes']['medium'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_html( $image['sizes']['medium-width'] ); ?>" height="<?php echo esc_html( $image['sizes']['medium-height'] ); ?>" srcset="<?php echo wp_get_attachment_image_srcset( $image['ID'], 'large' ); ?>" loading="lazy"  /></figure>
                        <?php if ( $link ) : ?>
                            </a>
                        <?php endif; ?>
                        </li>
                    <?php endif; ?>

                <?php endwhile; ?>
                </ul>
            </div>
            </div>
        <?php else : ?>
            <?php if(is_admin()) echo '<p>Please go to edit mode to add content</p>'; ?>
        <?php endif; ?>
    </div>
</div>


<script>
  document.addEventListener( 'DOMContentLoaded', function() {
    var splide = new Splide( '#logo_slider<?=$rand_num;?>',{
        arrows: true,
        pagination: true,
        //autoWidth: true,
        focus    : 0,
        perPage: 5,
        gap: 20,
        width: '100%',
        breakpoints: {
            400: {
                perPage: 2,
            },
            600: {
                perPage: 2,
            },
            760: {
                perPage: 3,
            },
            990: {
                perPage: 3,
            },
            1240: {
                perPage: 4,
            },
            1600: {
                perPage: 5,
            }
        }

    } );
    splide.mount();
  } );
</script>