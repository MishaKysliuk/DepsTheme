<?php
/*
 * Template Name: Casino Methods
 */ 

$context = Timber::get_context();
$context['post'] = new TimberPost();
$taxonomy_slug = get_field('taxonomy');
$context['taxonomy_metod'] = get_field('terms_' . $taxonomy_slug);

Timber::render('templates/template-casino-methods.twig', $context );