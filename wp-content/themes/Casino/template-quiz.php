<?php
/*
 * Template Name: Quiz
 */ 

$context = Timber::get_context();
$context['post'] = new TimberPost();

Timber::render('templates/template-quiz.twig', $context );