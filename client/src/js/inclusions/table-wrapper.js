const tableWrapp = (el, wrapper) => {
  if (el.length) {
    [...el].forEach(element => {
      let div = document.createElement(wrapper)
      div.style.overflowX = 'auto'
      element.parentNode.insertBefore(div, element)
      div.appendChild(element)
    })
  }
}

tableWrapp(document.getElementsByTagName('table'), 'div')
