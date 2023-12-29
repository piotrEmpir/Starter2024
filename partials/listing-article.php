<article id="post-<?php the_ID();?>" class="article-list-item ">
    <?php
    if(has_post_thumbnail()){ ?>
        <figure class="thumbnail">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('image-phone'); ?></a>
        </figure>
    <?php } ?>
    <h3>
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h3>
    <div class="excerpt"><?php the_excerpt(); ?></div>
    <a href="<?php the_permalink(); ?>" class="more">Read more</a>
</article>