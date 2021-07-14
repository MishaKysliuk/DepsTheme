<template lang="pug">
  include ../../pug/mixins/bem

  div

    slot

    transition-group(
      name="slide-up",
      mode="out-in"
      tag='div',
      class='custom-row-flex bonuses-wrapper '
    )
      +b.custom-row-flex__el.--col-sm-12.--col-md-4(
        v-for="(item, index) in bonuses"
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
        @click.prevent="getNextPage"
      ) Show more


</template>

<script>

export default {
  props: {
    shortcodeAtts: {
      type: Object
    },
    pagination: {
      type: String
    }
  },
  data() {
    return {
      bonuses: [],
      loading: false,
      page: 1,
      showPagination: this.pagination
    }
  },
  methods: {
    getNextPage() {
      this.page++
      this.loading = true
      let props = {
        'page': this.page,
        'shortcode_atts': this.shortcodeAtts,
      }
      axios.post('/wp-admin/admin-ajax.php?action=get_bonuses_next_page', props)
        .then( ( {data} ) => {
          const { items, pagination } = data.data
          this.bonuses.push(...items)
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

