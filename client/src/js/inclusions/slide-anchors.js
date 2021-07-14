import { selectGetElements } from './../main.js'

// Smooth scroll
$(document).ready(() => {
  
  if (selectGetElements('js-smooth-link')) {
    let anchorLinks = Array.from(selectGetElements('js-smooth-link'))
    let sliceHash = 1
    let time = 1000
    anchorLinks.forEach(el => {
      let link = el.getAttribute("href").slice(sliceHash)
      let item = document.getElementById(link)
      if (null != item) {
        el.addEventListener('click', (e) => {
          e.preventDefault()
          window.location.hash = link
          let top = $(item).offset().top
          $('html, body').animate({
            scrollTop: top
          }, time)
        })
      }
    })
  }
})




