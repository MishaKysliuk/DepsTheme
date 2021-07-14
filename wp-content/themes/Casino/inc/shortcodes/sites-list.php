<?php
add_shortcode('sites-list', 'sites_list_func');

function sites_list_func($atts)
{
    // белый список параметров и значения по умолчанию
    $atts = shortcode_atts([
        'sites'      => '',
        'table_id'   => '',
        'aff_key'    => '',
        'show_thead' => '',
    ], $atts);

    $brands = [];
    $q_args = [];

    if (!empty($atts['sites'])) {
        $brands = get_all_brands([
            'post__in' => explode(',', $atts['sites']),
        ]);
        $q_args = [
            'post__in'           => $atts['sites'],
            'continue_by_rating' => '',
        ];
    } elseif (empty($atts['sites']) && !empty($atts['table_id'])) {
        $q_args = [
            'maximum_items'      => get_field('total_number', $atts['table_id']),
            'posts_per_page'     => get_field('number_to_show_more', $atts['table_id']) ? get_field('number_to_show_more', $atts['table_id']) : get_field('default_number_to_show_more', 'option'),
            'post__in'           => get_field('sites_list', $atts['table_id']),
            'continue_by_rating' => get_field('continue_by_rating', $atts['table_id']),
        ];
        $brands = get_all_brands($q_args);
    } elseif (empty($atts['sites']) && empty($atts['table_id']) && is_tax() ) {
        $query_object = get_queried_object();
        $q_args       = [
            'posts_per_page' => get_field('default_number_to_show_more', 'option'),
            'taxonomy_args'  => [
                'taxonomy_name' => $query_object->taxonomy,
                'term_id'       => $query_object->term_id,
            ],
        ];
        $brands = get_all_brands($q_args);
    } else {
        $q_args = [
            'posts_per_page' => get_field('default_number_to_show_more', 'option'),
        ];
        $brands = get_all_brands($q_args);
    }

    $context['shortcode_atts'] = json_encode($atts);
    $context['q_args']         = json_encode($q_args);
    $context['sites_list']     = $brands;
    $context['show_thead']     = $atts['show_thead'];
    $context['pagination']     = $brands['pagination'];
    $context['aff_key']        = $atts['aff_key'];
    return Timber::compile('/templates/shortcodes/sites-list.twig', $context);
}

add_action('wp_ajax_get_sites_list', 'get_sites_list');
add_action('wp_ajax_nopriv_get_sites_list', 'get_sites_list');

function get_sites_list()
{
    $get_request = file_get_contents("php://input");
    $request     = json_decode($get_request, true);

    $q_args          = $request['q_args'];
    $q_args['paged'] = $request['page'];
    $brands          = get_all_brands($q_args);

    $brend_items_template = '';
    $brand_index          = ($q_args['paged'] - 1) * $request['q_args']['posts_per_page'];
    if (!empty($brands['items'])) {
        $brend_items_template = '<transition-group name="slide-down" mode="out-in" tag="tbody">';
        foreach ($brands['items'] as $key => $post) {
            $brand_index++;
            if (!isset($q_args['maximum_items']) || $brand_index <= $q_args['maximum_items']) {
                $context['brand']         = $post;
                $context['aff_key']       = isset($q_args['aff_key']) ? $q_args['aff_key'] : '';
                $context['loop']['index'] = $brand_index;
                $brend_items_template .= Timber::compile('/templates/parts/casino-item.twig', $context);
            }
        }
        $brend_items_template .= '</transition-group>';
    }
    $brend_items[] = $brend_items_template;

    wp_send_json([
        "code" => 200,
        "data" => [
            'items'      => $brend_items,
            'pagination' => $brands['pagination'],
        ],
    ]);
}
