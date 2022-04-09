<?php

// timber context
add_filter('timber/context', 'add_to_context');
function add_to_context($context)
{
    $context['main_menu']                     = new \Timber\Menu('main-menu');
    $context['main_menu_mobail']              = get_main_menu_mobail();
    $context['footer_menu']                   = new \Timber\Menu('footer-menu');
    $context['footer_menu_aditional_1']       = new \Timber\Menu('footer-menu-aditional-1');
    $context['footer_menu_aditional_2']       = new \Timber\Menu('footer-menu-aditional-2');
    $context['footer_menu_aditional_3']       = new \Timber\Menu('footer-menu-aditional-3');
    $context['site_logo']                     = get_field('logo', 'option');
    $context['footer_descriptions']           = get_field('footer_descriptions', 'option');
    $context['footer_copyright']              = do_shortcode(get_field('footer_copyright', 'option'));
    $context['footer_images_block_left']      = get_field('footer_images_block_left', 'option');
    $context['footer_images_block_right']     = get_field('footer_images_block_right', 'option');
    $context['social_networks']               = get_field('social_networks', 'option');
    $context['subscribe_form']                = get_field('subscribe_form', 'option');
    $context['default_value_for_rank_rating'] = get_field('default_value_for_rank_rating', 'option');
    $context['site_scripts']                  = get_field('site_scripts', 'option');
    $context['is_front_page']                 = is_front_page();
    $context['breadcrumbs']                   = get_breadcrumb();

    return $context;
}

add_filter('wp_mail_from_name', 'vortal_wp_mail_from_name');
function vortal_wp_mail_from_name($email_from)
{
    return 'Casino';
}

function casino_query($query)
{
    if ($query->is_main_query() && !is_admin() && is_post_type_archive('blog')) {
        $query->set('post_type', array('blog'));
        $query->set('posts_per_page', 9);
    }
}
add_action('pre_get_posts', 'casino_query');

/*
 * Remove tax slug
 */
add_filter('request', 'rudr_change_term_request', 1, 1);
function rudr_change_term_request($query)
{
    if (isset($query['name'])):
        $get_taxonomies = get_taxonomies();
        foreach ($get_taxonomies as $key => $tax):
            $name     = $query['name'];
            $tax_name = $tax; // specify you taxonomy name here, it can be also 'category' or 'post_tag'
            $term     = get_term_by('slug', $name, $tax_name); // get the current term to make sure it exists
            if (isset($name) && $term && !is_wp_error($term)): // check it here
                unset($query['name']);
                $query[$tax_name] = $name; // for another taxonomies
                break;
            endif;
        endforeach;
    endif;
    return $query;
}

add_filter('term_link', 'rudr_term_permalink', 10, 3);
function rudr_term_permalink($url, $term, $taxonomy)
{
    $url = str_replace_once('/' . $taxonomy, '', $url);
    return $url;
}

function str_replace_once($search, $replace, $text)
{
    $pos = strpos($text, $search);
    return false !== $pos ? substr_replace($text, $replace, $pos, strlen($search)) : $text;
}

// 301 redirect
add_action('template_redirect', 'rudr_old_term_redirect');
function rudr_old_term_redirect()
{
    $get_taxonomies = get_taxonomies();
    foreach ($get_taxonomies as $key => $tax):
        if (strpos($_SERVER['REQUEST_URI'], $tax) != false):
            wp_redirect(site_url(str_replace_once($tax, '', $_SERVER['REQUEST_URI'])), 301);
            return;
        endif;
    endforeach;
}

// Выборка трех казино
function get_casino_tax($casino_taxonomy)
{
    $casino_tax = array();
    foreach ($casino_taxonomy as $key => $tax) {
        if (false != $tax) {
            $casino_tax[] = array(
                'tax_name' => $tax[0]->taxonomy,
                'tax_id'   => $tax[0]->term_id,
            );
        }
    }

    if (empty($casino_tax)) {
        return null;
    }

    $args = array(
        'post_type'      => 'casinos',
        'posts_per_page' => 3,
        'order'          => 'ASC',
        'meta_key'       => 'voting_block_rating',
        'orderby'        => 'meta_value_num',
        'tax_query'      => array(
            'relation' => 'AND',
        ),
    );

    foreach ($casino_tax as $tax) {
        $args['tax_query'][] = array(
            'taxonomy' => $tax['tax_name'],
            'field'    => 'id',
            'terms'    => $tax['tax_id'],
        );
    }

    $casino_query = new Timber\PostQuery($args);

    return $casino_query;
}

// PRG Pattern redirect
add_action('template_redirect', 'prg_get_and_redirect');
function prg_get_and_redirect()
{
    if (isset($_POST['prgpattern']) && is_numeric($_POST['prgpattern'])) {
        $casino_id    = $_POST['prgpattern'];
        $redirect_url = get_field('ref_link', $casino_id);
        if (isset($_POST['aff_key'])) {
            $redirect_url = get_brand_link($casino_id, $_POST['aff_key']);
        }
        if (isset($_POST['t&cs'])) {
            $tcs          = get_field('t&cs', $casino_id);
            $redirect_url = $tcs['link'];
        }
        wp_redirect($redirect_url);
        exit();
    }
}

