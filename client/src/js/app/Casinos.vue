<template lang="pug">
  include ../../pug/mixins/bem

  .mv-2
    
    TABLE.one-game.one-game--table

      slot

      //- transition-group(
      //-   name="slide-down"
      //-   mode="out-in"
      //-   tag='tbody'
      //- )
        
      template(
        v-for="(item, index) in brands"
        v-if="brands.length > 0"
      )
        renderer(
          :key='`card_${index}`'
          :result="item"
        )

    .loader-wrapper(v-if="loading")
      .loader
    .btn-wrapper.tac.mt-2(
      v-if="showPagination"
    )
      +b.A.main-btn--bg-white-green.--spiner.--w300(
        @click.prevent="getCards"
      ) Show more

</template>

<script>

export default {
  props: {
    shortcodeAtts: {
      type: Object
    },
    qArgs: {
      type: Object
    },
    getSitesList: {
      type: String
    },
    pagination: {
      type: String
    }
  },
  data() {
    return {
      brands: [],
      loading: false,
      page: 1,
      showPagination: this.pagination
    }
  },
  methods: {
    getCards() {
      this.page++
      this.loading = true
      let props = {
        'page': this.page,
        'q_args': this.qArgs,
        'shortcode_atts': this.shortcodeAtts,
      }
      axios.post(this.getSitesList, props)
        .then( ( {data} ) => {
          const { items, pagination } = data.data
          this.brands.push(...items)
          this.showPagination = pagination
          this.loading = false
        })
        .catch(error => {
          console.log(error)
        })
    },
  },
}
</script>


<style lang="stylus">
  .slide-down-enter-active
    transition: all .8s ease
  .slide-down-leave-active
    transition: all .8s ease
  .slide-down-enter,
  .slide-down-leave-to
    transform translateY(-100%)
    opacity 0
</style>

