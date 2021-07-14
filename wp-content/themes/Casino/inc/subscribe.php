<?php

function subscribe()
{	
	$get_request = file_get_contents("php://input");
	$request = json_decode($get_request);

	$email = esc_html($request->request->client_email);
	if(isset($email) && $email != ''):
		$post_data = array(
			'post_title'    => $email,
			'post_status'   => 'publish',
			'post_type'     => 'subscribe',
		);
		wp_insert_post($post_data, true);
		
		$subscribe_form = get_field('subscribe_form', 'options');
		$popup_data = array(
			'title' => $subscribe_form['popup_title'],
			'text' => $subscribe_form['popup_text'],
		);
		echo wp_json_encode($popup_data);
	endif;
	
	wp_die();
}
add_action('wp_ajax_subscribe', 'subscribe');
add_action('wp_ajax_nopriv_subscribe', 'subscribe');

