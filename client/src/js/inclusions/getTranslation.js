const getTranslation = {
  install(Vue) {
    Vue.prototype.$getTranslation = function (key) {
      if (
        !TRANSLATIONS ||
        !TRANSLATIONS[key]
      ) {
        return key
      }
      return TRANSLATIONS[key]
    }
  },
}

export default getTranslation

