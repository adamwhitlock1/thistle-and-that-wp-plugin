<template>
  <div>
    <div class="container-fluid px-3">
      <div
        id="mothers"
        class="row mt-2"
        data-aos="fade-in"
        data-aos-duration="800"
        data-aos-delay="100"
      >
        <div
          v-inview:on="enterMothers"
          class="col-md-12"
        >
          <h4>
            <strong class="h2">
              Step 5b:
            </strong>
            <span class="italic">
              Tussy Mussy Bouquets
            </span>
          </h4>
          <hr />
        </div>
      </div>

      <div class="container-fluid">
        <div
          v-if="$store.state.productInfo"
          class="row justify-content-center"
        >
          <div class="col-md-12 col-xs-12 justify-content-center">
            <div class="row justify-content-center">
              <div
                v-if="$store.state.productInfo.mothersInfo"
                class="col-md-4 justify-content-center"
              >
                <div
                  class="reveal-holder"
                  data-aos="reveal-item"
                >
                  <div
                    class="reveal-block right"
                    data-aos="reveal-right"
                    data-aos-duration="1000"
                    data-aos-delay="300"
                  />
                  <img
                    :src="variantProps('mothers').selectedImage()"
                    alt
                  />
                </div>

                <div
                  class="form__field mt-3 text-center"
                  ata-aos="fade-in"
                  data-aos-delay="200"
                >
                  <div class="form__label">
                    <strong>
                      Choose a ribbon color:
                      {{ mothers[0].ribbon_color_name }}
                    </strong>
                    <swatches
                      v-model="mothers[0].ribbon_color"
                      :colors="ribbonColors.hex"
                      swatch-size="50"
                      inline
                      @input="
                        setRibbonColorNameMixin(
                          mothers[0].ribbon_color,
                          'mothers'
                        )
                      "
                    />
                  </div>
                </div>
              </div>
              <div class="col-md-8 text-center">
                <div class="row">
                  <div class="col-md-6 text-center">
                    <label class="circular-label">
                      <input
                        type="radio"
                        name="collection"
                        value="1"
                        class="circular-radio"
                        :class="{active: 1 === selectedMothersLevelIndex}"
                        @input="setMothers(1)"
                      />
                      <img
                        :src="
                          mothersInfo[0][mothers[0]['collection']][
                            'avail_vars'
                          ][1]['image']['src']
                        "
                        class="img-fluid w-75"
                        alt
                      />
                      <h4 class="w-100">
                        Recommended - ${{
                          mothersInfo[0][mothers[0]['collection']][
                            'avail_vars'
                          ][1]['display_price']
                        }}
                      </h4>
                      <p
                        class="w-100"
                        v-html="
                          mothersInfo[0][mothers[0]['collection']][
                            'avail_vars'
                          ][1]['variation_description']
                        "
                      />
                    </label>
                  </div>
                  <div class="col-md-6 text-center">
                    <label class="circular-label">
                      <input
                        value="2"
                        type="radio"
                        name="collection"
                        class="circular-radio"
                        :class="{active: 2 === selectedMothersLevelIndex}"
                        @input="setMothers(2)"
                      />
                      <img
                        :src="
                          mothersInfo[0][mothers[0]['collection']][
                            'avail_vars'
                          ][2]['image']['src']
                        "
                        class="img-fluid w-75"
                        alt
                      />
                      <h4 class="w-100">
                        Lux - ${{
                          mothersInfo[0][mothers[0]['collection']][
                            'avail_vars'
                          ][2]['display_price']
                        }}
                      </h4>
                      <p
                        class="w-100"
                        v-html="
                          mothersInfo[0][mothers[0]['collection']][
                            'avail_vars'
                          ][2]['variation_description']
                        "
                      />
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end Outer row -->
        <prev-next-buttons
          prev="/bridesmaids"
          next="/flowergirl"
        />
      </div>
    </div>
  </div>
</template>

<script>
import { mapFields } from 'vuex-map-fields'
import { mapMultiRowFields } from 'vuex-map-fields'
import { mapGetters } from 'vuex'

export default {
  name: 'Mothers',

  data() {
    return {
      selectedMothersLevelIndex: null
    }
  },

  computed: {
    ...mapFields(['selectedConfig.initialCollection', 'ribbonColors']),
    ...mapMultiRowFields([
      'activeSelections.mothers',
      'productInfo.mothersInfo'
    ]),
    ...mapGetters(['variantProps']),
  },

  mounted(){
    this.selectedMothersLevelIndex = this.$store.state.activeSelections.mothers[0].level_index
  },

  methods: {

    setMothers(index){
      let levelName = this.$store.state.productInfo.mothersInfo[0][this.$store.state.overviewForm.selected_collection].avail_vars[index].attributes['attribute_bouquet-options']

      let obj = {
        member: 'mothers',
        collection: this.$store.state.overviewForm.selected_collection,
        level: levelName.toLowerCase(),
        level_index: index
      }

      this.selectedMothersLevelIndex = index

      this.$store
        .dispatch('activeSelections/setActiveSelection', obj, { root: true })
        .then(() => {
          this.profileUpdateMixin('multi', 'mothers')
        })
    },

    enterMothers($v) {
      $v.enter = el => {
        this.$store.commit('setVisibleSection', {
          name: 'mothers',
          visible: true
        })
      }
    },
    setRibbonColorName(value) {
      this.$store.commit('setRibbonColorName', ['mothers', value])
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

</style>
