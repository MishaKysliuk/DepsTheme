<?php
/*
 * Template Name: Casino bonuses
 */ 

$context = Timber::get_context();
$context['post'] = new TimberPost();

$active_filters = [];


$bonuses = get_bonuses();
$context['header_color'] = get_field('header_color');
$context['title'] = get_field('title');
$context['descriptions'] = get_field('descriptions');
$context['list'] = get_field('list');
$context['image'] = get_field('logo');
$context['bonuses_filtres_title'] = get_field('bonuses_filtres_title');
$context['filters_list'] = json_encode(get_bonuses_filters_list());
$context['active_filters'] = json_encode($active_filters);
$context['bonuses'] = $bonuses['items'];
$context['pagination'] = $bonuses['pagination'];
$context['aff_key'] = get_field('affiliate_key');
wp_reset_postdata();
Timber::render('templates/casino-bonuses.twig', $context );