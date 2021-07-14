<?php
/*
 * Template Name: Casino Reviews
 */ 

$context = Timber::get_context();
$context['aff_key'] = get_field('aff_key');
$context['post'] = new TimberPost();

Timber::render('templates/template-reviews.twig', $context );