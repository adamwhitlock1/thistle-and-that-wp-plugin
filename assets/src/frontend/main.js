import Vue from 'vue'
import router from './router'
import VueResource from 'vue-resource'
import 'flatpickr/dist/themes/confetti.css'
import Swatches from 'vue-swatches'
import 'vue-swatches/dist/vue-swatches.min.css'
import InView from 'vueinview'

// animate on scroll
import AOS from 'aos'
import 'aos/dist/aos.css'

import Sticky from 'sticky-js'
import App from './App.vue'
import store from './store'

// vue material components
import {
  MdList,
  MdMenu,
  MdLayout,
  MdField,
  MdButton,
  MdDialog,
  MdSnackbar
} from 'vue-material/dist/components'
import 'vue-material/dist/vue-material.min.css'

import '../styles/global.css'

import PrevNextButtons from './components/PrevNextButtons.vue'
Vue.component('prev-next-buttons', PrevNextButtons)

Vue.use(MdLayout)
Vue.use(MdField)
Vue.use(MdButton)
Vue.use(MdDialog)
Vue.use(MdMenu)
Vue.use(MdList)
Vue.use(MdSnackbar)

// vue resource for ajax calls
Vue.use(VueResource)

// inView triggers events based on items in view during scroll
InView.offset(-55)
Vue.use(InView)

// swatches library for color swatch inputs
Vue.component('swatches', Swatches)

import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'
Vue.component('v-select', vSelect)

Vue.config.productionTip = false

// global mixin for updating profile fields via wp ajax
import profileUpdateMixin from './mixins/profileUpdateMixin'
Vue.mixin(profileUpdateMixin)

import setRibbonColorNameMixin from './mixins/setRibbonColorNameMixin'
Vue.mixin(setRibbonColorNameMixin)

/* eslint-disable no-new */
new Vue({
  el: '#vue-frontend-app',
  router,
  store: store,
  created() {
    // initialize animate on scroll
    AOS.init({
      delay: 100,
      offset: 10,
      once: false,
      duration: 600
    })

    // a conditional check to see if front end builder is active and only initializing the sticky sidebar if not in editor
    let currentlyEditing = document.body.classList.contains('fl-builder-edit')
    if (currentlyEditing == false) new Sticky('#sticky-sidebar')
  },

  render: h => h(App)
})
