jQuery(document).ready(function($) {

  function save_setting(setting) {
    setting.each((idx, line) => {

      let pageType = $(line).data('type')
      let sendData = {}
      sendData.id = $(line).find('.js-admin-item-id').text()
      sendData.page_type = pageType
      sendData.name = $(line).find("input[name='name']").val()
      sendData.rating = $(line).find("input[name='rating']").val()
      sendData.ref_link = $(line).find("input[name='ref_link']").val()
      sendData.hide_from_tables = $(line).find("input[name='hide_from_tables']")[0].checked
      if( pageType == 'brand' ) {
        sendData.hide_from_review_page = $(line).find("input[name='hide_from_review_page']")[0].checked
        sendData.hide_from_mobile = $(line).find("input[name='hide_from_mobile']")[0].checked
      }

      $.ajax({
          type: "POST",
          url: "/wp-admin/admin-ajax.php?action=update_admin_page_settings",
          data: sendData
        }).done(function( msg ) {
          if(msg.success) {
            $('.js-admin-save').prop( 'disabled', true)
            $('.js-admin-save-all').prop( 'disabled', true)
          }
        });
        
      })

  }

  $('.js-admin-input').each((index, el) => {

    $(el).on('input', (inputEl) => {
      let adminLine = $(inputEl.target).closest('.js-admin-line')
      adminLine.attr('data-changed', 'true')
      $(adminLine).find('.js-admin-save').prop( 'disabled', false)
      $('.js-admin-save-all').prop( 'disabled', false)
    })

  })

  $('.js-admin-save').on('click', (el) => {
    let adminLine = $(el.target).closest('.js-admin-line')
    if (adminLine) {
      save_setting(adminLine)
    }
  })

  $('.js-admin-save-all').on('click', (el) => {
    let adminLine = $('.js-admin-line[data-changed="true"]')
    if (adminLine) {
      save_setting(adminLine)
    }
  })

})


