<?php

add_action('admin_menu', 'register_bonuses_settings_submenu_page');

function register_bonuses_settings_submenu_page()
{
    add_submenu_page(
        'edit.php?post_type=casino-bonuses',
        'Bonuses Settings',
        'Bonuses Settings',
        'manage_options',
        'bonuses-settings',
        'bonuses_settings_submenu_page_callback'
    );
}

function bonuses_settings_submenu_page_callback()
{
    $context               = Timber::get_context();
    $context['page_title'] = get_admin_page_title();

    $args = [
        'post_type'      => 'casino-bonuses',
        'posts_per_page' => -1,
        'meta_key'       => 'rating',
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC',
        'fields'         => 'ids',
    ];

    $bonus_query = new WP_Query($args);

    $context['page_type'] = 'bonuses';
    $context['tables_items'] = $bonus_query->posts;

    Timber::render('templates/admin-page/brands-settings-admin-page.twig', $context);

}
