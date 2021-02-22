<?php

/*------------------------------------*\
  Scripts e Estilos 
\*------------------------------------*/


function cal_adding_scripts() {
if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
    
    wp_register_script('vuejs', 'https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.15/vue.js', array('jquery'), '1.0', true);
    wp_enqueue_script('vuejs');

    wp_register_script('userlodash', 'https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.10/lodash.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('userlodash');
    
    wp_register_script('fitvid', '//cdnjs.cloudflare.com/ajax/libs/fitvids/1.1.0/jquery.fitvids.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('fitvid');
    
    wp_register_script('slick', '//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('slick');

    wp_register_script('Lightbox', get_template_directory_uri().'/js/lightbox.js', array('jquery'), '1.0', true);
    wp_enqueue_script('Lightbox');
    
    // wp_register_script('list', '//cdnjs.cloudflare.com/ajax/libs/list.js/1.3.0/list.min.js', array('jquery'), '1.0', true);
    // wp_enqueue_script('list');
    
    // wp_register_script('isotope', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.1/isotope.pkgd.min.js', array('jquery'), '1.0',, true);
    // wp_enqueue_script('isotope');
    
    // wp_register_script('imgloaded', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.1/imagesloaded.pkgd.min.js', array('jquery'), '1.0',, true);
    // wp_enqueue_script('imgloaded');
    
    // wp_register_script('photoswipe', 'https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.1/photoswipe.js', array('jquery'), '1.0', true);
    // wp_enqueue_script('photoswipe');
    
    // wp_register_script('photoswipeui', 'https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.1/photoswipe-ui-default.js', array('jquery'), '1.0', true);
    // wp_enqueue_script('photoswipeui');
    
    $arquivo = get_template_directory_uri().'/js/main.js';
    $localpath = get_template_directory().'/js/main.js';
    $ver = filemtime($localpath);

    wp_register_script('main', $arquivo, array('jquery'), $ver, true);
    wp_enqueue_script('main');
    
    $rest_nonce = wp_create_nonce('wp_rest');
    
    $parameters = array(
        'themeurl' => get_template_directory_uri(),
        'nonce' => $rest_nonce,
    );

    global $post;

    
    wp_localize_script('main', 'parametros', $parameters );
    
    //Exemplo de load condicional por página
    // if (is_page('mapa')) {
      
    //   wp_register_script('mapajs', get_template_directory_uri().'/js/mapa.js', array('jquery'), time(), true);
    //   wp_enqueue_script('mapajs');
      
    //   wp_register_script('gmaps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBIqK9IUMcL1j_-2oB_i8xDR2JF1a-OEyU&callback=mapa.inimapa', array('mapajs'), time(), true);
    //   wp_enqueue_script('gmaps');
      
    // }
    
}}

function cal_adding_styles() {
if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
    $arquivo = get_template_directory_uri().'/css/style.css';
    $localpath = get_template_directory().'/css/style.css';
    $ver = filemtime($localpath);
    
    wp_register_style('fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7', 'all');
    wp_enqueue_style('fontawesome');
    
    wp_register_style('stylecss', $arquivo, array(), $ver, 'all');
    wp_enqueue_style('stylecss');
    
    wp_register_style('slick', '//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css', array(), '1.0', 'all');
    wp_enqueue_style('slick');

    wp_register_style('lightcss', get_template_directory_uri().'/css/lightbox.css', array(), $ver, 'all');
    wp_enqueue_style('lightcss');
    
    
}}


function  cal_adding_adminstyles(){
    // $arquivo = get_template_directory_uri().'/css/admin.css';
    // $localpath = get_template_directory().'/css/admin.css';
    // $ver = filemtime($localpath);
    
    // wp_register_style('admincss', $arquivo, array(), $ver, 'all');
    // wp_enqueue_style('admincss');
}

add_action( 'wp_enqueue_scripts', 'cal_adding_scripts' );
add_action('wp_enqueue_scripts', 'cal_adding_styles');
add_action('admin_head', 'cal_adding_adminstyles');


?>