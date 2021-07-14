<template lang="pug">
  include ../../pug/mixins/bem
  div
    +b.FORM.form(
      autocomplete="off",
    )
      +e.group--lg-w70
        +e.INPUT.input(
          name="email"
          placeholder="Enter your email",
          v-validate='"required|email"',
          v-model='ClientEmail'
        )
        +e.SPAN.img.icon-mail
        +e.SPAN.error-text {{ errors.first('email') }}
      +e.group--lg-w30
        +b.BUTTON.main-btn--bg-green.--w100.--h100.--dflex(
          type='submit'
          @click.prevent='submit'
        ) SUBSCRIBE

</template>

<script>
import VueModal from './VueModal'

export default {
  props: {
    path: {
      type: String
    }
  },
  data() {
    return {
      ClientEmail: null
    }
  },
  methods: {
    submit() {
      this.$validator.validateAll().then(res => {
        if (res) {
          let formData = {'client_email': this.ClientEmail}
          axios.post(this.path, {
            request: formData
          })
            .then( ( {data} ) => {
              this.$validator.reset()
              this.ClientEmail = null
              this.$modal.show(VueModal, {
                title1: data.title,
                title2: data.text
              }, {
                maxWidth: 600,
                height: 'auto',
                adaptive: true,
                scollable: true
              })
            })
            .catch(error => {
              console.log(error)
            })
        }
      })
    }
  },
}
</script>
