<article id = "post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <div class = "thumbnail">
       <?php thuan_thumbnail('thumbnail'); ?>
    </div>
    <div class = "entry-header">
        <?php thuan_entry_header(); ?>
    </div>
    <div class = "entry-content">
        <?php thuan_entry_content(); ?>
    </div>
</article>