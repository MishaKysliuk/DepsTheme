<?php
/*
 * Template Name: All authors
 */ 

$context = Timber::get_context();
$context['post'] = new TimberPost();

Timber::render('templates/template-all-authors.twig', $context );