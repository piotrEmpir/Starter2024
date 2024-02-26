
<?php
/**
 * Block template file: cover-video.php
 *
 * Cover Video Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'cover-video-' . $block['id'].rand(0,9999);;
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-cover-video';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

?>


<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">

    <div class="content_wrap">
        <InnerBlocks />
    </div>


    <div class="video_wrap">
        <div class="video-container">
            <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/eXKWDgj-00?controls=0M&autoplay=1&mute=1&playsinline=1&loop=1"></iframe> -->
            <?php
                $url =  get_field( 'video' );
                $query_string = parse_url($url, PHP_URL_QUERY);
                parse_str($query_string, $params);
                $videoId = $params['v'];
            ?>

            <iframe src="https://www.youtube.com/embed/<?php echo $videoId; ?>?controls=0&autoplay=1&mute=1&playsinline=1&playlist=<?php echo $videoId; ?>&loop=1&start=95&showinfo=0&modestbranding=1&rel=0" frameborder="0"></iframe>


            <?php /*
            <div class="video-container">
                <div class="off-paralax-background"><iframe src="https://www.youtube.com/embed/<?php echo $videoId; ?>?controls=0&showinfo=0&rel=0&autoplay=1&loop=1&mute=1&playlist=<?php echo $videoId; ?>" frameborder="0" allowfullscreen></iframe></div>
            </div>
            */ ?>
        </div>
    </div>
</div>