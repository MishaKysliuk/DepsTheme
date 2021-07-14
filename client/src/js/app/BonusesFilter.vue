<template lang="pug">
  include ../../pug/mixins/bem


  +b.filters-section-wrapper
    div
      +b.filters-block(:class="{ 'is-open': isOpenFilters }")
        +e.el.--header
          +e.SPAN.el-title casino bonuses
          +e.SPAN.el-title.--mob(@click="isOpenFilters = !isOpenFilters" :class="{ 'is-open': isOpenFilters }")

            +b.BUTTON.hamburger.--spin(type="button" :class="{ 'is-active': isOpenFilters }" )
              +b.SPAN.hamburger-box
                +b.SPAN.hamburger-inner
        
            +e.SPAN.mob-title(v-if="!isOpenFilters") open filters
            +e.SPAN.mob-title(v-if="isOpenFilters") close filters
            +e.I.el-title-arrow.icon-caret-right
        +e.el(v-for="(el, index) in filtersList" :class="{'is-active': openCategory.includes(el.taxonomy_name)}" :key="index")
          +e.DIV.el-title.--caption(@click="toggleCategory(el.taxonomy_name)") 
            span {{ el.taxonomy_label }}
            +e.I.el-title-arrow.icon-caret-right
          +e.el-body
            +e.search-wrap
              +e.INPUT.el-search(
                type="text"
                name='search'
                placeholder="Search"
                v-model="search[index][el.taxonomy_name]"
                ref="search"
              )
            +e.category-list
              +e.category-item(v-for="(item, key) in filteresCategories(index)" :key="key")
                +e.LABEL.category-label(
                  v-if="!item.hide_term"
                  :for='item.term_id'
                  :class="{'is-checked': checkedFilters[index][el.taxonomy_name].includes(item.term_id)}"
                )
                  +e.INPUT.category-item-checkbox(
                    type="checkbox"
                    :name='item.slug'
                    :value='item.term_id'
                    :id='item.term_id'
                    @change="filtreredBonuses"
                    v-model="checkedFilters[index][el.taxonomy_name]"
                  )
                  +e.category-item-name {{ item.name }}
            +e.SPAN.category-item-name(v-if="filteresCategories(index).length == 0") Nothing to found!


    +b.filters-body
      chips(
        :checked-filters='checkedFilters'
        :filters-list='filtersData'
        @removeBonuse="removeBonuse($event)"
      )


      div

        slot(
          v-if="showFirstRender"
        )


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
import Chips from './Chips'

export default {
  components: {
    Chips
  },
  props: ['filtersData', 'activeFilters', 'pagination'],
  data() {
    return {
      bonuses: [],
      openCategory: [],
      loading: false,
      filtersList: this.filtersData,
      checkedFilters: [],
      search: null,
      page: 1,
      showPagination: this.pagination,
      isOpenFilters: false,
      showFirstRender: true,
    }
  },
  created() {
    this.setVmodel()
  },
  methods: {
    setVmodel() {
      this.search = []
      this.filtersList.forEach((el, idx) => {
        this.$set(this.search, idx, {[el.taxonomy_name]: ''})
        if (this.activeFilters.length && (this.activeFilters[0][el.taxonomy_name] !== undefined)) {
          this.$set(this.checkedFilters, idx, {[el.taxonomy_name]: this.activeFilters[0][el.taxonomy_name]})
        } else {
          this.$set(this.checkedFilters, idx, {[el.taxonomy_name]: []})
        }
      })
    },
    getNextPage() {
      this.page++
      this.getBonuses()
    },
    filtreredBonuses() {
      this.page = 1
      this.getBonuses()
    },
    getBonuses() {
      this.loading = true
      let params = {
        'page': this.page,
        'checked_filters': this.checkedFilters
      }
      axios.post('/wp-admin/admin-ajax.php?action=get_bonuses', params)
        .then( ( {data} ) => {
          const { items, pagination } = data.data
          let one = 1
          if (one != this.page ) {
            this.bonuses.push(...items)
          } else {
            this.bonuses = items
          }
          this.showPagination = pagination
          this.loading = false
        })
        .catch(error => {
          console.log(error)
        })
    },
    toggleCategory: function (item) {
      let one = 1
      let minusOne = -1
      if (minusOne === this.openCategory.indexOf(item)) {
        this.openCategory.push(item)
      } else {
        this.openCategory.splice(this.openCategory.indexOf(item), one)
      }
    },
    removeBonuse(e) {
      for (let key in e ) {
        let one = 1
        let minusOne = -1 
        let checkedFiltersItems = this.checkedFilters[e[key].index][e[key].taxonomy]
        let index = checkedFiltersItems.indexOf(e[key].term_id)
        if (minusOne < index) {
          checkedFiltersItems.splice(index, one)
        }
      }
      this.showFirstRender = false
      this.filtreredBonuses()
    },
  },
  
  computed: {
    filteresCategories() {
      return (idx) => {
        let filtersItems = this.filtersList[idx].items
        let taxonomyName = this.filtersList[idx].taxonomy_name
        let minusOne = -1
        let newArray = []
        const search = this.search[idx][taxonomyName].toLowerCase()
        for (var key in filtersItems) {
          let el = filtersItems[key]
          if (minusOne != el.name.toLowerCase().indexOf(search)) {
            newArray.push(el)
          }
        }
        return newArray
      }
    },
    
  }
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