add_shortcode('prgpattern', 'prg_pattern_form');
function prg_pattern_form($atts, $content)
{
    $atts = shortcode_atts(
        array(
            'url'   => '',
            'title' => 'title',
        ),
        $atts
    );

    ob_start();
    ?>
    <form method="POST" target="_blank">
        <button class="noLink one-game__title" type="submit" name="prgpattern" value="<?php echo esc_url($atts['url']); ?>"><?php echo $atts['title']; ?></button>
    </form>
<?php
return ob_get_clean();
}

##  отменим показ выбранного термина наверху в checkbox списке терминов
add_filter('wp_terms_checklist_args', 'set_checked_ontop_default', 10);
function set_checked_ontop_default($args)
{
    // изменим параметр по умолчанию на false
    if (!isset($args['checked_ontop'])) {
        $args['checked_ontop'] = false;
    }

    return $args;
}

function get_canonical_link()
{
    $url = parse_url($_SERVER['REQUEST_URI']);
    $re  = '@/blog/page/@';
    preg_match($re, $url['path'], $matches);
    if (!empty($matches)) {
        return get_site_url() . '/blog/';
    } else {
        return get_site_url() . $url['path'];
    }
}

add_filter('excerpt_more', 'filter_function_name_7488');
function filter_function_name_7488()
{
    return '...';
}

function get_main_menu_mobail()
{
    $main_menu        = new \Timber\Menu('main-menu');
    $main_menu_mobail = [];
    foreach ($main_menu->items as $key => $item) {
        $main_menu_mobail[$key] = get_mobail_menu_item($item);
    }
    return json_encode($main_menu_mobail);
}

function get_mobail_menu_item($menu_item)
{
    $mobail_menu_item = [
        'title'    => $menu_item->title,
        'id'       => $menu_item->ID,
        'url'      => $menu_item->url,
        'children' => $menu_item->children ? get_mobail_menu_children($menu_item->children) : [],
    ];
    return $mobail_menu_item;
}

function get_mobail_menu_children($children)
{
    $children_items = [];
    foreach ($children as $key => $child) {
        $children_items[] = get_mobail_menu_item($child);
    }
    return $children_items;
}

// Contact Form 7 remove auto added p tags
add_filter('wpcf7_autop_or_not', '__return_false');

if (function_exists('acf_add_options_page')) {

    $option_page = acf_add_options_page(array(
        'page_title' => 'Site options',
        'menu_title' => 'Site options',
        'capability' => 'edit_posts',
        'menu_slug'  => 'site_options',
        'redirect'   => false,
    ));
}

function acf_set_featured_image($value, $post_id, $field)
{
    if ('' != $value) {
        //Add the value which is the image ID to the _thumbnail_id meta data for the current post
        add_post_meta($post_id, '_thumbnail_id', $value);
    }
    return $value;
}
add_filter('acf/update_value/key=field_5cd17e1f02809', 'acf_set_featured_image', 10, 3);

function get_brand_link($brand_id, $aff_key)
{
    $affiliate_links_table = get_field('affiliate_links_table', $brand_id);

    if (!empty($affiliate_links_table)) {
        $link = array_search($aff_key, array_column($affiliate_links_table, 'aff_key', 'link'));
        if ($link) {
            return $link;
        }
    }

    return get_field('ref_link', $brand_id);
}

add_action('admin_init', 'hide_editor');
function hide_editor()
{

    if (!isset($_GET['post'])) {
        return;
    }

    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
    if (!isset($post_id)) {
        return;
    }

    $template_file = get_post_meta($post_id, '_wp_page_template', true);

    if ('template-casino-bonuses.php' == $template_file || 'template-landing-page.php' == $template_file) {
        // edit the template name
        remove_post_type_support('page', 'editor');
    }
}

add_action('init', 'remove_acf_wpautop');
function remove_acf_wpautop() {
    // отключение <p> и <br> для ACF
    remove_filter('acf_the_content', 'wpautop');
}

// Updating the taxonomy last modified date
add_action('init', 'get_custom_taxonomy');
function get_custom_taxonomy()
{
    $casinos_taxonomies = get_object_taxonomies('casinos');
    $bonuses_taxonomies = get_object_taxonomies('casino-bonuses');

    foreach ($casinos_taxonomies as $taxonomy) {
        add_action('edited_' . $taxonomy, 'action_updating_last_modified_taxonomy_date', 10, 2);
        add_action('saved_' . $taxonomy, 'action_updating_last_modified_taxonomy_date', 10, 2);
    }

    foreach ($bonuses_taxonomies as $taxonomy) {
        add_action('edited_' . $taxonomy, 'action_updating_last_modified_taxonomy_date', 10, 2);
        add_action('saved_' . $taxonomy, 'action_updating_last_modified_taxonomy_date', 10, 2);
    }
}

