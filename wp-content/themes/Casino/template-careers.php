<?php
/*
 * Template Name: Careers
 */ 

$context = Timber::get_context();
$context['post'] = new TimberPost();


Timber::render('templates/template-careers.twig', $context );