<?php while ($desired_category_posts->have_posts()) : $desired_category_posts->the_post(); ?>
    <div class="spc-primary-category-container">
        <div class="spc-title">
            <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
        </div>
        <div class="spc-author">
            By: <?= get_the_author(); ?>
        </div>
        <div  class="spc-excerpt">
            <?php the_excerpt(__('(more…)')); ?>
        </div>
        <a class="spc-read-more" href="<?php the_permalink() ?>" style="text-decoration:none;">Read More</a>
    </div>
<?php
endwhile;
wp_reset_postdata();
?>
