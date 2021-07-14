
$(document).ready(() => {
  
  $('.js-open-accordion').click( function () {
    $(this).closest('.js-accordion').toggleClass('is-open')
    $(this).closest('.js-accordion').find('.js-accordion-text').slideToggle()
  })

})
