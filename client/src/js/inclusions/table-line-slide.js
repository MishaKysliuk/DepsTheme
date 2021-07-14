
$(document).ready(() => {
  
  const checkMedia = ( media, mobileFirst = true ) => {
    let widthFrom = 'max-width'
    if ( ! mobileFirst ) {
      widthFrom = 'min-width'
    }
    if ( window.matchMedia( `(${widthFrom}: ${media}px)` ).matches ) {
      return true
    }
    return false
  }

  // eslint-disable-next-line no-magic-numbers
  if ( checkMedia(720) ) {
    $('.js-line-content').each( function (el) {
      let fullHeight = $(this)[0].scrollHeight
      let lineHeight = 21
  
      if (fullHeight > lineHeight) {
        $(this).addClass('is-slide')
      }
    })
  
    $('.js-line-content.is-slide').click( function () {
      $(this).toggleClass('is-open')
    })
  }


})
