jQuery(document).ready(function($) {

    $('#wpbody-content').on("click", '.js_shotrcode_btn', function(e) {
        console.log('click')
        let popupId = $(this).data('popup-id')
        $('#'+popupId).show()
    });

    $('.js-close-popup').click( function () {
        $(this).closest('.shortcode-admin-popup').hide()
    });

    $('.js-insert-text').click( function () {
        let poup = $(this).closest('.shortcode-admin-popup')
        if($(poup).attr('id') == 'sites_list_popup') {
            let affKey = $(poup).find('#aff_key').val();
            let customTable = $(poup).find('#custom_table').val();
            let sitesMain = $(poup).find('#sites-list-main').val();
            send_to_editor( '[sites-list sites="' + sitesMain + '" table_id="' + customTable + '" aff_key="' + affKey + '" ]');
        } else if ($(poup).attr('id') == 'worst_list_popup') {
            let sites = $(poup).find('#sites-list').val();
            send_to_editor( '[worst-casinos sites="' + sites + '"]');
        } else if ($(poup).attr('id') == 'bonuses_popup') {
            let affKey = $(poup).find('#aff_key').val();
            let bonuses = $(poup).find('#bonuses').val();
            let casinoId = $(poup).find('#casino_id').val();
            send_to_editor( '[bonuses bonuses="' + bonuses + '" casino-id="' + casinoId + '" aff_key="' + affKey + '"]');
        }
        $(poup).hide()
    });

})