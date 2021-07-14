<template lang="pug">
  include ../../pug/mixins/bem
  click-outside(:do="hide")
    +b.FORM.search-form.js-search-form(autocomplete="off", method="post")
      +e.input-inner(
        :class="{ active: activeClass }"
        )
        +e.BUTTON.search-btn(
          @click.prevent="showInput"
        )
          span.icon-search
        +e.INPUT.input(name="search",
          type="text",
          placeholder="Please search",
          ref="inp"
          @keyup="checkLength",
          v-model="search",
          :class="{ active: activeClass }",
          :disabled="!activeClass",
          @keydown="getFocus",
          @focus="onEnter"
          )
        +e.loader(v-if="loading")
          .loader
        +e.BUTTON.clear(
          type="button",
          :class="{ visible: clearClas }"
          @click="reset"
        )
          span.icon-cross
        +e.results
          +b.UL.list-search(v-if="!loading && results.length" ref="list")
            +e.LI.item(v-for="item in results", :key="item.name" )
              +e.A.link(
                ref='list-search__link'
                :href="item.link",
                ) {{ item.name }}
          +b.UL.list-search(v-if="!loading && empty && results.length === 0")
            +e.LI.item
              +e.P.empty Nothing  Found
</template>
<script>
import ClickOutside from './ClickOutside'

export default {
  components: {
    ClickOutside
  },
  props: {
    action: {
      type: String
    }
  },
  data() {
    return {
      length: 3,
      search: '',
      activeClass: false,
      loading: false,
      clearClas: false,
      results: [],
      currentItem: 1,
      empty: false,
      arrowCounter: -1
    }
  },
  methods: {
    showInput() {
      this.reset()
      this.activeClass = !this.activeClass
    },
    hide() {
      this.reset()
      this.activeClass = false
    },
    reset() {
      this.search = ''
      this.results = []
      this.clearClas = false
      this.empty = false
      this.activeClass = false
      this.arrowCounter = -1
    },
    onEnter() {
      this.arrowCounter = -1
    },
    getFocus(event) {
      let i = 0
      let one = 1
      let zero = 0
      if (this.results.length > i) {
        if ('ArrowDown' === event.code) {
          this.$refs['list-search__link'][i].focus()
        }
        document.addEventListener('keydown', e => {
          if ('ArrowDown' === e.code && this.arrowCounter < this.results.length - one) {
            e.preventDefault()
            this.arrowCounter = this.arrowCounter + one
            this.$refs['list-search__link'][this.arrowCounter].focus()
          }
          if ('ArrowUp' === e.code && this.arrowCounter > zero) {
            e.preventDefault()
            this.arrowCounter = this.arrowCounter - one
            this.$refs['list-search__link'][this.arrowCounter].focus()
          }
        })
      }
    },
    checkLength(e) {
      if (this.search.length >= this.length && 'ArrowUp' !== e.code && 'ArrowDown' !== e.code) {
        // console.log(e)
        this.loading = true
        this.clearClas = true
        axios.post(this.action, {
          request: this.search
        })
          .then(({data}) => {
            // console.log(data)
            if (null !== data) {
              this.results = data
              this.loading = false
              this.empty = false
            } else {
              this.empty = true
              this.results = []
            }
            this.loading = false
            // this.$nextTick().then(res => this.getFocus())
          }).catch(error => {
            console.log(error)
            this.loading = false
          })
      } else {
        this.clearClas = false
        this.results = []
        this.empty = false
      }
    }
  }
}
</script>

<style>
  .active-item {
  background-color: red
}
</style>
