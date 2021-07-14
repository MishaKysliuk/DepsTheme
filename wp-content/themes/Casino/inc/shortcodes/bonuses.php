<?php

add_shortcode('bonuses', 'bonuses_func');

function bonuses_func($atts)
{
    // белый список параметров и значения по умолчанию
    $atts = shortcode_atts([
        'bonuses'   => '',
        'casino-id' => '',
        'aff_key' => '',
    ], $atts);

    $bonuses = get_shortcode_bonuses_items('1', $atts);

    $context['shortcode_atts'] = json_encode($atts);
    $context['pagination']     = $bonuses['pagination'];
    $context['bonuses']        = $bonuses['items'];
    $context['aff_key']        = $atts['aff_key'];
    return Timber::compile('/templates/shortcodes/bonuses.twig', $context);
}

function get_shortcode_bonuses_items($page = 1, $atts)
{
    $q_args = [
        'posts_per_page' => 9,
        'post_status'    => 'publish',
        'post_type'      => 'casino-bonuses',
        'fields'         => 'ids',
        'paged'          => $page,
        'meta_query'     => [
            'relation' => 'AND',
            [
                'key'     => 'hide_from_tables',
                'value'   => '1',
                'compare' => '!=',
            ],
        ],
    ];

    if (!empty($atts['bonuses'])) {
        $q_args['post__in'] = explode(',', $atts['bonuses']);
    }

    if (!empty($atts['casino-id'])) {
        $q_args['meta_key']   = 'brand';
        $q_args['meta_value'] = $atts['casino-id'];
        $q_args['orderby']    = 'date';
        $q_args['order']      = 'DESC';
    }

    $bonuses_query = new WP_Query($q_args);

    $bonuses    = [];
    $pagination = false;
    if ($bonuses_query->posts) {
        $bonuses['pagination'] = $page < $bonuses_query->max_num_pages;
        $bonuses['items']      = $bonuses_query->posts;
    }

    return $bonuses;

}


add_action('wp_ajax_get_bonuses_next_page', 'get_bonuses_next_page');
add_action('wp_ajax_nopriv_get_bonuses_next_page', 'get_bonuses_next_page');

function get_bonuses_next_page() {
    $get_request = file_get_contents("php://input");
    $request     = json_decode($get_request, true);

    $bonuses          = get_shortcode_bonuses_items($request['page'], $request['shortcode_atts']);

    $bonuses_items = [];

    
    if (!empty($bonuses['items'])) {
        foreach ($bonuses['items'] as $bonus_id) {
            $context['bonus'] = $bonus_id;
            $bonuses_items[]  = Timber::compile('/templates/parts/bonus-card.twig', $context);
        }
    }
    
    wp_send_json([
        "code" => 200,
        "data" => [
            'items'      => $bonuses_items,
            'pagination' => $bonuses['pagination'],
        ],
    ]);
}
