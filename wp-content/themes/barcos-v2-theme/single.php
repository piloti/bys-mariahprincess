<?php get_header(); ?>
<?php if ( have_posts() ) {	while ( have_posts() ) { the_post(); ?>

<div class='section section-pagina'>
    <div class='container'>
        
    </div>
</div>


<?php } } ?>
<?php get_footer(); ?>