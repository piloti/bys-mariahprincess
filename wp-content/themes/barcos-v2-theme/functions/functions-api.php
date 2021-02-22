<?php

/*------------------------------------*\
  API - CHAMADAS E DEFINIÇÕES
\*------------------------------------*/

function checa_nonce() {
	return wp_verify_nonce( $_SERVER['HTTP_X_WP_NONCE'], 'wp_rest' );
}

add_action( 'rest_api_init', function () {

	register_rest_route( 'caleidosapi', '/exemplo_api', array(
		'methods' => 'POST',
		'callback' => 'exemplo_api',
		'permission_callback' => 'checa_nonce'
	) );
	
	register_rest_route( 'caleidosapi', '/upload_attachment', array(
		'methods' => 'POST',
		'callback' => 'upload_images_callback',
		'permission_callback' => 'checa_nonce'
	) );
	
	// /* id na url */
	// register_rest_route( 'caleidosapi', '/evento/(?P<id>\d+)', array(
	// 	'methods' => 'GET',
	// 	'callback' => 'get_evento',
	// 	'args' => array(
	// 		'id' => array(
	// 			'validate_callback' => function($param, $request, $key) {
	// 				return is_numeric( $param );
	// 			}
	// 		),
	// 	),
	// 	'permission_callback' => 'checa_nonce'
	// ) );

	register_rest_route( 'caleidosapi', '/programas', array(
		'methods' => 'GET',
		'callback' => 'get_programas',
	) );



} );



function exemplo_api( WP_REST_Request $request ) {
    $post_id = $request['noticia']?:0;
    $usr_id = $request['usr']?:0;
    
    return '';
}

function upload_user_file( $file = array(), $title = false ) {
	require_once ABSPATH.'wp-admin/includes/admin.php';
	$file_return = wp_handle_upload($file, array('test_form' => false));
	if(isset($file_return['error']) || isset($file_return['upload_error_handler'])){
		return false;
	}else{
		$filename = $file_return['file'];
		$attachment = array(
			'post_mime_type' => $file_return['type'],
			'post_content' => '',
			'post_type' => 'attachment',
			'post_status' => 'inherit',
			'guid' => $file_return['url']
		);
		if($title){
			$attachment['post_title'] = $title;
		}
		$attachment_id = wp_insert_attachment( $attachment, $filename );
		require_once(ABSPATH . 'wp-admin/includes/image.php');
		
		$attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
		wp_update_attachment_metadata( $attachment_id, $attachment_data );
		if( 0 < intval( $attachment_id ) ) {
			return $attachment_id;
		}
	}
	return false;
}

function reArrayFiles(&$file_post) {
    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);
    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }
    return $file_ary;
}

function upload_images_callback() {
	$data = array();
	$attachment_ids = array();
	$files = reArrayFiles($_FILES['files']);
	$permitidos = $_POST['tipos'];
	
	if ( empty($_FILES['files']) ) {
		$data['status'] = false;
		$data['message'] = "Por favor selecione uma imagem para enviar";
	} elseif ( array_reduce($files, "reduce_file_type_image", FALSE) ) { //"reduce_file_ext", FALSE) ) { 
		$data['status'] = false;
		$data['message'] = "Por favor selecione apenas imagens para enviar";//arquivos do tipo certo para enviar";
	} elseif ( array_reduce($files, "reduce_file_size", FALSE) ) { 
		$data['status'] = false;
		$data['message'] = "Por favor selecione apenas arquivos menores que 25Mb";
	} else {
		$i = 0;
		$data['message'] = '';
		foreach( $files as $file ){
			if( is_array($file) ){
                $nome = $file['name'] ? substr($file['name'], 0 , (strrpos($file['name'], "."))) : FALSE;
				$attachment_id = upload_user_file( $file, $nome );
				
				if ( is_numeric($attachment_id) ) {
                    $attachment_data = get_post($attachment_id);
					$data['status'] = true;
					//$data['message'] .= '<li data-id='.$attachment_data->ID.'><strong><a href="'.wp_get_attachment_url( $attachment_data->ID ).'">'.basename( get_attached_file( $attachment_data->ID ) ).'</a></strong><small>Upload realizado em '.get_the_date( 'd/m/Y', $attachment_data ).' | <a class="js-excluir-thumb" href="">remover</a></small></li>';
					$data['message'] = '<img src="'.wp_get_attachment_thumb_url( $attachment_id ).'" data-id='.$attachment_id.'>';
				
					$data['imgurl'] = wp_get_attachment_thumb_url( $attachment_id );
					$data['imgid'] = $attachment_id;
				}
			}
			$i++;
		}
		// if( ! $attachment_ids ){
		// 	$data['status'] = false;
		// 	$data['message'] = "Ocorreu um erro e sua imagem não foi adicionada";
		// }
	}
	
    echo json_encode($data);
	die();
}

