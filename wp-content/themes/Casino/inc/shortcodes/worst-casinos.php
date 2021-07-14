<?php

add_shortcode('worst-casinos', 'worst_casinos_func');

function worst_casinos_func($atts)
{
    // белый список параметров и значения по умолчанию
    $atts = shortcode_atts([
        'sites' => '',
    ], $atts);

    $q_args = [
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'post_type'      => 'worst-casinos',
    ];

    if (!empty($atts['sites'])) {
      $q_args['post__in'] = explode(',',$atts['sites']);
    } else {
      $q_args['orderby'] = 'date';
      $q_args['order']   = 'DESC';
    }

    $context['worst_casinos'] = new WP_Query($q_args);
    return Timber::compile('/templates/shortcodes/worst-casinos.twig', $context);
}
