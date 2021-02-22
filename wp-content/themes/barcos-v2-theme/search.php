<?php get_header(); ?>

<div class="section">
		<div class="container">


	<main role="main">
		<!-- section -->
		<section>

			<h1 class="titulo-busca"><?php echo sprintf( __( '%s Resultados para "', 'html5blank' ), $wp_query->found_posts ); echo get_search_query(); ?>"</h1>

			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<!-- article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class('item-busca'); ?>>

					<!-- post thumbnail -->
					<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
						</a>
					<?php endif; ?>
					<!-- /post thumbnail -->

					<!-- post title -->
					<h2 class="resultado-busca">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Página "<?php the_title(); ?>"</a>
					</h2>
					<span>Clique para ver mais</span>
					<!-- /post title -->

				</article>
				<!-- /article -->

			<?php endwhile; ?>

			<?php else: ?>

				<!-- article -->
				<article>
					<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
				</article>
				<!-- /article -->

			<?php endif; ?>

		</section>
		<!-- /section -->
	</main>

	</div>
</div>

<?php get_footer(); ?>
