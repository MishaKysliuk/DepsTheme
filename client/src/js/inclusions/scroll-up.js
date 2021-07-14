import { selectGetElements } from './../main.js'

$(document).ready(() => {

  // Scroll to Up
  
  function scrollFunction() {
    let btnScroll = selectGetElements('scroll-top-fixed')[0]
    let offset = 60
    if (document.body.scrollTop > offset || 
      document.documentElement.scrollTop > offset) {
      btnScroll.style.display = "block"
    } else {
      btnScroll.style.display = "none"
    }
  }

  scrollFunction()

  window.addEventListener('scroll', scrollFunction)

})
