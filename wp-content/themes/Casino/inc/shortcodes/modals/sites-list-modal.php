<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';

$custom_tables       = [];
$custom_tables_posts = new WP_Query([
    'post_type'      => 'custom_tables',
    'posts_per_page' => -1,
]);
if (!empty($custom_tables_posts->posts)) {
    foreach ($custom_tables_posts->posts as $post) {
        $custom_tables[] = [
            'value' => (string)$post->ID,
            'label' => $post->post_title . ' (' . $post->ID . ')',
        ];
    }
}

$sites_list  = [];
$sites_posts = get_all_brands(['posts_per_page' => -1]);
if (!empty($sites_posts['items'])) {
    foreach ($sites_posts['items'] as $post_id) {
        $sites_list[] = [
            'value' => (string)$post_id,
            'label' => get_the_title($post_id) . ' (' . $post_id . ')',
        ];
    }
}

$context['sites_list']    = json_encode($sites_list);
$context['custom_tables'] = json_encode($custom_tables);
Timber::render('templates/shortcodes/modals/sites-list-modal.twig', $context);
