<article id="post-<?php the_ID();?>" class="article-list-item " data-aos="fade-up">
    <?php
    if(has_post_thumbnail()){ ?>
        <figure class="thumbnail">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('image-phone'); ?></a>
        </figure>
    <?php } ?>
    <div class="info">
        <h3>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        <div class="excerpt"><?php the_excerpt(); ?> <a href="<?php the_permalink(); ?>" class="excerpt_more"></a></div>
        <div class="wp-block-buttons is-content-justification-center is-layout-flex wp-container-core-buttons-layout-2 wp-block-buttons-is-layout-flex">
            <div class="wp-block-button">
                <a class="wp-block-button__link wp-element-button" href="<?php the_permalink(); ?>">mehr lesen</a>
            </div>
        </div>
    </div>

</article>
