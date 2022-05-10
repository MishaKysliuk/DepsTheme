<template lang="pug">
  include ../../pug/mixins/bem

  +b.chips.mb-2
    +e.SPAN.title {{ $getTranslation('Active Filters') }}:
    +e.items(v-if="chipsFilter.length")
      +e.SPAN.bonus.--clear-all
        +e.I.remove.icon-remove(@click="$emit('removeBonuse', chipsFilter)")
        span {{ $getTranslation('Clear All') }}
      +e.SPAN.bonus(
        v-for="bonus in chipsFilter"
      )
        +e.I.remove.icon-remove(@click="$emit('removeBonuse', [bonus])")
        span {{ bonus.name }}
    +e.SPAN.title.--no-items(v-else) {{ $getTranslation('No Items') }}

</template>

<script>

export default {
  name: 'Chips',
  props: ['checkedFilters', 'filtersList'],
  computed: {
    chipsFilter() {
      const arrayFiltered = []
      this.filtersList.forEach((item, idx) => {
        const res = item.items.
          filter(el => this.checkedFilters[idx][item.taxonomy_name].
            find(id => id === el.term_id)).
          map(element => ({index: idx, taxonomy: item.taxonomy_name, ...element}))
        if (res.length) {
          arrayFiltered.push(...res)
        }
      })
      return arrayFiltered
    }
  },

}
</script>
