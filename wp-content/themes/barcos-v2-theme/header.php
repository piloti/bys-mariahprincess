<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
	    
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		
	    <!-- <script src="https://cdn.jsdelivr.net/modernizr/3.3.1/modernizr.js"></script> -->

		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,600;1,200;1,300;1,600&family=Share:wght@400;700&display=swap" rel="stylesheet">
		
		<?php wp_head(); ?>

		
	</head>
	<body <?php body_class(); ?>>
	
	<?php 
		//Inicializações básicas para o header
		$current_user = wp_get_current_user();
		$userid = get_current_user_id();
		$pageid = get_queried_object_id();
		date_default_timezone_set("America/Sao_Paulo");
		setlocale(LC_TIME, 'ptb', 'pt_BR', 'portuguese-brazil', 'bra', 'brazil', 'pt_BR.utf-8', 'pt_BR.iso-8859-1', 'br');
	?>


