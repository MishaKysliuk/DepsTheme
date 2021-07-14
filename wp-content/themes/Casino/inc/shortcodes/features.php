<?php

add_shortcode('features_small', 'features_small_func');
add_shortcode('features_medium', 'features_medium_func');
add_shortcode('features_large', 'features_large_func');
add_shortcode('features_xl', 'features_xl_func');
add_shortcode('feature', 'feature_func');
add_shortcode('features_text', 'features_text_func');



function features_small_func($atts, $content)
{
    $atts = shortcode_atts([
        'title' => '',
        'color' => '',
    ], $atts);

    $GLOBALS['features'] = [];
    $GLOBALS['features_text'] = '';
    
    do_shortcode($content);

    $context['features'] = $GLOBALS['features'];
    $context['features_text'] = $GLOBALS['features_text'];
    $context['atts'] = $atts;
    return Timber::compile('/templates/shortcodes/features-small.twig', $context);
}

function features_medium_func($atts, $content)
{
    $atts = shortcode_atts([
        'title' => '',
    ], $atts);

    $GLOBALS['features'] = [];
    $GLOBALS['features_text'] = '';

    do_shortcode($content);

    $context['features'] = $GLOBALS['features'];
    $context['features_text'] = $GLOBALS['features_text'];
    $context['atts'] = $atts;
    return Timber::compile('/templates/shortcodes/features-medium.twig', $context);
}

function features_large_func($atts, $content)
{
    $atts = shortcode_atts([
        'title' => '',
    ], $atts);

    $GLOBALS['features'] = [];
    $GLOBALS['features_text'] = '';

    do_shortcode($content);

    $context['features'] = $GLOBALS['features'];
    $context['features_text'] = $GLOBALS['features_text'];
    $context['atts'] = $atts;
    return Timber::compile('/templates/shortcodes/features-large.twig', $context);
}

function features_xl_func($atts, $content)
{
    $atts = shortcode_atts([
        'title' => '',
    ], $atts);

    $GLOBALS['features'] = [];
    $GLOBALS['features_text'] = '';

    do_shortcode($content);

    $context['features'] = $GLOBALS['features'];
    $context['features_text'] = $GLOBALS['features_text'];
    $context['atts'] = $atts;
    return Timber::compile('/templates/shortcodes/features-xl.twig', $context);
}

function feature_func($atts)
{
    $atts = shortcode_atts([
        'title'     => '',
        'text'      => '',
        'image'     => '',
        'alt'       => '',
        'font-icon' => '',
        'color'     => '',
    ], $atts);

    $GLOBALS['features'][] = $atts;

    return '';
}

function features_text_func($atts, $content)
{
    $GLOBALS['features_text'] = $content;

    return '';
}
