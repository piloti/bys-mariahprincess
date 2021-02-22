<?php

/*------------------------------------*\
  FUNÇÕES ÚTEIS EM GERAL
\*------------------------------------*/

/**
* Função prettyPrint: imprime uma array ou objeto em um formato legível
**/
function prettyPrint($a) {
    echo '<pre>'.print_r($a,1).'</pre>';
}

/**
* Função titleCase: converte uma string em titlecase
**/
function titleCase($string, $delimiters = array(" ", "-", ".", "'", "O'", "Mc"), $exceptions = array("de", "da", "dos", "das", "do", "I", "II", "III", "IV", "V", "VI"))
{
    /*
     * Exceptions in lower case are words you don't want converted
     * Exceptions all in upper case are any words you don't want converted to title case
     *   but should be converted to upper case, e.g.:
     *   king henry viii or king henry Viii should be King Henry VIII
     */
    $string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
    foreach ($delimiters as $dlnr => $delimiter) {
        $words = explode($delimiter, $string);
        $newwords = array();
        foreach ($words as $wordnr => $word) {
            if (in_array(mb_strtoupper($word, "UTF-8"), $exceptions)) {
                // check exceptions list for any words that should be in upper case
                $word = mb_strtoupper($word, "UTF-8");
            } elseif (in_array(mb_strtolower($word, "UTF-8"), $exceptions)) {
                // check exceptions list for any words that should be in upper case
                $word = mb_strtolower($word, "UTF-8");
            } elseif (!in_array($word, $exceptions)) {
                // convert to uppercase (non-utf8 only)
                $word = ucfirst($word);
            }
            array_push($newwords, $word);
        }
        $string = join($delimiter, $newwords);
   }//foreach
   return $string;
}




/**
* Função generatePassword: cria uma password
**/

function generatePassword($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }

    return $result;
}

/**
* Função verifyDate: checa se é uma data válida
**/

function verifyDate($date, $strict = true)
{
    $dateTime = DateTime::createFromFormat('d/m/Y', (string)$date);
    if ($strict) {
        $errors = DateTime::getLastErrors();
        if (!empty($errors['warning_count'])) {
          return '';
        }
    }
    return $dateTime !== false ? $dateTime->format('d/m/Y') : '';
}



// function safearray($arr) {
//   return array_filter((array)$arr, function($var){return !is_null($var) && ($var);} );
// }

// function data_timestamp($post_id,$field) {
//   //date_default_timezone_set("America/Sao_Paulo");
// 	$data = get_post_meta( $post_id , $field , true );
// 	$data_timestamp = get_post_meta( $post_id , $field.'_timestamp' , true );
// 	if ( !empty( $data ) ) {
// 		$data_converted = convert_timestamp($data);
// 	  if ( empty( $data_timestamp ) ) {
// 	    add_post_meta( $post_id, $field.'_timestamp', $data_converted );
// 	  } else {
// 	  	update_post_meta( $post_id, $field.'_timestamp', $data_converted );
// 	  }
// 	};
// }

/**
* Função convert_timestamp
* @param data: uma string do tipo 'd/m/Y'
* @return timestamp daquela data
**/

function convert_timestamp($data){
  date_default_timezone_set("America/Sao_Paulo");
  setlocale(LC_TIME, 'ptb', 'pt_BR', 'portuguese-brazil', 'bra', 'brazil', 'pt_BR.utf-8', 'pt_BR.iso-8859-1', 'br');
	$data = strptime( $data , '%d/%m/%Y' );
	$data_converted = mktime( 0 , 0 , 0 , $data['tm_mon']+1 , $data['tm_mday'] , $data['tm_year'] + 1900 );
	return $data_converted;
}


/**
* Função IsNullOrEmptyString
* @return testa se uma variável é nula ou uma string vazia (?)
**/

function IsNullOrEmptyString($text){
    return (!isset($text) || trim($text)==='');
}

/**
* Função get_user_ip
* @return IP do usuário
**/

function get_user_ip() {
    return getenv('HTTP_CLIENT_IP')?:
        getenv('HTTP_X_FORWARDED_FOR')?:
        getenv('HTTP_X_FORWARDED')?:
        getenv('HTTP_FORWARDED_FOR')?:
        getenv('HTTP_FORWARDED')?:
        getenv('REMOTE_ADDR');
}

/**
* Função my_front_end_login_fail
* @return pendura '?login=failed' na URL quando o login falhar
**/
function my_front_end_login_fail( $username ) {
  $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
  // if there's a valid referrer, and it's not the default log-in screen
  if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
      wp_redirect( $referrer . '?login=failed' );  // let's append some information (login=failed) to the URL for the theme to use
      exit;
  }
}
add_action( 'wp_login_failed', 'my_front_end_login_fail' );

/**
* Função areaToArray
* @return converte as linhas de um text area do acf em um array
**/
function areaToArray($campo) {
    return array_filter(preg_split('/\r\n|[\r\n]/', trim($campo))?:[], 'trim');
}
