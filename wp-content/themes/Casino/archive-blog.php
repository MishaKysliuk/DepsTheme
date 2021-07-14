<?php
/*
 * Template Name: Blog
 */ 

$context = Timber::get_context();
$context['post'] = new TimberPost();

$articles = get_articles();

$context['articles'] = $articles['items'];
$context['pagination'] = $articles['pagination'];
Timber::render('templates/archive-blog.twig', $context );