<template>
  <div
    class="col-md-3 sticky-buttons"
    data-aos="fade-in"
    data-aos-duration="800"
    data-aos-delay="500"
  >
    <div class="row mx-2">
      <div class="col-md-6 px-1">
        <md-button
          type="button"
          class="btn-block float-right md-secondary md-raised"
          @click="goTo(paths.prev)"
        >
          <i
            class="ua-icon ua-icon-arrow-left"
            aria-hidden="true"
          />
          {{ pathLabels.prev }}
        </md-button>
      </div>
      <div class="col-md-6 px-1">
        <md-button
          class="btn-block float-right md-secondary md-raised"
          @click="goTo(paths.next)"
        >
          {{ pathLabels.next }}
          <i
            class="ua-icon ua-icon-arrow-right"
            aria-hidden="true"
          />
        </md-button>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  name: 'PrevNextButtons',
  props: {
    prev: {
      type: String,
      default: '/'
    },
    next: {
      type: String,
      default: '/'
    }
  },
  mounted(){
    console.log(
      `
        ${JSON.stringify(this.activeRoutes)}
        ${JSON.stringify(this.paths)}
        ${JSON.stringify(this.currentRoutes)}`
    )
  },
  computed: {
    ...mapState(['overviewForm']),
    activeRoutes(){
      let boutonniereQty = (
        parseInt(this.overviewForm.groom_qty) +
        parseInt(this.overviewForm.groomsmen_qty) +
        parseInt(this.overviewForm.ring_bearer_qty) +
        parseInt(this.overviewForm.grandfathers_qty) +
        parseInt(this.overviewForm.fathers_qty)
        )

      let routeData = [
        {
          qty: 1,
          path: '/wedding_details',
          active: true
        },
        {
          qty: parseInt(this.overviewForm.bridal_qty),
          path: '/bride',
          active: true
        },
        {
          qty: parseInt(boutonniereQty),
          path: '/groom',
          active: true
        },
        {
          qty: parseInt(this.overviewForm.bridesmaids_qty),
          path: '/bridesmaids',
          active: true
        },
        {
          qty: parseInt(this.overviewForm.mothers_qty) + parseInt(this.overviewForm.grandmothers_qty),
          path: '/mothers',
          active: true
        },
        {
          qty: parseInt(this.overviewForm.flowergirl_qty),
          path: '/flowergirl',
          active: true
        },
        {
          qty: 1,
          path: '/candles',
          active: true
        }
        ]
      for (let i = 0; i < routeData.length; i++) {
        if (parseInt(routeData[i].qty) <= 0 ) {
          routeData[i].active = false
        } else {
          routeData[i].active = true
        }
      }
      console.log(routeData)
      return routeData
    },
    currentRoutes() {
      var newArr = this.activeRoutes.filter((item) => {
        return item.active === true
      })
      return newArr
    },

    paths(){
      var currentIndex = 'none'
      this.currentRoutes.find( (item, index)=>{
        if (this.$route.path === item.path) {
          currentIndex = index
        }
      })
      if (currentIndex === 0) {
        return {prev: {path: '/collections'}, next: this.currentRoutes[currentIndex + 1]}
      }

      if (currentIndex === this.currentRoutes.length - 1 ) {
        return {prev: this.currentRoutes[currentIndex - 1], next: {path: '/centerpieces'}  }
      }

      if (currentIndex !== 'none') {
        return {prev: this.currentRoutes[currentIndex - 1], next: this.currentRoutes[currentIndex + 1]}
      }

      return { prev: {path: this.prev}, next: {path: this.next} }
    },

    pathLabels(){
      let prevLabel = this.paths.prev.path
      let nextLabel = this.paths.next.path

      if (prevLabel === '/') { prevLabel = '/welcome' }

      return {prev: prevLabel.substr(1).replace(/_/g, ' '), next: nextLabel.substr(1).replace(/_/g, ' ')}
    }
  },

  methods: {
    goTo(pos){
      this.$router.push(pos)
      window.scrollTo(0, 0)
    }
  }
}
</script>

<style scoped>
.path-label {
  color: #4e4e4e !important;
  line-height: .9;
}
.md-button-content {
  font-size: .9em;
  padding-top: 2px;
}

.md-secondary {
  padding: 0px 6px;
  font-size: .95em;
  margin: 6px 3px;
}

.sticky-buttons {
  position: fixed;
  bottom: 20px;
  right: 25px;
  z-index: 10000000;
}
</style>