function reduce_file_size($carry, $item) {
    return ($carry||($item['size'] > 26214400));
}

function reduce_file_type_image($carry, $item) {
    return ($carry||(strpos($item['type'], 'image') === false));
}

function get_programas(){
	$posts = get_posts(array(
		'post_type' => 'programa',
		'post_status' => 'publish',
		'orderby' => 'date',
		'order' => 'DESC',
		'posts_per_page' => -1,
		'fields' => 'ids'
	));
	return array_map('get_programa',$posts);
}

require_once( ABSPATH . 'wp-admin/includes/media.php' );

function get_programa($id){
	$objeto = array();
	$objeto['id']=$id;
	$objeto['nome']=get_field('nome',$id);
	$objeto['nome_linha']=preg_replace('/\r\n|\r|\n/',' ',get_field('nome',$id,false));
	$objeto['arquivo']=get_field('arquivo',$id)?:'';
	$metadata=wp_read_audio_metadata(get_attached_file(get_field('arquivo',$id,false)));
	$objeto['duracao']=$metadata ? $metadata['length_formatted'] : '';
	$objeto['duracao_s']=$metadata ? $metadata['length'] : '';
	$temaid = get_field('tema',$id);
	$tema=get_term($temaid, 'tema');
	$objeto['tema']=$tema->name ?: '';
	$objeto['tema_slug']=$tema->slug ?: '';
	$objeto['capa']=get_field('capa','term_'.$temaid); // remover depois
	$capas = get_field('capas','term_'.$temaid);
	if (!$capas) {
		$objeto['capas'] = array('grande'=>'', 'media'=>'', 'pequena'=>'');
	} else {
		$objeto['capas'] = $capas[((int)$id) % count($capas)];
	}
	$objeto['cor']=get_field('cor','term_'.$temaid);
	$objeto['tags']=array_map(function($o){return $o->name;},get_the_tags($id)?:array());
	$objeto['descricao']=get_field('descricao',$id);
	$objeto['descricao_ingles']=get_field('descricao_ingles',$id);
	$playlist=get_field('playlist',$id,false);
	$objeto['playlist'] = playlist($playlist);
	$objeto['data'] = get_the_date( "Ymd", $id );
	$objeto['data_texto'] = get_the_date( "d.m.Y", $id );
	$objeto['searchable'] = slugify($objeto['nome_linha'].' '.$objeto['tema'].' '.implode(' ',$objeto['tags']).' '.$playlist);

	return $objeto;
}

function get_temas(){
	return array_map(function($tema){
		return array(
			'tema'=>$tema->name ?: '',
			'slug'=>$tema->slug ?: '',
			'count'=>$tema->count ?: 0,
			'capa'=>get_field('capa','term_'.$tema->term_id),
			'cor'=>get_field('cor','term_'.$tema->term_id),
		);
	}, get_terms( array(
		'taxonomy' => 'tema',
		'hide_empty' => false,
	) ) );
}

function get_programa_tags(){
	return get_tags( array('orderby' => 'count', 'order' => 'DESC') );
}

function playlist($pl){
	$pl = str_replace('“', '"', $pl);
	$pl = str_replace('”', '"', $pl);
	$pl = array_map('trim',array_filter(preg_split('/\r\n|\r|\n/', $pl)));
	$lista = array();
	foreach ($pl as $musica){
		if ($musica[0]!='"'){
			$lista[] = array('musica'=>$musica,'interprete'=>'');
		} else {
			$musica = substr($musica, 1);
			$partes = explode('"',$musica,2);
			$lista[] = array('musica'=>trim($partes[0]),'interprete'=>trim($partes[1]?:''));
		}
	}
	return $lista;
}

function slugify($text){
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);
  // trim
  $text = trim($text, '-');
  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);
  // lowercase
  $text = strtolower($text);
  if (empty($text)) {
    return 'n-a';
  }
  return $text;
}

