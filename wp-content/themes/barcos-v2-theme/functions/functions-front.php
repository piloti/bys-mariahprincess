<?php

/*------------------------------------*\
  FUNÇÕES USADAS NO FRONT
\*------------------------------------*/

/**
* Função somente_logado: só permite o acesso de quem está logado
**/

function somente_logado(){
  if (!is_user_logged_in()) {
    wp_redirect( home_url(), 302 );
    exit;
  }
}

/**
* Função somente_admin: só permite o acesso de quem é admin
**/

function somente_admin(){
  if (!is_user_logged_in() || !current_user_can('manage_options') ) {
    wp_redirect( home_url(), 302 );
    exit;
  }
}

/**
* Função get_slug
* @param id - aceita um id de um tipo_produto
* @return o slug do post
**/

function get_slug($id) {
    $post_data = get_post($id, ARRAY_A);
    $slug = $post_data['post_name'];
    return $slug; 
}

/**
* Função url_slug
* @param title - aceita uma string, slug de uma página
* @return o permalink dessa página
**/

function url_slug( $title ) {

    // Initialize the permalink value
    $permalink = null;

    // Try to get the page by the incoming title
    $page = get_page_by_path( strtolower( $title ) );

    // If the page exists, then let's get its permalink
    if( null != $page ) {
        $permalink = get_permalink( $page->ID );
    } // end if

    return $permalink;
}

/**
* Função gera_resumo
* @param title - aceita uma string de texto
* @return o resumo desse texto, em até 30 palavras
**/

function gera_resumo($campo) {
	$text = $campo; //Replace 'your_field_name'
	if ( '' != $text ) {
		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]&gt;', ']]&gt;', $text);
		$excerpt_length = 30; // 20 words
		$excerpt_more = apply_filters('excerpt_more', ' ' . '...');
		$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
	}
	return apply_filters('the_excerpt', $text);
}

include 'includes/calendario.php';
include 'includes/emails.php';
include 'includes/cronjobs.php';

function nl2p($text)
{
    return $text ? '<p>'.str_replace(array("\r\n", "\r", "\n"), '</p><p>', $text).'</p>' : '';
}

function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <?php //prettyPrint($comment); ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
      <div class="comment-author vcard">
         <?php echo get_avatar($comment,$size='60',$default='<path_to_url>' ); ?>
          <div class="comment-author-lateral">
            <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s | %2$s'), get_comment_date('d.m.Y'),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>
            <?php $autor =  get_comment_author();?>
            <?php
              $usr_id = $comment->user_id; 
              $nome = get_comment_author();
            ?>
            <h3 class="nome-autor"><?php echo $nome; ?></h3>
          </div>         
      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.') ?></em>
         <br />
      <?php endif; ?>

      <?php comment_text() ?>

      <div class="reply hide">
         <?php //comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
     </div>
<?php
}

remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); 
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' ); 
remove_action( 'wp_print_styles', 'print_emoji_styles' ); 
remove_action( 'admin_print_styles', 'print_emoji_styles' );