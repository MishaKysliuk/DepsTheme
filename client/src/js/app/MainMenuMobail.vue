<template lang="pug">
  
  div
    .back-btn(v-if='level > 0' @click="showPrevLvl()")
      i.back-btn__arrow.icon-left-arrow
      span BACK
    ul.mobile-menu
      transition-group(
        :name="transitionName",
        mode="out-in",
        tag="div"
        class='menuTransitionWrapper'
        appear
      )
        li.mobile-menu__item(v-for="(item, key) in menu" :key="item.id")
          a.mobile-menu__link(:href="item.url") {{ item.title }}
          i.mobile-menu__arrow.icon-menu-arrow(v-if="item.children.length > 0" @click="showNextLvl(item.children, key)")

</template>

<script>

let menuDeep = (el, level, listIndex) => {
  let count = 0
  let data
  const deep = (item) => {
    if (level <= count) {
      data = item
      return
    }
    count++
    return deep(item[listIndex[listIndex.length - count]].children)
  }
  deep(el)
  return data
}

export default {
  props: [ 'menuItems' ],
  data() {
    return {
      menu: this.menuItems,
      prevLvl: {},
      indexArray: [],
      level: 0,
      transitionName: 'slide-right',
      showMenu: true
    }
  },

  methods: {
    showNextLvl(children, key) {
      this.transitionName = 'slide-right'
      this.prevLvl = this.menu
      this.menu = children
      this.level++
      this.indexArray.push(key)
    },
    showPrevLvl() {
      this.transitionName = 'slide-left'
      this.level--
      // eslint-disable-next-line no-magic-numbers
      this.indexArray.splice(-1, 1)
      this.menu = menuDeep(this.menuItems, this.level, this.indexArray)
    }
  },
}
</script>