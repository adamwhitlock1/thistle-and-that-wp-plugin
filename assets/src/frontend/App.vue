<template>
  <div class="container-fluid">
    <div id="vue-frontend-app">
      <div class="row">
        <div class="col-md-9 shadow pb-2">
          <div v-if="$store.state.productInfo">
            <router-view />
          </div>
          <div v-else>
            <h3 class="mt-4 text-center">
              Loading app... please wait.<br />
              <div class="lds-dual-ring" />
            </h3>
          </div>
        </div>
        <div class="col-md-3">
          <sticky-sidebar />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import StickySidebar from './components/StickySidebar.vue'
import store from './store'

export default {
  name: 'App',
  components: {
    stickySidebar: StickySidebar
  },

  data() {
    return {
      initialData: {},
      resBody: {
        loaded: 'false'
      }
    }
  },

  mounted() {
    this.onMountedCheck()

  },
  methods: {
    onMountedCheck() {
      let options = {
        url:
          '/wp-json/thistle/v1/userdata/?user=' +
          userId +
          '&_wpnonce=' +
          userNonce,
        method: 'GET'
      }
      this.$http(options).then(
        res => {
          let data = JSON.parse(res.body)
          this.$store.commit('setOverviewForm', data.overviewForm)
          this.$store.commit('activeSelections/setAllActiveSelections', data.activeSelections)
          this.getProductInfo(data.activeSelections)
        },
        res => {
          console.log('Error received: ' + res.status)
        }
      )
    },

    getProductInfo(activeSelections) {
      this.$http.get('/wp-content/uploads/prod_data.json').then(res => {
        this.$store.commit('setProdInfo', res.data[0])
        this.$store.dispatch('activeSelections/appCreated', {
          activeSelections,
          productInfo: res.data[0]
        })
      })
    },

    setVisSec(data) {
      store.commit('setVisibleSection', {
        name: data.name,
        visible: data.visible
      })
    }
  }
}
</script>

