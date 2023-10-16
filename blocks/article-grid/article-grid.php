<?php
/**
 * Block template file: article-grid.php
 *
 * Article Grid Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'article-grid-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-article-grid';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}


$style="";

$tmp = get_block_wrapper_attributes($block['style']);
preg_match('/style="([^"]+)"/', $tmp, $matches);

if($matches[1])
    $style = $matches[1];



?>

<style type="text/css">
	<?php echo '#' . $id; ?> {
		/* Add styles that use ACF values here */
	}
</style>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>" style="<?php echo esc_attr( $style ); ?>">
	<?php if ( have_rows( 'items' ) ): ?>
		<div class="wrap">
            <?php while ( have_rows( 'items' ) ) : the_row(); ?>
                <?php if ( get_row_layout() == 'article' ) : ?>
                    <?php $article = get_sub_field( 'article' ); ?>
                    <?php if ( $article ) : ?>
                        <?php foreach ( $article as $post_ids ) : ?>


                            <article  class="article-list-item">
                                <?php if(get_the_post_thumbnail( $post_id, 'post-thumbnail' )){ ?>
                                <figure class="thumb">
                                    <a href="<?php echo get_permalink( $post_ids ); ?>">
                                    <?php echo get_the_post_thumbnail( $post_id, 'post-thumbnail' ); ?>
                                    </a>
                                </figure>
                                <?php } ?>

                                <h3 class="has-lg-font-size">
                                    <a href="<?php echo get_permalink( $post_ids ); ?>"><?php echo get_the_title( $post_ids ); ?></a>
                                </h3>

                                <div class="excerpt">
                                    <?php echo get_the_excerpt($post_id); ?>
                                </div>

                                <a href="<?php echo get_permalink( $post_ids ); ?>" class="more"><?php echo get_the_title( $post_ids ); ?></a>

                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php elseif ( get_row_layout() == 'custom_content' ) : ?>
                    <article class="article-list-item">
                        <?php $link = get_sub_field( 'link' ); ?>
                        <?php $image = get_sub_field( 'image' ); ?>
                        <?php if ( $image ) : ?>
                        <figure class="thumb">
                            <?php if ( $link ) : ?>
                                <a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>">
                            <?php endif; ?>
                                <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                            <?php if ( $link ) : ?>
                                </a>
                            <?php endif; ?>
                        </figure>
                        <?php endif; ?>

                        <h3 class="has-lg-font-size">
                            <?php if ( $link ) : ?>
                                <a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>">
                            <?php endif; ?>
                            <?php the_sub_field( 'title' ); ?>
                            <?php if ( $link ) : ?>
                                </a>
                            <?php endif; ?>
                        </h3>

                        <div class="excerpt">
                            <?php the_sub_field( 'excerpt' ); ?>
                        </div>

                        <?php if ( $link ) : ?>
                            <a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>" class="more"><?php echo esc_html( $link['title'] ); ?></a>
                        <?php endif; ?>
                    </article>
                <?php endif; ?>
            <?php endwhile; ?>
        </div>
	<?php else: ?>
		<?php if(is_admin()) echo '<p>Please go to edit mode to add content</p>'; ?>
	<?php endif; ?>
</div>