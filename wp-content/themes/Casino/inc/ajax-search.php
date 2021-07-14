<?php

add_action('wp_ajax_ajax_search', 'ajax_search');
add_action('wp_ajax_nopriv_ajax_search', 'ajax_search');
function ajax_search()
{
    $get_request    = file_get_contents("php://input");
    $search_request = json_decode($get_request);
    if (!empty($search_request->request)) {
        $request = wp_kses_post($search_request->request);

        $search_result   = array();
        $results_from_db = get_results_from_db($request);

        foreach ($results_from_db as $key => $value) {
            if ($value->name) {
                $search_result[$key]['name'] = $value->name;
                $search_result[$key]['link'] = get_term_link((int)$value->term_id);
            } elseif ($value->post_title) {
                $search_result[$key]['name'] = $value->post_title;
                $search_result[$key]['link'] = get_permalink($value->ID);
            }
        }
    }

    if (empty($search_result)) {
        echo 'null';
    } else {
        echo wp_json_encode($search_result);
    }

    wp_die();
}

function get_results_from_db($request)
{
    global $wpdb;
    $request = ' \'%' . $request . '%\'';

    $get_tax = $wpdb->get_results("
			SELECT wp_terms.name, wp_terms.term_id FROM wp_terms
			LEFT JOIN wp_term_taxonomy USING(term_id)
			WHERE wp_terms.name LIKE $request
			AND (wp_term_taxonomy.taxonomy = 'payment-methods' OR
                wp_term_taxonomy.taxonomy =  'casino-types' OR
				wp_term_taxonomy.taxonomy =  'casino-games' OR
				wp_term_taxonomy.taxonomy =  'currencies' OR
				wp_term_taxonomy.taxonomy =  'minimum-deposit' OR
				wp_term_taxonomy.taxonomy =  'casino-types' OR
				wp_term_taxonomy.taxonomy = 'casino-games')
		");

    $get_post = $wpdb->get_results("
		SELECT post_title, ID FROM wp_posts
		WHERE post_status = 'publish'
		AND (post_type = 'page' OR post_type = 'blog' OR post_type = 'casinos')
		AND post_title LIKE $request
	");

    return array_merge($get_tax, $get_post);
}
