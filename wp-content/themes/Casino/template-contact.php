<?php
/*
 * Template Name: Contact page
 */ 

$context = Timber::get_context();
$context['post'] = new TimberPost();

Timber::render('templates/template-contact.twig', $context );