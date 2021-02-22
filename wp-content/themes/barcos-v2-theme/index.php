<?php get_header(); ?>
<?php if ( have_posts() ) {	while ( have_posts() ) { the_post(); ?>

<div class="section section-inicial">
    <div class="container">
        <h1><?php the_title(); ?></h1>    
    </div>
</div>


<?php } } ?>
<?php get_footer(); ?>