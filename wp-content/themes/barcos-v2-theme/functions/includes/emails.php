<?php 

/***********
 * 
 * AÇÃO PARA DISPARO DE EMAIL
 * 
 * ********/
 
function func_dispara_email($alvo, $assunto, $titulo, $autor,$texto){

    //$alvo, $assunto, $mensagem
    
    //REMETENTES
    $to = array(
    	$alvo
    );
    
    //TEMPLATE
    //Get e-mail template     
    $mensagem_orig = file_get_contents(ABSPATH.'/emails/base-inline.html');
    
    $mensagem = str_ireplace('{{titulo}}', $titulo, $mensagem_orig);
    $time = date_i18n( 'j \d\e F \d\e Y' );
    $premsg = 'Enviado por '.$autor.' em '.$time;
    $mensagem = str_ireplace('{{data}}', $premsg, $mensagem);
    $mensagem = str_ireplace('{{texto}}', $texto, $mensagem);
    
    
    //HEADERS
    $headers = array('Content-Type: text/html; charset=UTF-8');
    $headers[] = 'From: Site Wordpress <wordpress@noreply.com.br>';
    
    $statusmail = wp_mail($to, $assunto, $mensagem, $headers);
    
}

add_action('convoca_disparo_email', 'func_dispara_email', 1, 5);
//para usar: 
//do_action('convoca_disparo_email', $email, $eassunto, $titulo, $nome, $mensagem );

?>