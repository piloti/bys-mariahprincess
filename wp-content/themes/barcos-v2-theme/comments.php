<div class="comments">
	<?php if (post_password_required()) : ?>
	<p><?php _e( 'Post is password protected. Enter the password to view any comments.', 'html5blank' ); ?></p>
</div>

<?php return; endif; ?>

<?php comment_form(array('title_reply' => 'Participe da discussão',	)); ?>

<?php if (have_comments()) : ?>
	<?php //comments_number(); ?>
	
	<ul>
		<?php wp_list_comments('type=comment&callback=mytheme_comment'); // Custom callback in functions.php ?>
	</ul>

<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

	<p><?php _e( 'Comments are closed here.', 'html5blank' ); ?></p>

<?php endif; ?>

</div>
