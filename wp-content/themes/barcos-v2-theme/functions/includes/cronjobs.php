<?php 

/***********
 * 
 * CRON DO WORDPRESS (precisa de acesso de um usuário para rodar, é possível automatizar com uptime robot)
 * 
 * ********/
 
function add_new_intervals($schedules) 
{
	// add weekly and monthly intervals
	$schedules['5minutin'] = array(
		'interval' => 300,
		'display' => __('Once Weekly')
	);
	
	$schedules['tododia'] = array(
		'interval' => 24*60*60,
		'display' => __('Once Weekly')
	);

	$schedules['monthly'] = array(
		'interval' => 2635200,
		'display' => __('Once a month')
	);

	return $schedules;
}

add_filter( 'cron_schedules', 'add_new_intervals');

add_action('my_hourly_event', 'do_this_hourly');

function my_activation() {
	if ( !wp_next_scheduled( 'my_hourly_event' ) ) {
		wp_schedule_event( current_time( 'timestamp' ), 'tododia', 'my_hourly_event');
	}
}
add_action('wp', 'my_activation');

function do_this_hourly() {

}

?>