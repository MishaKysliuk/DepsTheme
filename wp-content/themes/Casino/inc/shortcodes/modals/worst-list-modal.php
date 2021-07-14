<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';

$sites_posts = new WP_Query([
    'post_type'      => 'worst-casinos',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
]);

$sites_list  = [];
if ($sites_posts->posts) {
    foreach ($sites_posts->posts as $post) {
        $sites_list[] = [
            'value' => (string)$post->ID,
            'label' => get_the_title($post->ID) . ' (' . $post->ID . ')',
        ];
    }
}

$context['sites_list']    = json_encode($sites_list);

Timber::render('templates/shortcodes/modals/worst-list-modal.twig', $context);
