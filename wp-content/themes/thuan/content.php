<article id = "post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <div class = "thumbnail">
       <?php thuan_thumbnail(); ?>
    </div>
    <div class = "entry-header">
        <?php thuan_entry_header(); ?>
    </div>
    <div class = "entry-content">
        <?php the_excerpt(); ?>
        <a href="<?php the_permalink(); ?>" class = "read-more">Read More</a>
    </div>
</article>