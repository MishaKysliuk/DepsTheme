<template lang="pug">
  include ../../pug/mixins/bem

  div
    +b.all-brands

      slot

    transition-group(
      name="slide-up",
      mode="out-in"
      tag='div',
      class='all-brands'
    )
      +b.custom-row-flex__el.--col-sm-12.--col-md-6.--col-lg-4.--col-xl-3(
        v-for="(item, index) in brands"
        v-if="brands.length > 0"
        :key='`card_${index}`'
      )
        renderer(
          :result="item"
        )

    .loader-wrapper(v-if="loading")
      .loader
    .btn-wrapper.tac.mt-2
      +b.A.main-btn--bg-white-green.--spiner.--w300(
        v-if="showPagination"
        @click.prevent="getCards"
      ) {{ $getTranslation('Show More') }}

</template>

<script>

export default {
  props: {
    itemsPerPage: {
      type: String
    },
    getBrands: {
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
      // let zero = 0
      this.page++
      this.loading = true
      let params = {
        'items_per_page': this.itemsPerPage,
        'page': this.page,
      }
      axios.post(this.getBrands, params)
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
  .slide-up-enter-active
    transition: all .8s ease
  .slide-up-leave-active
    transition: all .8s ease
  .slide-up-enter,
  .slide-up-leave-to
    transform translateY(100%)
    opacity 0
</style>
