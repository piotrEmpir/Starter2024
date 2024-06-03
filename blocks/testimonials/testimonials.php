<?php
/**
 * Block template file: testimonials.php
 *
 * Testimonials Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'testimonials-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

$rand_num = rand(0,1000);

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-testimonials';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$attrs = $is_preview ? ' class="'.esc_attr( $classes ).'" ' : get_block_wrapper_attributes([ 'class' => $classes]); ?>

<div id="<?php echo esc_attr( $id ); ?>" <?php echo $attrs; ?>  >
	<?php if ( have_rows( 'testimonials' ) ) : ?>
		<div id="testimonials_slider<?=$rand_num;?>" class="splide" aria-label="Testimonials slider">
            <div class="splide__track">
                <ul class="splide__list">
				<?php while ( have_rows( 'testimonials' ) ) : the_row(); ?>
					<li class="splide__slide">
						<div class="item">
							<div class="text has-sm-font-size">
								<?php the_sub_field( 'description' ); ?>
							</div>

							<div class="who">
								<?php $image = get_sub_field( 'image' ); ?>
								<?php if ( $image ) : ?>
									<?php $image = get_sub_field( 'image' ); ?>
									<?php if ( $image ) : ?>
										<div class="image_wrap">
											<img srcset="<?php echo wp_get_attachment_image_srcset( $image['ID'], 'thumbnail' ); ?>"  src="<?php echo esc_url( $image['sizes']['thumbnail'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>"  loading="lazy"  width="<?php echo  $image['sizes']['thumbnail-width']; ?>" height="<?php echo $image['sizes']['thumbnail-height']; ?>" />
										</div>
									<?php endif; ?>
								<?php endif; ?>

								<span class="name"><?php the_sub_field( 'who' ); ?></span>
							</div>
						</div>
					</li>
				<?php endwhile; ?>
				</ul>
			</div>
		</div>
	<?php else : ?>
		<?php if(is_admin()) echo '<p>Please go to edit mode to add content</p>'; ?>
	<?php endif; ?>
</div>


<?php if(!is_admin()) { ?>
<script>
  document.addEventListener( 'DOMContentLoaded', function() {
    var splide = new Splide( '#testimonials_slider<?=$rand_num;?>',{
        arrows: true,
        pagination: false,
        perPage: 1,
        gap: 20,
		loop: true,
        width: '100%',

    } );
    splide.mount();
  } );
</script>
<?php } ?>