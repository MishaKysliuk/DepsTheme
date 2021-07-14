<?php

function get_breadcrumb()
{
    if (is_front_page()) {
        return;
    }

    $blog_id = get_option('page_for_posts');
    $front_page_id = get_option('page_on_front');

    $breadcrumb = [
        [
            'link'  => home_url(),
            'title' => get_the_title($front_page_id),
        ],
    ];

    if (is_archive() || is_tax()) {
        if (is_post_type_archive('blog')) {
            $breadcrumb[] = [
                'link'  => get_permalink($blog_id),
                'title' => get_the_title($blog_id),
            ];
        }

        if (is_tax()) {
            $queried_object = get_queried_object();
            $taxonomies   = get_object_taxonomies('casino-bonuses');
            if ( in_array($queried_object->taxonomy, $taxonomies) ) {
                $breadcrumb[]   = [
                    'link'  => get_permalink(get_field('casino_bonuses_page', 'option')),
                    'title' => __('Casino Bonuses', 'casino'),
                ];
            } 
            $breadcrumb[]   = [
                'link'  => get_term_link($queried_object->term_id),
                'title' => $queried_object->name,
            ];
            
        }
    }

    if (is_single()) {
        if (get_post_type() === 'post') {
            $breadcrumb[] = [
                'link'  => get_permalink($blog_id),
                'title' => get_the_title($blog_id),
            ];
        } elseif (get_post_type() === 'authors') {
            $breadcrumb[] = [
                'link'  => get_permalink(get_field('authors_page', 'option')),
                'title' => __('Authors', 'casino'),
            ];
        } elseif (get_post_type() === 'blog') {
            $breadcrumb[] = [
                'link'  => '/blog/',
                'title' => __('Blog', 'casino'),
            ];
        } elseif (get_post_type() === 'casinos') {
            $breadcrumb[] = [
                'link'  => get_permalink(get_field('review_page', 'option')),
                'title' => __('Reviews', 'casino'),
            ];
        }
    }

    if (is_single() || is_page()) {
        $breadcrumb[] = [
            'link'  => get_permalink(),
            'title' => get_the_title(),
        ];
    }

    if (is_404()) {
        $breadcrumb[] = [
            'link'  => '',
            'title' => __('Page not found', 'casino'),
        ];
    }

    return $breadcrumb;
}
