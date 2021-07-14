<?php
add_shortcode('button', 'button_func');

function button_func($atts)
{
    $atts = shortcode_atts([
        'title'     => '',
        'text'      => '',
        'image'     => '',
        'alt'       => '',
        'font-icon' => '',
        'color'     => '',
        'link'      => '',
        'target'    => '',
    ], $atts);

    $GLOBALS['buttons'][] = $atts;

    $context['atts'] = $atts;
    return Timber::compile('/templates/shortcodes/button.twig', $context);
}

add_shortcode('buttons-group', 'buttons_group_func');

function buttons_group_func($atts, $content)
{

  $GLOBALS['buttons'] = [];
  do_shortcode($content);
  $context['buttons'] = $GLOBALS['buttons'];
  return Timber::compile('/templates/shortcodes/buttons-gtoup.twig', $context);
}
