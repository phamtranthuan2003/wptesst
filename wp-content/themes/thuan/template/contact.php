<?php
/*
Template Name: Contact
*/
?>

<?php get_header(); ?>
<div class = "content">
    <div id = "main-content">
       <div class = "contact-info">
            <h4> Contact us: </h4>
            <p> 2871 Street DLHV, VT, PT</p>
            <p> Phone: 0123 456 789</p>
       </div>
       <div id = "main-content">
            <?php echo do_shortcode('[contact-form-7 id="8edf1dc" title="Contact form 1"]'); ?>
        </div>
    </div>
    <div id = "sidebar">
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>