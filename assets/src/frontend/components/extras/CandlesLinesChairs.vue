<template>
  <div>
    <div
      v-if="$store.state.productInfo"
      id="candles"
    >
      <div
        v-inview:on="enterCandles"
        class="container-fluid p-4"
      >
        <div
          v-if="$store.state.productInfo.candlesInfo"
          class="row"
          data-aos="fade-in"
          data-aos-duration="850"
          data-aos-delay="100"
        >
          <div class="col-md-12">
            <h4>
              <strong class="h2">
                Step 6:
              </strong>
              <span class="italic">
                Candles, Linens &amp; Chairs
              </span>
              <hr />
            </h4>


            <candles
              product="candles"
              info="candlesInfo"
            ></candles>
            <prev-next-buttons
              prev="/flower_girl"
              next="/centerpieces"
            />
          </div>
        </div>
        <!-- END v-if -->
      </div>
    </div>
  </div>
</template>

<script>
import Candles from './Candles'
  export default {
    name: "CandlesLinensChairs",
    components: {
      Candles
    },
    methods: {
      enterCandles($v) {
      $v.enter = el => {
        this.$store.commit('setVisibleSection', {
          name: 'candles',
          visible: true
        })
      }
    },
    }
  }
</script>

<style scoped>

</style>