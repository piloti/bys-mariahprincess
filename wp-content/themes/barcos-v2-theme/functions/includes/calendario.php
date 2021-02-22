<?php

/***********
 * 
 * DESENHO DE CALENDÁRIO C/ TABLE
 * 
 * ********/
 
function draw_calendar($month,$year,$diaseventos){

	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('dom','seg','ter','qua','qui','sex','sab');
	$calendar.= '<tr class="table-header calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
	  $classeappend = '';
	  if (in_array($list_day, $diaseventos)) {
	    $classeappend = ' evento';
	  }
		$calendar.= '<td class="calendar-day'.$classeappend.'">';
			/* add in the day number */
			$calendar.= '<div class="day-number">'.$list_day.'</div>';

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			//$calendar.= str_repeat('<p> </p>',2);
			
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}

function calendario_objeto($datastring){
  date_default_timezone_set("America/Sao_Paulo");
  setlocale(LC_TIME, 'ptb', 'pt_BR', 'portuguese-brazil', 'bra', 'brazil', 'pt_BR.utf-8', 'pt_BR.iso-8859-1', 'br');
  if (empty($datastring)) {
    $data = new DateTime('now');
  } else {
    $data = DateTime::createFromFormat('d-m-Y', '01-'.$datastring);
  }
  $atual = clone $data;
  $atual->modify('first day of this month')->setTime(0,0,0);
  $final = clone $data;
  $final->modify('last day of this month')->setTime(23,59,59);
  $next = clone $data;
  $next->modify('next month')->setTime(0,0,0);
  $prev = clone $data;
  $prev->modify('previous month')->setTime(0,0,0);
  
  $obj = array();
  $obj['data'] = $atual;
  $obj['timestamp_inicio'] = $atual->format('Ymd');
  $obj['final'] = $final;
  $obj['timestamp_final'] = $final->format('Ymd');
  $obj['next'] = $next;
  $obj['prev'] = $prev;
  $obj['mes_str'] = date_i18n('F', $atual->format('U'));
  $obj['mes_plugin'] = $atual->format('n');
  $obj['ano_str'] = $atual->format('Y');
  $obj['next_str'] = $next->format('m-Y');
  $obj['prev_str'] = $prev->format('m-Y');
  
  $qeventos = get_posts(array(
    'posts_per_page'  => -1,
    'orderby'          => 'data',
	  'order'            => 'ASC',
    'meta_query' => array(
      array(
          'key'     => 'data',
          'value'   => array( $obj['timestamp_inicio'], $obj['timestamp_final'] ),
          'compare' => 'BETWEEN',
      )
    ),
    'post_type'       => 'evento',
    'post_status'     => array('draft','ativo')
  ));
  
  $obj['eventos'] = $qeventos;
  
  //date_format(date_create_from_format('Ymd', get_post_meta($n->ID, 'data', true)),'d');
  //$obj['listadias'] = array_map(function ($n){return date('d', get_post_meta($n->ID, 'data', true));}, $qeventos);
  $obj['listadias'] = array_map(function ($n){return date_format(date_create_from_format('Ymd', get_post_meta($n->ID, 'data', true)),'d');}, $qeventos);
  
  return $obj;
}

function calendario_home($datastring){
  date_default_timezone_set("America/Sao_Paulo");
  setlocale(LC_TIME, 'ptb', 'pt_BR', 'portuguese-brazil', 'bra', 'brazil', 'pt_BR.utf-8', 'pt_BR.iso-8859-1', 'br');
  if (empty($datastring)) {
    $data = new DateTime('now');
  } else {
    $data = DateTime::createFromFormat('d-m-Y', '01-'.$datastring);
  }
  $atual = $data;
  $atual->modify('first day of this month')->setTime(0,0,0);
  $final = clone $data;
  $final->modify('+12 month')->setTime(23,59,59);
  // $next = clone $data;
  // $next->modify('next month')->setTime(0,0,0);
  // $prev = clone $data;
  // $prev->modify('previous month')->setTime(0,0,0);
  
  $obj = array();
  $obj['data'] = $atual;
  $obj['timestamp_inicio'] = $atual->format('Ymd');
  $obj['final'] = $final;
  $obj['timestamp_final'] = $final->format('Ymd');
  // $obj['next'] = $next;
  // $obj['prev'] = $prev;
  // $obj['mes_str'] = date_i18n('F', $atual->format('U'));
  // $obj['mes_plugin'] = $atual->format('n');
  // $obj['ano_str'] = $atual->format('Y');
  // $obj['next_str'] = $next->format('m-Y');
  // $obj['prev_str'] = $prev->format('m-Y');
  $found_post = null;
  $qeventos = get_posts(array(
    'posts_per_page'  => 3,
    'orderby'          => 'data hora',
	  'order'            => 'ASC',
    'meta_query' => array(
      array(
          'key'     => 'data',
          'value'   => array( $obj['timestamp_inicio'], $obj['timestamp_final'] ),
          'compare' => 'BETWEEN'
      )
    ),
    'post_type'       => 'evento',
    'post_status'     => array('draft','ativo')
  ));
  $found_post = $qeventos[0];
  
  $obj['eventos'] = $qeventos;
  if ( !is_null( $found_post ) ){
    $obj['calendario'] = calendario_objeto(date_format(date_create_from_format('Ymd', get_post_meta($found_post->ID, 'data', true)),'m-Y'));
  } else {
    $obj['calendario'] = calendario_objeto(null);
  }
  
  return $obj;
}

?>