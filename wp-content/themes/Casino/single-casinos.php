<?php
$context = Timber::get_context();
$context['post'] = new TimberPost();

Timber::render('templates/single-casinos.twig', $context );