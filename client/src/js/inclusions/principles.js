
$(document).ready(() => {
  
  $('.js-open-principles').click( function () {
    if ($(this).hasClass("is-active")) {
      $('.js-principles').slideUp({
        start: function () {
          $(this).css({
            display: "flex"
          })
        }
      })
      $('.js-open-principles').removeClass('is-active')
    } else {
      $('.js-principles').slideUp()
      $('.js-open-principles').removeClass('is-active')
      $(this).toggleClass('is-active')
      $(this).next('.js-principles').slideToggle({
        start: function () {
          $(this).css({
            display: "flex"
          })
        }
      })

    }
  })

})
