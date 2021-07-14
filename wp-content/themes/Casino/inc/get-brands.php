<?php
add_action('wp_ajax_get_brands', 'get_brands_next_page');
add_action('wp_ajax_nopriv_get_brands', 'get_brands_next_page');

function get_brands_next_page()
{
    $get_request = file_get_contents("php://input");
    $request     = json_decode($get_request, true);

    $brands = get_all_brands([
        'paged'          => $request['page'],
        'maximum_items'  => $request['maximum_item'],
        'posts_per_page' => $request['items_per_page'],
    ]);

    $brend_items = [];
    if (!empty($brands['items'])) {
        foreach ($brands['items'] as $post) {
            $context['post'] = $post;
            $brend_items[]   = Timber::compile('/templates/parts/brands-item.twig', $context);
        }
    }

    wp_send_json([
        "code" => 200,
        "data" => [
            'items'      => $brend_items,
            'pagination' => $brands['pagination'],
        ],
    ]);
}

function get_all_brands($sortcode_args = [])
{
    $default_shortcode_args = [
        'paged'              => 1,
        'maximum_items'      => '',
        'posts_per_page'     => '',
        'post__in'           => '',
        'continue_by_rating' => false,
        'taxonomy_args'      => '',
    ];

    $args = array_merge($default_shortcode_args, $sortcode_args);

    
    if($args['maximum_items']) {
        if($args['maximum_items'] < $args['posts_per_page']) {
            $args['posts_per_page'] = $args['maximum_items'];
        }
    }

    $base_args = [
        'post_type'   => 'casinos',
        'post_status' => 'publish',
        'fields'      => 'ids',
    ];

    if (get_the_ID() === get_field('review_page', 'option')) {
        $base_args['meta_query']  = [
            [
                'key'     => 'hide_from_review_page',
                'value'   => '1',
                'compare' => '!=',
            ],
        ];
    } else {
        $base_args['meta_query']  = [
            [
                'key'     => 'hide_from_tables',
                'value'   => '1',
                'compare' => '!=',
            ],
        ];
    }

    if (true === $args['continue_by_rating']) {

        $q_sites_list_args = [
            'post__in'       => $args['post__in'],
            'orderby'        => 'post__in',
            'posts_per_page' => -1,
        ];
        $q_sites_list = new WP_Query(array_merge($base_args, $q_sites_list_args));

        $q_all_brand_args = [
            'post__not_in'   => $args['post__in'],
            'posts_per_page' => -1,
            'orderby'        => 'post__in',
            'meta_key'       => 'voting_block_rating',
            'orderby'        => 'meta_value_num',
            'order'          => 'ASC',
        ];
        
        $query_object = get_queried_object();
        if(isset($query_object->taxonomy)) {  
            $q_all_brand_args['tax_query'] = [
                [
                    'taxonomy' => $query_object->taxonomy,
                    'field'    => 'id',
                    'terms'    => $query_object->term_id,
                ],
            ];
        }
        

        $q_all_brand = new WP_Query(array_merge($base_args, $q_all_brand_args));
        
        
        $args['post__in'] = array_merge($q_sites_list->posts, $q_all_brand->posts);

    }

    $base_args['posts_per_page'] = $args['posts_per_page'];
    $base_args['paged']          = $args['paged'];

    if (!empty($args['post__in'])) {
        $base_args['post__in'] = $args['post__in'];
        $base_args['orderby']  = 'post__in';
    } else {
        if (!empty($args['taxonomy_args'])) {
            $base_args['tax_query'] = [
                [
                    'taxonomy' => $args['taxonomy_args']['taxonomy_name'],
                    'field'    => 'id',
                    'terms'    => $args['taxonomy_args']['term_id'],
                ],
            ];
        }

        $base_args['meta_key'] = 'voting_block_rating';
        $base_args['orderby']  = 'meta_value_num';
        $base_args['order']    = 'ASC';
    }

    if(wp_is_mobile()) {
        $brands_hidden_on_mobile = get_brands_hidden_on_mobile();
        $base_args['post__not_in'] = $brands_hidden_on_mobile;
    }

    $brands_query = new WP_Query($base_args);

    $max_page = $args['maximum_items'] ? $args['maximum_items'] : $brands_query->found_posts;

    $pagination  = false;
    $brend_items = [];
    if ($brands_query->posts) {
        $brend_items = $brands_query->posts;
        if (($args['paged'] < $brands_query->max_num_pages) &&
            ($args['paged'] * $args['posts_per_page'] < $max_page)) {
            $pagination = true;
        }
    }

    $return_date = [
        'items'      => $brend_items,
        'pagination' => (boolean)$pagination,
    ];

    return $return_date;
}


function get_brands_hidden_on_mobile() {
    $args = [
        'post_type'      => 'casinos',
        'post_status'    => 'publish',
        'fields'         => 'ids',
        'posts_per_page' => -1,
        'meta_query'     => [
            'relation' => 'AND',
            [
                'key'     => 'hide_from_mobile',
                'value'   => '1',
                'compare' => '==',
            ],
        ],
    ];

    $brands_query = new WP_Query($args);
    return $brands_query->posts;
}