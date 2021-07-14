import Vue from 'vue'

Vue.directive('open-tooltip', {
  bind(el, binding, vnode) {
    const openBtn = el.getElementsByClassName('js-tooltip-open-btn')[0]
    const tooltip = vnode.elm.getElementsByClassName('js-tooltip')[0]
    const closeBtn = vnode.elm.getElementsByClassName('js-tooltip-close')[0]

    openBtn.addEventListener('click', () => {
      tooltip.style.display = 'block'
    })

    closeBtn.addEventListener('click', () => {
      tooltip.style.display = 'none'
    })
  }
})

Vue.directive('send-gtag', {
  bind(el, binding, vnode) {
    el.addEventListener('click', () => {
      console.log(binding.value)
      gtag('event', 'GoCasino', {'event_category': 'Referral link', 'event_action': binding.value})
    })
  }
})
