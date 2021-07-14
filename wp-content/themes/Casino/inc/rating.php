<?php 

// Регаем API сылку 
add_action( 'rest_api_init', function () {
	register_rest_route( 'rating/v1', '/get-rating/(?P<type>\w+)/(?P<id>\d+)', array(
	  'methods' => 'GET',
	  'callback' => 'return_rating',
	) );
});

// Формируем API сылку
function get_rating_api_link($type, $id)
{
	return get_site_url() . "/wp-json/rating/v1/get-rating/$type/$id";
}

// Отдаем рейтинг
function return_rating($data)
{	
	$id = (int)$data['id'];
	if ($data['type'] == 'term') {
		$output = array(
			'users_voted'      => get_term_meta($id, 'users_voted', true) == 'NaN' ? '0' : get_term_meta($id, 'users_voted', true),
			'number_of_stars'  => get_term_meta($id, 'number_of_stars', true),
			'action_url'       => get_site_url() . '/wp-admin/admin-ajax.php?action=rating',
			'stars_id'         => $data['id'],
			'header_color'     => get_term_meta($id, 'header_color', true)
		); 
	} else {
		$voting_block = get_field('voting_block', $id);
		$output = array(
			'users_voted'     => $voting_block['users_voted'] == 'NaN' ? '0' : $voting_block['users_voted'],
			'number_of_stars' => $voting_block['number_of_stars'],
			'action_url'      => get_site_url() . '/wp-admin/admin-ajax.php?action=rating',
			'stars_id'        => $data['id'],
			'header_color'     => get_field('header_color', $id)
		); 
	}	
	return $output;
}

add_action('wp_ajax_rating', 'rating');
add_action('wp_ajax_nopriv_rating', 'rating');
function rating() 
{
	$get_rating = file_get_contents("php://input");
	$rating_args = json_decode($get_rating);
	if ($rating_args->type == 'term') {
		$result = update_term_meta( (int)$rating_args->starsId, "users_voted", $rating_args->newCounts + 1 );
	} else {
		$result = update_post_meta( (int)$rating_args->starsId, "voting_block_users_voted", $rating_args->newCounts + 1 );
	} 
	wp_die();
}