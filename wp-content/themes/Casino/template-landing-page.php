<?php
/*
 * Template Name: Landing page
 */ 

$context = Timber::get_context();
$context['post'] = new TimberPost();

$display_options = get_field('display_options');
$table_id = '';
if($display_options === 'castom_tables') {
  $table_id = get_field('custom_tables');
}
$context['display_options'] = $display_options;
$aff_key = get_field('aff_key');
$context['shortcode_args'] = '[sites-list table_id="' . $table_id . '" aff_key="' . $aff_key . '" show_thead="true"]';


Timber::render('templates/template-landing-page.twig', $context );