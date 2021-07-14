<template lang="pug">
  include ../../pug/mixins/bem
  +b.popup-inner
    +e.close-popup--black.--inner.js-close(@click='$emit("close")')
      span &times;
    +e.text-content
      +e.P.title {{ title1 }}
      +e.P.subtitle {{ title2 }}
</template>

<script>
export default {
  props: {
    title1: {
      required: true
    },
    title2: {
      required: true
    }
  }
}
</script>