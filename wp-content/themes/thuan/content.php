<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <div class="thumbnail">
       <?php 
       // Hiển thị ảnh đại diện (thumbnail)
       if (function_exists('thuan_thumbnail')) {
           thuan_thumbnail('thumbnail');
       } else {
           if (has_post_thumbnail()) {
               the_post_thumbnail('thumbnail');
           }
       }
       ?>
   </div>

   <div class="entry-header">
       <?php 
       // Hiển thị tiêu đề và meta (ngày, category...) tùy bạn custom
       if (function_exists('thuan_entry_header')) {
           thuan_entry_header();
       } else {
           the_title('<h1 class="entry-title">', '</h1>');
           echo '<div class="entry-meta">' . get_the_date() . '</div>';
       }
       ?>
   </div>

   <div class="entry-content">
       <?php 
       // Hiển thị nội dung bài viết
       if (function_exists('thuan_entry_content')) {
           thuan_entry_content();
       } else {
           the_content();

           // Phân trang nội dung bài viết nếu có <!--nextpage-->
           wp_link_pages([
               'before' => '<nav class="page-links" aria-label="Page">',
               'after' => '</nav>',
               'link_before' => '<span class="page-number">',
               'link_after' => '</span>',
               'next_or_number' => 'number',
               'pagelink' => '%',
           ]);
       }
       ?>
   </div>
</article>
