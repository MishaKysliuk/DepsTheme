<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';

$casinos_posts = new WP_Query([
    'post_type'      => 'casinos',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
]);

$bonuses_posts = new WP_Query([
    'post_type'      => 'casino-bonuses',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
]);

$casinos_list = [];
if ($casinos_posts->posts) {
    foreach ($casinos_posts->posts as $post) {
        $casinos_list[] = [
            'value' => (string)$post->ID,
            'label' => get_the_title($post->ID) . ' (' . $post->ID . ')',
        ];
    }
}

$bonuses_list = [];
if ($bonuses_posts->posts) {
    foreach ($bonuses_posts->posts as $post) {
        $bonuses_list[] = [
            'value' => (string)$post->ID,
            'label' => get_the_title($post->ID) . ' (' . $post->ID . ')',
        ];
    }
}

$context['casinos_list'] = json_encode($casinos_list);
$context['bonuses_list'] = json_encode($bonuses_list);

Timber::render('templates/shortcodes/modals/bonuses-modal.twig', $context);
