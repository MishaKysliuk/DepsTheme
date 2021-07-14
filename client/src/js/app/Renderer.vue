<script>
import Vue from 'vue'

function RenderComponent(template) {
  const _renderer = Vue.compile(template)
  /* eslint no-underscore-dangle: 0 */
  return {
    render: _renderer.render,
    staticRenderFns: _renderer.staticRenderFns,
  }
}

export default {
  name: 'Renderer',
  props: ['result', 'dataRes'],
  data() {
    return {
      component: '',
      False: false,
      True: true,
      None: undefined,
    }
  },
  watch: {
    result: {
      handler(nval) {
        if (nval) {
          if ('object' === typeof nval) {
            this.component = nval.val
          } else {
            this.component = RenderComponent(nval)
          }
        }
      },
      immediate: true,
    },
  },
  render(h) {
    if ('object' === typeof this.result) {
      if (this.dataRes) {
        return h('component', {
          is: this.component,
          props: { dataResult: this.dataRes },
        })
      }
      return h('div', this.$slots.render)
    }
    if (this.result) {
      return h('component', {
        is: this.component,
      })
    }
    return h('div', this.$slots.render)
  },
}
</script>
