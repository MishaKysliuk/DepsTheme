
$(document).ready(() => {

  $('.js-tooltip-open-btn').click(function () {
    $(this).next('.js-tooltip').show()
  })

  $('.js-tooltip-close').click(function () {
    $('.js-tooltip').hide()
  })

})
