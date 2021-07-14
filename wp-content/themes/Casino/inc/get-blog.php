<?php
// Blog //

add_action('wp_ajax_get_next_blog_page', 'get_next_blog_page');
add_action('wp_ajax_nopriv_get_next_blog_page', 'get_next_blog_page');

function get_next_blog_page()
{
    $get_request = file_get_contents("php://input");
    $request     = json_decode($get_request, true);

    $articles = get_articles($request['page']);
    $articles_items = [];
    if ($articles['items']) {
        foreach ($articles['items'] as $post) {
            $context['article'] = $post;
            $articles_items[]   = Timber::compile('/templates/parts/article-card.twig', $context);
        }
    }

    wp_send_json([
        "code" => 200,
        "data" => [
            'items'      => $articles_items,
            'pagination' => $articles['pagination'],
        ],
    ]);
}

function get_articles($paged = 1, $posts_per_page = 9) {
    $q_args = [
        'post_type'      => 'blog',
        'post_status'    => 'publish',
        'orderby'        => 'modified',
        'order'          => 'DESC',
        'posts_per_page' => $posts_per_page,
        'paged'          => $paged,
        'fields'         => 'ids',
    ];
    
    $articles_query = new WP_Query($q_args);

    $pagination    = false;
    $bonuses_items = [];

    if ($articles_query->posts) {
        $bonuses_items = $articles_query->posts;
        $pagination    = $paged < $articles_query->max_num_pages;
    }

    $return_date = [
        'items'      => $bonuses_items,
        'pagination' => (boolean)$pagination,
    ];

    return $return_date;
}



function get_latest_articles($row)
{
    $latest_articles = [];

    $q_args = [
        'post_type'      => 'blog',
        'post_status'    => 'publish',
        'fields'         => 'ids',
    ];
    if ( $row['default_values'] ) {
        $q_args['orderby'] = 'modified';
        $q_args['order'] = 'DESC';
        $q_args['posts_per_page'] = 3;
    } else {
        $q_args['posts_per_page'] = -1;
        $q_args['post__in'] = $row['custom_articles'];
    }

    $articles_query = new WP_Query($q_args);
    if ( $articles_query->posts ) {
        $latest_articles = $articles_query->posts;
    }

    return $latest_articles;
}
