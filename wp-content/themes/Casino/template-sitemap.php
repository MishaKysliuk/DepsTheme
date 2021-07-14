<?php
/*
 * Template Name: Sitemap
 */ 

$context = Timber::get_context();
$context['post'] = new TimberPost();

$blog_args = array(
	'post_type'    => 'blog',
	'post_status'  => 'publish',
	'posts_per_page' => -1
);
$context['blog'] = new Timber\PostQuery( $blog_args );

$authors_args = array(
	'post_type'    => 'authors',
	'post_status'  => 'publish',
	'posts_per_page' => -1
);
$context['authors'] = new Timber\PostQuery( $authors_args );

$page_args = array(
	'post_type'     => 'page',
	'post_status'   => 'publish',
	'post__not_in'  => [get_the_ID()],
	'posts_per_page' => -1
);
$context['page'] = new Timber\PostQuery( $page_args );

$casinos_args = array(
	'post_type'    => 'casinos',
	'post_status'  => 'publish',
	'posts_per_page' => -1
);
$context['casinos'] = new Timber\PostQuery( $casinos_args );

$taxonomies_casino   = get_object_taxonomies('casinos', 'objects');
$taxonomies_casino_bonuses   = get_object_taxonomies('casino-bonuses', 'objects');

foreach ( $taxonomies_casino as $taxonomies ) {
	$context['taxonomies_casino'][] = [
		'name' => $taxonomies->label,
		'terms' => get_terms( $taxonomies->name, array( 'hide_empty' => 1) ),
	];
}

foreach ( $taxonomies_casino_bonuses as $taxonomies ) {
	$context['taxonomies_casino_bonuses'][] = [
		'name' => $taxonomies->label,
		'terms' => get_terms( $taxonomies->name, array( 'hide_empty' => 1) ),
	];
}

Timber::render('templates/template-sitemap.twig', $context );