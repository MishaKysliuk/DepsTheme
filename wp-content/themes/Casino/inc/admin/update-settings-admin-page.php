<?php

add_action('wp_ajax_update_admin_page_settings', 'update_admin_page_settings');
add_action('wp_ajax_nopriv_update_admin_page_settings', 'update_admin_page_settings');

function update_admin_page_settings()
{
  if (isset($_POST['id'])) {

      $rating_label = $_POST['page_type'] == 'bonuses' ? 'rating' : 'voting_block_rating';

      $result = wp_update_post([
          'ID'         => $_POST['id'],
          'post_title' => $_POST['name'],
          'meta_input' => [
              'hide_from_tables'      => 'true' === $_POST['hide_from_tables'] ? 1 : 0,
              'hide_from_review_page' => 'true' === $_POST['hide_from_review_page'] ? 1 : 0,
              'hide_from_mobile'      => 'true' === $_POST['hide_from_mobile'] ? 1 : 0,
              'ref_link'              => $_POST['ref_link'],
              $rating_label           => $_POST['rating'],
          ],
      ]);

      if (is_wp_error($result)) {
          wp_send_json_error();
      }

      wp_send_json_success();
  }
  wp_die();
}
