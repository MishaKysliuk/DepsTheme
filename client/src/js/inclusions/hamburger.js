import { selectGetElements } from './../main.js'

$(document).ready(() => {
  let hamurgerBox = [...selectGetElements('hamburger')]
  // Hamburger mobile-menu
  if (hamurgerBox.length) {
    if (selectGetElements('hamburger')) {
      let hamurgerBox = selectGetElements('hamburger')[0]
      // Hamburger mobile-menu
      hamurgerBox.addEventListener('click', function () {
        hamurgerBox.classList.toggle("is-active")
        selectGetElements('mobile-window')[0].classList.toggle('active')
      })
    }
  
  }
})
