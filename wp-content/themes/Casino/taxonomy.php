<?php 

$context = Timber::get_context();
$context['term'] = new Timber\Term();

$queried_object = get_queried_object();
$taxonomies = get_object_taxonomies('casino-bonuses');

if (in_array($queried_object->taxonomy, $taxonomies)) {
	$active_filters[] = [$queried_object->taxonomy => [$queried_object->term_id]];
	$bonuses = get_bonuses(1, $active_filters);
	$context['header_color'] = get_field('header_color');
	$context['title'] = get_field('full_name');
	$context['descriptions'] = term_description($queried_object->term_id);
	$context['list'] = get_field('list');
	$context['image'] = get_field('image');
	$context['bonuses_filtres_title'] = get_field('bonuses_filtres_title');
	$context['aff_key'] = get_field('affiliate_key');
	$context['filters_list'] = json_encode(get_bonuses_filters_list());
	$context['active_filters'] = json_encode($active_filters);
	$context['bonuses'] = $bonuses['items'];
	$context['pagination'] = $bonuses['pagination'];
	wp_reset_postdata();
	Timber::render('templates/casino-bonuses.twig', $context );

} else {
	$context['descriptions'] = term_description($queried_object->term_id);
	$display_options = get_field('display_options');
	$table_id = '';
	if($display_options === 'castom_tables') {
		$table_id = get_field('custom_tables');
	}
	$context['display_options'] = $display_options;
	$aff_key = get_field('aff_key');
	$context['shortcode_args'] = '[sites-list table_id="' . $table_id . '" aff_key="' . $aff_key . '" show_thead="true"]';
	
	
	Timber::render( 'templates/taxonomy.twig', $context );
}


