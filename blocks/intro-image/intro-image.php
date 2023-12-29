<?php
/**
 * Block template file: intro-image.php
 *
 * Intro Image Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'intro-image-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

$rand_num = rand(0,1000);

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-intro-image';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
$classes .= ' alignfull ';

?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">


    <?php if(get_field( 'type' ) == 'images') {?>
	<?php if ( have_rows( 'images' ) ) : ?>
        <div id="intro_slider<?=$rand_num;?>" class="splide" aria-label="Logo slider">
            <div class="splide__track">
                <ul class="splide__list">
                <?php while ( have_rows( 'images' ) ) : the_row(); ?>
                    <li class="splide__slide">
                    <div class="content">
                        <h2><?php the_sub_field( 'title' ); ?></h2>
                        <?php $link = get_sub_field( 'link' ); ?>
                        <?php if ( $link ) : ?>
                            <a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>"><?php echo esc_html( $link['title'] ); ?></a>
                        <?php endif; ?>
                    </div>

                    <?php $image = get_sub_field( 'image' ); ?>
                    <?php if ( $image ) : ?>
                        <figure class="thumb"><img src="<?php echo esc_url( $image['sizes']['large'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_html( $image['sizes']['large-width'] ); ?>" height="<?php echo esc_html( $image['sizes']['large-height'] ); ?>" srcset="<?php echo wp_get_attachment_image_srcset( $image['ID'], 'large' ); ?>"  /></figure>
                        <?php endif; ?>
                    </li>
                <?php endwhile; ?>
                </ul>
            </div>
            </div>

	<?php else : ?>
		<?php if(is_admin()) echo '<p>Please go to edit mode to add content</p>'; ?>
	<?php endif; ?>

    <script>
    document.addEventListener( 'DOMContentLoaded', function() {
        var splide = new Splide( '#intro_slider<?=$rand_num;?>',{
            arrows: false,
            pagination: true,
            perPage: 1,
            gap: 20,
            width: '100%'
        } );
        splide.mount();
    } );
    </script>

    <?php } ?>

    <?php if(get_field( 'type' ) == 'video') {?>
	<?php if ( have_rows( 'video' ) ) : ?>
		<?php while ( have_rows( 'video' ) ) : the_row(); ?>

            <div class="content">
                <h2><?php the_sub_field( 'title' ); ?></h2>
                <?php $link = get_sub_field( 'link' ); ?>
                <?php if ( $link ) : ?>
                    <a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>"><?php echo esc_html( $link['title'] ); ?></a>
                <?php endif; ?>
            </div>

            <script src="https://www.youtube.com/iframe_api"></script>

            <div class="video-container">
                <div id="youtube-player"></div>

                <?php //echo wp_oembed_get( get_sub_field( 'video' ) ); ?>
            </div>

            <?php
                $url =  get_sub_field( 'video' );
                $query_string = parse_url($url, PHP_URL_QUERY);
                parse_str($query_string, $params);
                $videoId = $params['v'];
            ?>

            <script>
                function onYouTubeIframeAPIReady() {
                    var player = new YT.Player('youtube-player', {
                        height: '100',
                        width: '100',
                        videoId: '<?php echo $videoId;?>',  // Replace with your YouTube video ID
                        playerVars: {
                            'autoplay': 1,
                            'mute': 1,
                            'controls': 0
                        },
                        events: {
                            'onReady': onPlayerReady,
                            // ... other event handlers ...
                        }
                    });
                }
                function onPlayerReady(event, data) {



                }

                const videoId = '<?php echo $videoId;?>'; // replace with your video ID
                const url = `https://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=${videoId}&format=xml`;

                console.log(url);

                fetch(url)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text();
                    })
                    .then(str => (new window.DOMParser()).parseFromString(str, "text/xml"))
                    .then(data => {
                        const height = data.getElementsByTagName("height")[0].childNodes[0].nodeValue;
                        const width = data.getElementsByTagName("width")[0].childNodes[0].nodeValue;

                        const videoContainer = document.querySelector('.video-container');
                        const aspectRatio = (height / width) * 100;
                        videoContainer.style.paddingBottom = `${aspectRatio}%`;

                    })
                    .catch(error => {
                        console.error('There has been a problem with your fetch operation:', error);
                    });
            </script>

		<?php endwhile; ?>
    <?php else : ?>
		<?php if(is_admin()) echo '<p>Please go to edit mode to add content</p>'; ?>
	<?php endif; ?>
    <?php } ?>

</div>