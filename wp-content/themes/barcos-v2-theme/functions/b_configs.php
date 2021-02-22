<?php

/*------------------------------------*\
  Configurações básicas
\*------------------------------------*/

// Seta largura de conteúdo
$largmax = 1080;
if (!isset($content_width)){ $content_width = $largmax; }

//Suportes básicos no Tema
if (!function_exists('cal_setup_basico')){
function cal_setup_basico() {
    
    // Adiciona menus
    add_theme_support('menus');
    register_nav_menus( array( // Using array to specify more menus if needed
        'nav-main' => __('Navegação Principal'),
        'nav-sec' => __('Navegação secundária')
    ));

    // Adiciona e customiza tamanho de imagens
    add_theme_support('post-thumbnails');
    
    add_image_size('small', 300, '', true); // Small Thumbnail
    add_image_size('medium', 600, '', true); // Medium Thumbnail
    add_image_size('large', $largmax, '', true); // Large Thumbnail
    add_image_size('fullscreen', 1920, '', true); 
    the_post_thumbnail('fullscreen');

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');
    
    // Switch default core markup for search form, comment form, and comments to output valid HTML5.
    add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	));
	
	//Logo do tema
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );
}}
add_action( 'cal_setup_basico', 'nada_setup' );


/*------------------------------------*\
        REMOÇÕES E AJUSTES
\*------------------------------------*/


// Ações Removidas
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Filtros e ações adicionadas
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

//Remove barra de admin fora do admin
function remove_admin_bar(){
    return false;
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html ){
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}


?>