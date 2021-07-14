<template lang="pug">
  include ../../pug/mixins/bem
  div
    slot(name='stars' :context='context' v-if="context")
</template>

<script>
export default {
  props: {
    url: {
      type: String,
      required: true
    }
  },
  data: () => ({
    context: null
  }),
  created() {
    this.fetch(this.url)
  },
  methods: {
    fetch(link) {
      axios.get(link)
        .then( ({data}) => {
          // console.log(data)
          this.context = data
        })
        .catch(error => console.log(error))
    }
  }
}
</script>


