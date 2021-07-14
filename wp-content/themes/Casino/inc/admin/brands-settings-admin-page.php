<?php

add_action('admin_menu', 'register_brands_settings_submenu_page');

function register_brands_settings_submenu_page()
{
    add_submenu_page(
        'edit.php?post_type=casinos',
        'Brands Settings',
        'Brands Settings',
        'manage_options',
        'brands-Settings',
        'brands_settings_submenu_page_callback'
    );
}

function brands_settings_submenu_page_callback()
{
    $context               = Timber::get_context();
    $context['page_title'] = get_admin_page_title();

    $args = [
        'post_type'      => 'casinos',
        'posts_per_page' => -1,
        'meta_key'       => 'voting_block_rating',
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC',
        'fields'         => 'ids',
    ];

    $brands_query = new WP_Query($args);

    $context['page_type'] = 'brand';
    $context['tables_items'] = $brands_query->posts;

    Timber::render('templates/admin-page/brands-settings-admin-page.twig', $context);

}
