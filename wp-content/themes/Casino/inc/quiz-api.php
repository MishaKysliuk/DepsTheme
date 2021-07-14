<?php 
// QUIZE API //

// Регаем API сылку 
add_action( 'rest_api_init', function () {
	register_rest_route( 'quiz/v1', '/next/(?P<id>\d+)', array(
	  'methods' => 'GET',
	  'callback' => 'return_questions',
	) );
	register_rest_route( 'quiz/v1', '/last/(?P<id>\d+)/((?P<last_id>\d+))', array(
	  'methods' => 'GET',
	  'callback' => 'return_last_questions',
	) );
});

// Формируем API сылку
function get_api_link($id, $last_id=null)
{
	if($last_id == null){
		return get_home_url() . "/wp-json/quiz/v1/next/$id";
	} else {
		return get_home_url() . "/wp-json/quiz/v1/last/$id/$last_id";
	}
}

// Отдаем вопрос
function return_questions($data)
{
	$quiz_id = $data['id'];

	if (get_post_type($quiz_id) == false || get_post_type($quiz_id) != 'quiz') {
		return 'Error';
	}

	$quiz['questions'] = get_field('questions', $quiz_id);
	
	$answers = get_field('answers', $quiz_id);
	foreach ($answers as $key => $answer) {
		$quiz['answers'][$key]['answer'] = $answer['answer'];
		$quiz['answers'][$key]['button_color'] = $answer['button_color'];
		if ($answer['next_or_last_step'] == 'last') {
			$quiz['answers'][$key]['api_link'] = get_api_link($answer['last_step'], $quiz_id);
		} else {
			$quiz['answers'][$key]['api_link'] = get_api_link($answer['next_step']);
		}
	}

	$quiz['steps_to_end'] = steps_to_end($quiz_id);

	return $quiz;
}

// Отдаем последний слайд
function return_last_questions($data)
{
	$quiz_id = $data['id'];
	$last_id = $data['last_id'];

	if (get_term_by('id', $quiz_id, 'payment-methods') == false) {
		return 'Error!';
	}
	
	$args = array(
		'post_type'      => 'casinos',
		'posts_per_page' => 3,
		'meta_key'       => 'voting_block_rating',
		'orderby'        => 'meta_value_num',
		'order'          => 'DESC',
		'tax_query'      => array(
			array(
				'taxonomy' => 'payment-methods',
				'field'    => 'id',
				'terms'    => array( $quiz_id )
			)
		)
	);
	
	$output = array();
	$casino = array();

	$the_query = new WP_Query( $args );

	while ( $the_query->have_posts() ) : $the_query->the_post();
		
		$voting_block = get_field('voting_block');
		$casino_bonus_block = get_field('casino_bonus_block');
		$feature_block = get_field('feature_block');
		
		$casino[] = array(
			'id' 		   	   => get_the_ID(),
			'title' 		   => get_the_title(),
			'rating' 		   => $voting_block['rating'],
			'number_of_stars'  => $voting_block['number_of_stars'],
			'users_voted' 	   => $voting_block['users_voted'],
			'bonus_percent'    => $casino_bonus_block['bonus_percent'],
			'bonus' 		   => $casino_bonus_block['bonus'],
			'additional_bonus' => $casino_bonus_block['additional_bonus'],
			'type' 			   => 'casinos',
			'feature_1'        => $feature_block['feature_1'],
			'feature_2' 	   => $feature_block['feature_2'],
			'feature_3'        => $feature_block['feature_3'],
			'website_adress'   => get_field('website_adress'),
			'ref_link'         => get_field('ref_link'),
			'logo'             => get_field('logo'),
			'color'            => get_field('background_color'),
		);

	endwhile;
		
	$output['casinos'] = $casino;
	$output['check_all_link'] = get_term_link((int)$quiz_id, 'payment-methods');
	$last_answers = get_field('answers', $last_id);
	foreach ($last_answers as $key => $value) {
		if ($value['last_step'] == $quiz_id) {
			$output['last_title'] = $value['last_slide_title'];
			$output['button_name'] = $value['button_name_for_last_step'];
		}
	}
	
	return $output;
}

// Find steps to end //
function steps_to_end($id)
{
	$tree = build_tree($id);
	$max_level = array_depth($tree);
	return $max_level;
}

function array_depth(array $array) 
{
	$max_depth = 1;
	foreach ($array as $value) {
		if (is_array($value)) {
			$depth = array_depth($value) + 1;
			if ($depth > $max_depth) {
				$max_depth = $depth;
			}
		}
	}
	return $max_depth;
}

function build_tree( $id ) 
{
	$tree = array();
	$answers = get_field('answers', $id);
	foreach ($answers as $key => $answer) {
		if($answer['next_or_last_step'] === 'next') {
			$tree[$answer['next_step']] = build_tree($answer['next_step']);
		} else {
			$tree[$answer['last_step']] = 'last';
		}
	}
	return $tree;
}