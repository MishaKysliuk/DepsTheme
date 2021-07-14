<?php

$context = Timber::get_context();
$timber_post = Timber::query_post();
$context['post'] = $timber_post;

if ($timber_post->post_type == 'blog') {
	$args = array(
		'post_type' 	 => 'blog',
		'posts_per_page' => 3,
		'orderby'		 => 'date', 
		'order'          => 'DESC',
		'post__not_in' 	 => array($timber_post->ID),
	);
	$context['blog'] = new Timber\PostQuery( $args );
}	

Timber::render( array( 'templates/single-' . $timber_post->ID . '.twig', 'templates/single-' . $timber_post->post_type . '.twig', 'templates/single.twig' ), $context );