function action_updating_last_modified_taxonomy_date($term_id, $tt_id)
{
    update_term_meta($term_id, 'last_modified', date('d M Y H:i:s'));
}

function get_aff_key_bonuses($brand_id, $aff_key = '')
{
    $casino_bonus_block = get_field('casino_bonus_block', $brand_id);
    $affiliate_table    = get_field('affiliate_links_table', $brand_id);
    if (!empty($aff_key) && !empty($affiliate_table)) {

        foreach ($affiliate_table as $value) {
            if ($value['aff_key'] == $aff_key) {
                foreach ($value['casino_bonus'] as $key => $val) {
                    if (!empty($val)) {
                        $casino_bonus_block[$key] = $val;
                    }
                }
                break;
            }
        }
    }
    return $casino_bonus_block;
}

function get_aff_key_main_feature($bonus_id, $aff_key = '')
{
    $main_feature = get_field('main_feature', $bonus_id);
    if (!empty($aff_key)) {
        $affiliate_table = get_field('affiliate_links_table', $bonus_id);

        if (!empty($affiliate_table)) {
            foreach ($affiliate_table as $value) {
                if (!empty($value['main_feature'])) {
                    $main_feature = $value['main_feature'];
                }
                break;
            }
        }

    }
    return $main_feature;
}

add_filter('wpcf7_load_js', '__return_false');
add_filter('wpcf7_load_css', '__return_false');

add_action('wp_print_scripts', 'de_script', 100);

function de_script()
{
    wp_dequeue_script('wpcf7-recaptcha');
    wp_dequeue_script('google-recaptcha');
    if (is_page(233)) {
        if (function_exists('wpcf7_enqueue_scripts')) {
            wpcf7_enqueue_scripts();
        }

        if (function_exists('wpcf7_enqueue_styles')) {
            wpcf7_enqueue_styles();
        }

        wp_enqueue_script('wpcf7-recaptcha');
        wp_enqueue_script('google-recaptcha');

    }
}

function dequeue_jquery_migrate($scripts)
{
    if (!is_admin() && !empty($scripts->registered['jquery'])) {
        $scripts->registered['jquery']->deps = array_diff(
            $scripts->registered['jquery']->deps,
            ['jquery-migrate']
        );
    }
}
add_action('wp_default_scripts', 'dequeue_jquery_migrate');

// отключение <p> и <br>
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');
remove_filter('the_content', 'wptexturize');
remove_filter('the_excerpt', 'wptexturize');

remove_filter('term_description', 'wpautop');
remove_filter('term_description', 'wptexturize');

remove_filter('term_description', 'wpautop');


function render_field_edit($tag, $taxonomy)
{
    $settings = array(
        'textarea_name' => 'description',
        'textarea_rows' => 10,
        'editor_class'  => 'i18n-multilingual',
    );

    ?>
        <tr class="form-field term-description-wrap">
        <th scope="row"><label for="description"><?php _e('Description');?></label></th>
        <td>
            <?php
$settings = array('wpautop' => true, 'media_buttons' => true, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name' => 'description');
    wp_editor(html_entity_decode($tag->description, ENT_QUOTES, 'UTF-8'), 'description-tinymce', $settings);
    ?>
            <p class="description"><?php esc_html_e('The description is not prominent by default; however, some themes may show it.');?></p>
        </td>
        <script>
            // Remove the non-html field
            jQuery('textarea#description').closest('.form-field').remove();
        </script>
        </tr>
    <?php
}

function visual_editor_taxonomies()
{
    $taxonomies = get_taxonomies('', 'names');
    foreach ($taxonomies as $taxonomy) {
        add_action($taxonomy . '_edit_form_fields', 'render_field_edit', 1, 2);
    }
}

add_action('init', 'visual_editor_taxonomies', 9999);

function check_page_noindex($id, $type = 'page')
{
    global $wpdb;
    $noindex = false;
    if ($type == 'page') {
        $wp_qss_seo = $wpdb->get_results("SELECT * FROM `wp_qss` WHERE `post` LIKE '%\"ID\";i:$id%'");
    } else {
        $wp_qss_seo = $wpdb->get_results("SELECT * FROM `wp_qss` WHERE `post` LIKE '%\"term_id\";i:$id%'");
    }
    if ($wp_qss_seo) {
        $seo     = unserialize($wp_qss_seo[0]->seo);
        $noindex = boolval($seo['noindex']);
    }
    return $noindex;
};

add_action('init', 'disable_kses_if_allowed');

function disable_kses_if_allowed()
{
    if (current_user_can('unfiltered_html')) {
        // Disables Kses only for textarea saves
        foreach (array('pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description') as $filter) {
            remove_filter($filter, 'wp_filter_kses');
        }
    }

    // Disables Kses only for textarea admin displays
    foreach (array('term_description', 'link_description', 'link_notes', 'user_description') as $filter) {
        remove_filter($filter, 'wp_kses_data');
    }
}
