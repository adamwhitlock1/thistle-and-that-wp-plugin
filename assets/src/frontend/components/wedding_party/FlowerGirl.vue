<template>
  <div>
    <div class="container-fluid px-3">
      <div
        id="flowergirl"
        class="row mt-2"
        data-aos="fade-in"
        data-aos-duration="850"
        data-aos-delay="100"
      >
        <div class="col-md-12">
          <h4>
            <strong class="h2">
              Step 5c:
            </strong>
            <span class="italic">
              Flower Girl
            </span>
            <hr>
          </h4>

          <div class="container-fluid vh-105">
            <div class="row justify-content-center">
              <div class="col-md-12 col-xs-12 justify-content-center">
                <div
                  v-inview:on="enterFlowerGirl"
                  class="row justify-content-center"
                >
                  <div
                    class="col-md-5 justify-content-center"
                    data-aos="fade-in"
                    data-aos-delay="300"
                  >
                    <img
                      :src="variantPropsSingle('flowergirl').selectedImage()"
                      alt=""
                    >
                  </div>
                  <div class="col-md-7 text-center">
                    <h4
                      class="mt-4 h2 text-center"
                      data-aos="fade-in"
                      data-aos-delay="200"
                    >
                      flower girl bouquet
                    </h4>
                    <hr>
                    <div
                      v-for="(item, index) in flowergirl"
                      :key="index"
                      class="row"
                    >
                      <div class="col-md-12">
                        <p
                          class="w-100 mt-3"
                          v-html="variantPropsSingle('flowergirl').description()"
                        />
                        <h4
                          class="mt-1 text-center"
                          data-aos="fade-in"
                          data-aos-delay="200"
                        >
                          ${{ variantPropsSingle('flowergirl').price() }}
                        </h4>
                        <!--customize arrangement for bridesmaids arrangement modal-->
                      </div>
                    </div>

                    <div
                      class="form__field mt-3"
                      ata-aos="fade-in"
                      data-aos-delay="200"
                    >
                      <div class="form__label">
                        <strong>Choose a ribbon color: {{ flowergirl[0].ribbon_color_name }}</strong>
                        <swatches
                          v-model="flowergirl[0].ribbon_color"
                          :colors="ribbonColors.hex"
                          swatch-size="50"
                          inline
                          @input="setRibbonColorName"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <prev-next-buttons
              prev="/mothers"
              next="/candles"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapFields } from 'vuex-map-fields'
import { mapMultiRowFields } from 'vuex-map-fields'
import { mapGetters } from 'vuex'

export default {
  name: 'FlowerGirl',

  props: ['memberProp'],

  data() {
    return {
      showDialog: false,
      selected_flowergirl: ''
    }
  },

  computed: {
    ...mapFields(['overviewForm', 'selectedConfig.initialCollection', 'ribbonColors']),
    ...mapMultiRowFields(['activeSelections.flowergirl']),
    ...mapGetters(['variantPropsSingle'])
  },

  methods: {
    enterFlowerGirl($v) {
      $v.enter = el => {
        this.$store.commit('setVisibleSection', { name: 'flowergirl', visible: true })
      }
    },
    setRibbonColorName(value) {
      console.log(value)
      this.$store.dispatch('activeSelections/setRibbonColorName', { member: 'flowergirl', value }, { root: true }).then(()=>{
        // console.log("Ribbon Color Set To: " + this.$store.state.activeSelections['bridal'][0]['ribbon_color_name'])
        this.profileUpdateMixin('multi', 'flowergirl')
      })

    }
  }
}
</script>

<style scoped>
#linen-chart-btn {
  height: 45px;
}
i {
  font-size: 18px;
}

.section-design-your-wedding {
  height: 100vh;
}
</style>
