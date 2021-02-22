<?php get_header(); ?>
<?php 
	if( is_tax() ) {
	    global $wp_query;
	    $term = $wp_query->get_queried_object();
	    $title = $term->name;
	}
?>

<div class="home-container home-container-acervo">
	<div class="home-acervo-inside">
		<h2 class="tipo-titulo"><?php echo $title; ?></h2>
		<ul class="itens-acervo itens-acervo-<?php echo $tipo->slug; ?>">			
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<li class="item-ajax item-acervo">
				<a class="open-ajax open-ajax-acervo" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" data-id="<?php the_ID(); ?>"></a>
				<div class="loader">
					<div class="spinner">
					  <div class="rect1"></div>
					  <div class="rect2"></div>
					  <div class="rect3"></div>
					  <div class="rect4"></div>
					  <div class="rect5"></div>
					</div>
				</div>
				<?php $image = get_field('prod_capa'); ?>
				<img src="<?php echo $image[sizes][medium]; ?>" alt="<?php the_title(); ?>">					
			</li>
			
			<?php endwhile; ?>
			<?php endif; ?>
			<li class="item-acervo ghost"></li>
			<li class="item-acervo ghost"></li>
			<li class="item-acervo ghost"></li>
			<li class="item-acervo break"></li>
		</ul>
	</div>
	<div class="envelope-produto">
		
	</div>
</div>

<?php get_footer(); ?>
