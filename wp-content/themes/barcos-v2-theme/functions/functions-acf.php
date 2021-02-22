<?php

/*------------------------------------*\
  ADVANCED CUSTOM FIELDS
\*------------------------------------*/

if( function_exists('acf_add_options_page') ) {
	
// 	acf_add_options_page(array(
// 		'page_title' 	=> 'Opções Gerais',
// 		'menu_title'	=> 'Opções Gerais',
// 		'menu_slug' 	=> 'opcoes-gerais',
// 		'capability'	=> 'edit_posts',
// 		'redirect'		=> false
// 	));
	
}

function embedVideo($acfcampo){
	// get iframe HTML
	$iframe = $acfcampo;

	// use preg_match to find iframe src
	preg_match('/src="(.+?)"/', $iframe, $matches);
	$src = $matches[1];

	// add extra params to iframe src
	$params = array(
	    'controls'    => 1,
	    'hd'        => 1,
	    'autohide'    => 1
	);
	$new_src = add_query_arg($params, $src);
	$iframe = str_replace($src, $new_src, $iframe);

	// add extra attributes to iframe html
	$attributes = 'frameborder="0"';
	$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
	// echo $iframe
	return $iframe;
}


/**
* Hook custom columns para adicionar colunas novas no indice de posts
**/
// function add_colunas_tipodepost ( $columns ) {
//     //unset($columns['']); //se precisar remover alguma coluna default
//     $nova = array_slice($columns, 0, 2, true) + 
//         array ( 
//             'slugcampo' => __ ( 'Nome do Campo')
//         ) +
//         array_slice($columns, 2, NULL, true);
//     return $nova;
// }
// add_filter ( 'manage_tipodepost_posts_columns', 'add_colunas_tipodepost' );
// function tipodepost_custom_column ( $column, $post_id ) {
//     switch ( $column ) {
//     case 'slugcampo':
//     	$oqueimprimir = 'procurar o que mostrar usando o $post_id';
//         echo $oqueimprimir;
//         break;
//   }
// }
// add_action ( 'manage_tipodepost_posts_custom_column', 'tipodepost_custom_column', 10, 2 );


?>