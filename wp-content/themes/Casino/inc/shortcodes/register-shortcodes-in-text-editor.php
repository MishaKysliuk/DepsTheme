<?php

function footer_admin_modals () {
    echo "<div id='sites_list_popup' class='shortcode-admin-popup' role='application'>";
        echo '<div class="mce-container mce-panel mce-floatpanel mce-window mce-in" hidefocus="1" role="dialog" style="border-width: 1px; z-index: 100101; left: 394px; top: 230.5px; width: 498px; height: 486px;">';
            echo "<div class='mce-reset' role='application'>";
                echo '<div class="mce-window-head"><div class="mce-title">Sites list</div><div class="mce-dragh"></div><button type="button" class="mce-close js-close-popup" aria-hidden="true"><i class="mce-ico mce-i-remove"></i></button></div>';
                echo '<div class="mce-container-body mce-window-body mce-abs-layout" style="width: 498px; height: 398px;">';
                    require_once get_template_directory() . '/inc/shortcodes/modals/sites-list-modal.php';
                echo '</div>';
                echo '<div class="mce-button-group"><button class="js-insert-text" type="button" tabindex="-1"><span class="mce-txt">Submit</span></button><button type="button" class="js-close-popup" tabindex="-1"><span class="mce-txt">Cancel</span></button></div>';
            echo '</div>';
        echo '</div>';
    echo "</div>";

    echo "<div id='worst_list_popup' class='shortcode-admin-popup' role='application'>";
        echo '<div class="mce-container mce-panel mce-floatpanel mce-window mce-in" hidefocus="1" role="dialog" style="border-width: 1px; z-index: 100101; left: 394px; top: 230.5px; width: 498px; height: 486px;">';
            echo "<div class='mce-reset' role='application'>";
                echo '<div class="mce-window-head"><div class="mce-title">Worst list</div><div class="mce-dragh"></div><button type="button" class="mce-close js-close-popup" aria-hidden="true"><i class="mce-ico mce-i-remove"></i></button></div>';
                echo '<div class="mce-container-body mce-window-body mce-abs-layout" style="width: 498px; height: 398px;">';
                    require_once get_template_directory() . '/inc/shortcodes/modals/worst-list-modal.php';
                echo '</div>';
                echo '<div class="mce-button-group"><button class="js-insert-text" type="button" tabindex="-1"><span class="mce-txt">Submit</span></button><button type="button" class="js-close-popup" tabindex="-1"><span class="mce-txt">Cancel</span></button></div>';
            echo '</div>';
        echo '</div>';
    echo "</div>";

    echo "<div id='bonuses_popup' class='shortcode-admin-popup' role='application'>";
        echo '<div class="mce-container mce-panel mce-floatpanel mce-window mce-in" hidefocus="1" role="dialog" style="border-width: 1px; z-index: 100101; left: 394px; top: 230.5px; width: 498px; height: 486px;">';
            echo "<div class='mce-reset' role='application'>";
                echo '<div class="mce-window-head"><div class="mce-title">Bonuses</div><div class="mce-dragh"></div><button type="button" class="mce-close js-close-popup" aria-hidden="true"><i class="mce-ico mce-i-remove"></i></button></div>';
                echo '<div class="mce-container-body mce-window-body mce-abs-layout" style="width: 498px; height: 398px;">';
                    require_once get_template_directory() . '/inc/shortcodes/modals/bonuses-modal.php';
                echo '</div>';
                echo '<div class="mce-button-group"><button class="js-insert-text" type="button" tabindex="-1"><span class="mce-txt">Submit</span></button><button type="button" class="js-close-popup" tabindex="-1"><span class="mce-txt">Cancel</span></button></div>';
            echo '</div>';
        echo '</div>';
    echo "</div>";
}
add_filter('admin_footer_text', 'footer_admin_modals');


add_action('media_buttons', 'add_my_media_button');
function add_my_media_button() {
    echo '<a href="#" data-popup-id="sites_list_popup" class="button js_shotrcode_btn">[Sites list]</a>';
    echo '<a href="#" data-popup-id="worst_list_popup" class="button js_shotrcode_btn">[Worst list]</a>';
    echo '<a href="#" data-popup-id="bonuses_popup" class="button js_shotrcode_btn">[Bonuses]</a>';
}
