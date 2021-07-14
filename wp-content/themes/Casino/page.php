<?php

$context = Timber::get_context();
$timber_post = Timber::query_post();
$context['post'] = $timber_post;

Timber::render( array( 'templates/singpagele-' . $timber_post->ID . '.twig', 'templates/page-' . $timber_post->post_type . '.twig', 'templates/page.twig' ), $context );