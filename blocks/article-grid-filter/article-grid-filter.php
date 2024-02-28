<?php
/**
 * Block template file: article-grid-filter.php
 *
 * Article Grid Filter Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'article-grid-filter-' . $block['id'].rand(0,9999);;
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-article-grid-filter block-article-grid';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>


<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">

    <div class="filters">
        <form>
            <?php
            $anlass = get_terms( array(
                'taxonomy'   => 'anlass',
                'hide_empty' => false,
            ) );

            echo '<select name="anlass" id="anlass" class="anlass">';
            echo '<option value="">Anlass</option>';
            foreach ($anlass as $anlass) {
                echo '<option value="'.$anlass->slug.'">'.$anlass->name.'</option>';
            }
            echo '</select>';
            ?>
            <?php
            $musikstills = get_terms( array(
                'taxonomy'   => 'musikstill',
                'hide_empty' => false,
            ) );

            echo '<select name="musikstills" id="musikstills" class="musikstills">';
            echo '<option value="">Musikstil</option>';
            foreach ($musikstills as $musikstills) {
                echo '<option value="'.$musikstills->slug.'">'.$musikstills->name.'</option>';
            }
            echo '</select>';
            ?>
            <?php
            $regions = get_terms( array(
                'taxonomy'   => 'region',
                'hide_empty' => false,
            ) );

            echo '<select name="regions" id="regions" class="regions">';
            echo '<option value="">Region</option>';
            foreach ($regions as $regions) {
                echo '<option value="'.$regions->slug.'">'.$regions->name.'</option>';
            }
            echo '</select>';
            ?>
            <?php
            $skills = get_terms( array(
                'taxonomy'   => 'skill',
                'hide_empty' => false,
            ) );

            echo '<select name="skills" id="skills" class="skills">';
            echo '<option value="">Skill</option>';
            foreach ($skills as $skills) {
                echo '<option value="'.$skills->slug.'">'.$skills->name.'</option>';
            }
            echo '</select>';
            ?>
        </form>
    </div>

    <div class="wrap">
        <?php
                $post_num = get_field( 'number_of_posts' );
                $args = array(
                    'posts_per_page' => $post_num ,
                    'post_type' => 'post'
                );
                $query = new WP_Query( $args );
                ?>
            <?php if( $query->have_posts() ) :
                    while ( $query->have_posts() ) : $query->the_post();
                        //post_by_id(get_the_ID());
                        get_template_part( 'partials/listing-article' );
                    endwhile;
                endif; ?>
    </div>
    <?php wp_reset_query(); ?>
</div>