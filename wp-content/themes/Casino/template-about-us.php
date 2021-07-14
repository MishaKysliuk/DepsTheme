<?php
/*
 * Template Name: About us
 */ 

$context = Timber::get_context();
$context['post'] = new TimberPost();


Timber::render('templates/template-about-us.twig', $context );