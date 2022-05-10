<template lang="pug">
  include ../../pug/mixins/bem
  div
    star-rating(
      :increment="0.5",
      :rating="myStars",
      :show-rating="false",
      @rating-selected="sendStar($event)"
      border-color="#ffa200",
      :inactive-color="getColor()",
      active-color="#ffa200",
      :star-size="getSize()",
      :border-width="4",
      :rounded-corners="true",
      :style="{ 'justify-content': 'center' }"
      )
    p.star-rating-caption(v-if="starsType === 'page'") ({{ myCounter }} {{ $getTranslation('players voted') }})
    p.star-rating-caption(v-else-if="starsType === 'casinos'") {{ myCounter }} {{ $getTranslation('players voted') }}
    p.star-rating-caption(v-else-if="starsType === 'bonuses'") {{ myCounter }} {{ $getTranslation('players voted') }}
    p.star-rating-caption(v-else-if="starsType === 'brands-table'") {{ myCounter }} {{ $getTranslation('players voted') }}
    p.star-rating-caption(v-else-if="starsType === 'brands'") {{ $getTranslation('Claimed') }} {{ myCounter }} {{ $getTranslation('times') }}
    p.star-rating-caption(v-else-if="starsType === 'worst_casino'") {{ $getTranslation('Downvoted') }} {{ myCounter }} {{ $getTranslation('times') }}
    p.star-rating-caption(v-else-if="starsType === 'term'") ({{myCounter}} {{ $getTranslation('players voted') }})
    p.star-rating-caption(v-else-if="starsType === 'blog'") ({{myCounter}} {{ $getTranslation('readers voted') }})
</template>

<script>

import StarRating from 'vue-star-rating'

function getCookie(name) {
  name = typeof 'string' === name ? name : name.toString()
  var matches = document.cookie.match(new RegExp(
    `(?:^|; )${name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1')}=([^;]*)`
  ))
  return matches ? decodeURIComponent(matches[1]) : undefined
}

function getDateExpires(days) {
  let date = new Date()
  date.setDate(date.getDate() + days)
  return date
}

export default {
  props: {
    starsType: {
      type: [String, Number]
    },
    starsBgc: {
      type: [String, Number]
    },
    starsNumber: {
      type: [String, Number]
    },
    counter: {
      type: [String, Number]
    },
    starsId: {
      type: [String, Number]
    },
    setUrl: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      myCounter: null,
      myStars: null,
      periodOfCoookies: 365
    }
  },
  mounted() {
    this.myCounter = parseInt(this.counter)
    this.myStars = parseFloat(this.starsNumber)
  },
  methods: {
    sendStar(e) {
      if ('true' !== getCookie(this.starsId)) {
        axios.post(this.setUrl, {
          type: this.starsType,
          newCounts: this.myCounter,
          starsId: this.starsId
        })
          .then(res => {
            document.cookie = `${this.starsId}=true; path=/; expires=${getDateExpires(this.periodOfCoookies)}`
            this.myCounter++
            // console.log(res)
            this.voted = true
          })
          .catch(error => console.log(error))
      }
    },
    getColor() {
      return this.starsBgc ? this.starsBgc : '#fff'
    },
    getSize() {
      let smallSize = 14
      let defaultSize = 20
      if ('term' === this.starsType
          || 'blog' === this.starsType
          || 'page' === this.starsType
          || 'brands' === this.starsType
          || 'worst_casino' === this.starsType
          || 'bonuses' === this.starsType
          || 'brands-table' === this.starsType) {
        return smallSize
      }
      return defaultSize
    }
  },
  components: {
    StarRating
  }
}
</script>


