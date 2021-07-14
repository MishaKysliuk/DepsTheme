import { selectGetElements } from './../main.js'

$(document).ready(() => {
  if (selectGetElements('blog-content__content').length) {
    let parentBlock = selectGetElements('blog-content__content')[0]
    // let h2 = Array.from(parentBlock.getElementsByTagName('H2'))
    let h2 = Array.from(parentBlock.querySelectorAll('H2:not(.features-title)'))
    h2.forEach(element => {
      let span = document.createElement('span')
      span.classList.add('slash')
      element.appendChild(span)
    })
  }
})
