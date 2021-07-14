<?php
add_action('wp_ajax_get_bonuses', 'get_bonuses_fnc');
add_action('wp_ajax_nopriv_get_bonuses', 'get_bonuses_fnc');

function get_bonuses_fnc()
{
    $get_request = file_get_contents("php://input");
    $request     = json_decode($get_request, true);

    $bonuses = get_bonuses($request['page'], $request['checked_filters']);

    $bonuses_items = [];
    if (!empty($bonuses['items'])) {
        foreach ($bonuses['items'] as $post) {
            $context['bonus'] = $post;
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

function get_bonuses($page = 1, $filters_data = [])
{
    $posts_per_page = 9;

    $paged = isset($page) ? $page : 1;

    $base_args = [
        'post_type'      => 'casino-bonuses',
        'post_status'    => 'publish',
        'fields'         => 'ids',
        'paged'          => $paged,
        'posts_per_page' => $posts_per_page,
        'meta_key'       => 'rating',
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC',
        'meta_query'     => [
            'relation' => 'AND',
            [
                'key'     => 'hide_from_tables',
                'value'   => '1',
                'compare' => '!=',
            ],
        ],
        'tax_query'      => [
            'relation' => 'AND',
        ],
    ];

    foreach ($filters_data as $taxonomys) {
        foreach ($taxonomys as $taxonomy_name => $terms) {
            if (!empty($terms)) {
                $base_args['tax_query'][] = [
                    'taxonomy' => $taxonomy_name,
                    'field'    => 'id',
                    'terms'    => $terms,
                ];
            }
        }
    }

    $brands_query = new WP_Query($base_args);

    $pagination    = false;
    $bonuses_items = [];

    if ($brands_query->posts) {
        $bonuses_items = $brands_query->posts;
        $pagination    = $paged < $brands_query->max_num_pages;
    }

    $return_date = [
        'items'      => $bonuses_items,
        'pagination' => (boolean)$pagination,
    ];

    return $return_date;
}

function get_bonuses_filters_list()
{
    $filters_list = [];
    $taxonomies   = get_object_taxonomies('casino-bonuses');
    foreach ($taxonomies as $k => $taxonomy) {
        $taxonomy_details                   = get_taxonomy($taxonomy);
        $filters_list[$k]['taxonomy_name']  = $taxonomy;
        $filters_list[$k]['taxonomy_label'] = $taxonomy_details->label;
        $terms                              = get_terms(['taxonomy' => [$taxonomy], 'hide_empty' => true]);
        foreach ($terms as $j => $tax) {
            $filters_list[$k]['items'][$j]['term_id']   = $tax->term_id;
            $filters_list[$k]['items'][$j]['name']      = $tax->name;
            $filters_list[$k]['items'][$j]['slug']      = $tax->slug;
            $filters_list[$k]['items'][$j]['hide_term'] = get_field('hide_term_in_filters', $tax);
        }
    }
    return $filters_list;
}
