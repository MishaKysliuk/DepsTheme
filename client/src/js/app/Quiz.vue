<template lang="pug">
  include ../../pug/mixins/bem
  div
    +b.casino-card--padding.--pb100.tac
      +e.row--column.--p-relative
        .loader(v-if="loading")
        +e.btn-row
          +b.A.control-btn--arrow(
            v-if="prevLink"
            @click.prevent='getQuestion(prevLink, true)',
          ) Back
          +e.big-btn(
              v-if="questionData.casinos"
            )
            +b.A.main-btn--bg-green.--w100.--dflex(
              :href="questionData.check_all_link",
              data-pid="item.id"
              ) #[+e.SPAN.logo-search.icon-search] {{ questionData.button_name }}
          +b.UL.dots-quiz(
            v-if="questionData.answers"
          )
            +e.LI.item(
              v-for="n in steps"
              :class="{'active' : n === counter}"
            )
          +b.A.control-btn--restart(
            v-if="prevLink",
            @click.prevent="getQuestion(firstLink); setPrevLink('');"
          ) Restart
        +e.content
          +e.P.question {{ questionData.questions || questionData.last_title }}
          +e.P.check(
            v-if="questionData.casinos"
          ) CHECK TOP-3 CASINOS WITH IT
          transition(name="slide",
                    mode="out-in")
            +e.row--jf-center(
              key="answer",
              v-if='questionData.answers'
              )
              +e.answer(
                v-for='(item, index) in questionData.answers',
                :key="index"
                )
                +b.A.main-btn--w100(
                  @click.prevent='getQuestion(item.api_link)',
                  :class='setClassBtn(index)'
                ) {{ item.answer }}
            +b.UL.game-cards-list.mt-2(
              key="list",
              v-else-if="questionData.casinos"
            )
              +e.LI.item(
                v-for="(item, index) in questionData.casinos",
                :key="index"
              )
                +b.one-game.--quiz
                  +e.el--lg-w30
                    +e.row
                      +e.el-logo
                        +b.casino-logo(
                            :style="{ 'background-color': item.color }"
                          )
                          form(method="POST" target="_blank" @submit='onFormSubmit(item.title, "- logo")')
                            +e.BUTTON.link(
                                type="submit",
                                name="prgpattern",
                                :value="item.id",
                                target="_blank"
                                )
                              +e.img
                                .img-wrap
                                  img(:src="item.logo")
                          +e.counter-wrapper
                            +e.SPAN.counter {{ index + 1 }}
                      +e.el-stars
                        +e.row--column
                          form(method="POST" target="_blank" @submit='onFormSubmit(item.title, "- title")')
                            +e.BUTTON.title(
                              type="submit",
                              name="prgpattern",
                              :value="item.id",
                              target="_blank"
                              ) {{ item.title }}
                          +e.stars
                            stars(
                              :stars-number="item.number_of_stars",
                              set-url="/wp-admin/admin-ajax.php?action=rating",
                              :stars-type="item.type",
                              :counter="item.users_voted",
                              :stars-id="item.id"
                              )
                  +e.el--lg-w45
                    +e.row
                      +e.el-price-inner
                        +e.row--column
                          +e.SPAN.light {{ item.bonus_percent }}
                          +e.P.price {{ item.bonus }}
                          +e.SPAN.light {{ item.additional_bonus }}
                      +e.el-list
                        +b.UL.marks-list(
                        )
                          +e.LI.item {{ item.feature_1 }}
                          +e.LI.item {{ item.feature_2 }}
                          +e.LI.item {{ item.feature_3 }}
                  +e.el--lg-w25
                    +e.row--lg-jc-end
                      +e.row--column.--btn-side
                        form(method="POST" target="_blank" @submit='onFormSubmit(item.title, "- button")')
                          +b.BUTTON.main-btn--bg-green.--w100(
                            type="submit",
                            name="prgpattern",
                            :value="item.id",
                            target="_blank"
                            ) Play now
                        form(method="POST" target="_blank" @submit='onFormSubmit(item.title, "- website")')
                          +e.BUTTON.link(
                            type="submit",
                            name="prgpattern",
                            :value="item.id",
                            ) {{ item.website_adress }}
        +e.control


</template>

<script>

import Stars from './Stars'

export default {
  props: {
    firstLink: {
      type: String
    }
  },
  name: 'Quiz',
  data() {
    return {
      questionData: {},
      steps: 0,
      prevLink: '',
      counter: 0,
      links: [],
      loading: false
    }
  },
  components: {
    Stars
  },
  created() {
    this.getQuestion(this.firstLink)
  },
  methods: {
    getQuestion(link, minus) {
      this.loading = true
      axios.get(link)
        .then( ( {data} ) => {
          this.questionData = data
          minus ? this.counter-- : this.counter++ 
          this.checkPrevLink(link, minus)
          // console.log(data)
          this.loading = false
        })
        .catch(err => console.log(err.response))
    },
    setClassBtn(index) {
      if ("Green" == this.questionData.answers[index].button_color) {
        return "main-btn--bg-white-green"
      } else if ("Red" == this.questionData.answers[index].button_color) {
        return "main-btn--bg-white-red"
      }
    },
    getClassDots(index) {
      return this.questionData.steps_to_end === index ? 'active' : ''
    },
    setPrevLink(link) {
      let zero = 0
      this.counter = zero
      this.prevLink = link
    },
    checkPrevLink(link, minus) {
      let one = 1,
        two = 2
      if (!minus) {
        let arr = this.links
        arr.push(link)
        let unique = [...new Set(this.links)]
        this.links = unique
      }
      if (this.counter > one) {
        this.prevLink = this.links[this.counter - two]
        this.steps = this.questionData.steps_to_end + this.counter - one
      } else {
        this.prevLink = ''
        this.counter = one
        this.links = []
        this.links.push(this.firstLink)
        this.steps = this.questionData.steps_to_end
      }
    },
    onFormSubmit: function (name, val) {
      let eventAction = `${name} ${val}`
      gtag('event', 'GoCasino', {'event_category': 'Referral link', 'event_action': eventAction})
    }
  }
}
</script>

