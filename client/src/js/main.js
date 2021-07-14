import Vue from 'vue'
import Fetcher from './app/Fetcher'
import Search from './app/Search'
import Stars from './app/Stars'
import Quiz from './app/Quiz'
import Casinos from './app/Casinos'
import AllBrands from './app/AllBrands'
import Subscribe from './app/Subscribe'
import Blog from './app/Blog'
import MainMenuMobail from './app/MainMenuMobail'
import Renderer from './app/Renderer'
import BonusesFilter from './app/BonusesFilter'
import BonusesShortcode from './app/BonusesShortcode'
import VeeValidate from 'vee-validate'
import VModal from 'vue-js-modal'

Vue.use(VModal, {dynamic: true})
Vue.use(VeeValidate, {
  classes: true,
  classNames: {
    valid: 'is-valid',
    invalid: 'is-invalid'
  }
})

Vue.component('Renderer', Renderer)
Vue.component('Stars', Stars)

import axios from 'axios'
window.axios = axios

let content = {
  el: '#app',
  components: {
    Fetcher,
    Search,
    Quiz,
    Casinos,
    AllBrands,
    Subscribe,
    Blog,
    MainMenuMobail,
    BonusesFilter,
    BonusesShortcode,
  }
}

window.app = new Vue(content)

export function selectByQuery(element) {
  return document.querySelector(element) || {}
}

export function selectGetElements(element) {
  return document.getElementsByClassName(element) || []
}

export let htmlAndBody = [...document.querySelectorAll('html, body')]

// Node modules
import slick from 'slick-carousel'

window.slick = slick


// Inclusions

import './inclusions/hamburger'
// import './inclusions/slide-anchors'
import './inclusions/scroll-up'
import './inclusions/no-class-text'
import './inclusions/table-wrapper'
import './inclusions/tooltip'
import './inclusions/directive'
import './inclusions/accordion'
import './inclusions/principles'
import './inclusions/table-line-slide'
import './inclusions/smooth-scroll'
