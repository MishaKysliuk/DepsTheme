<?php
/*
 * Template Name: How We Rate?
 */ 

$context = Timber::get_context();
$context['post'] = new TimberPost();


Timber::render('templates/template-how-we-rate.twig', $context );