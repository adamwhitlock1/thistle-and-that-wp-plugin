<template>
  <div>
    <div class="container-fluid px-3">
      <div
        id="bride_groom"
        class="row mt-2"
        data-aos="fade-in"
        data-aos-duration="800"
        data-aos-delay="100"
      >
        <div
          v-inview:on="enterBrideGroom"
          class="col-md-12"
        >
          <h4>
            <strong class="h2">
              Step 4:
            </strong>
            <span class="italic">
              The Bridal Bouquet
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
                v-if="$store.state.productInfo.bridalInfo"
                v-inview:on="enterBride"
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
                    :src="variantProps('bridal').selectedImage()"
                    alt
                  />
                </div>
                <div class="form__field mt-3 text-center">
                  <div
                    class="form__label"
                    data-aos="fade-in"
                    data-aos-delay="500"
                    data-aos-duration="800"
                  >
                    <p class="m-0">
                      <strong>
                        Choose a ribbon color:
                        {{ bridal[0].ribbon_color_name }}
                      </strong>
                    </p>
                    <swatches
                      v-model="bridal[0].ribbon_color"
                      :colors="ribbonColors.hex"
                      swatch-size="50"
                      inline
                      @input="
                        setRibbonColorNameMixin(
                          bridal[0].ribbon_color,
                          'bridal'
                        )
                      "
                    />
                  </div>
                </div>
              </div>
              <div
                v-if="$store.state.productInfo"
                class="col-md-8 text-center"
                data-aos="fade-in"
                data-aos-delay="200"
              >
                <div
                  v-if="bridalInfo"
                  class="row pt-2"
                >
                  <div
                    v-for="(item, index) in bridalInfo[0][
                      bridal[0]['collection']
                    ]['avail_vars']"
                    :key="index"
                    class="col-md-4 text-center"
                  >
                    <label class="circular-label">
                      <input
                        :value="index"
                        type="radio"
                        name="collection"
                        :class="{active: index === selectedBridalLevelIndex}"
                        class="circular-radio"
                        @input="setBridal(index)"
                      />
                      <img
                        :src="item['image']['src']"
                        class="img-fluid w-75"
                        alt
                      />
                      <h5 class="w-100 level-title">
                        {{
                          item['attributes']['attribute_bouquet-options']
                        }}
                      </h5>
                      <h6 class="w-100 level-title">
                        ${{ item['display_price'] }}
                      </h6>
                      <p
                        v-if="index === selectedBridalLevelIndex"
                        class="select selected-btn"
                      >
                        selected
                      </p>
                      <p
                        v-else
                        class="select select-btn"
                        @click="setBridal(index)"
                      >
                        select
                      </p>

                      <p
                        class="w-100"
                      >
                        <small v-html="item.variation_description">
                        </small>
                      </p>
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <prev-next-buttons
              prev="/wedding_details"
              next="/groom"
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
import { mapGetters, mapMutations, mapState } from 'vuex'

export default {
  name: 'Bride',

  data() {
    return {
      showDialog: false,
      selectedBridalLevelIndex: null
    }
  },

  computed: {
    ...mapFields(['ribbonColors']),
    ...mapMultiRowFields(['activeSelections.bridal', 'productInfo.bridalInfo']),
    ...mapGetters(['variantProps']),
    ...mapState(['productInfo', 'overviewForm.selected_collection']),
  },
  mounted(){
    this.selectedBridalLevelIndex = this.$store.state.activeSelections.bridal[0].level_index
  },
  methods: {
    ...mapMutations(['../store/modules/activeSelections']),

    setBridal(index){
      let levelName = this.$store.state.productInfo.bridalInfo[0][this.$store.state.overviewForm.selected_collection].avail_vars[index].attributes['attribute_bouquet-options']

      let obj = {
        member: 'bridal',
        collection: this.$store.state.overviewForm.selected_collection,
        level: levelName.toLowerCase(),
        level_index: index
      }

      this.selectedBridalLevelIndex = index

      this.$store
        .dispatch('activeSelections/setActiveSelection', obj, { root: true })
        .then(() => {
          this.profileUpdateMixin('multi', 'bridal')
        })
    },

    enterBride($v) {
      $v.enter = el => {
        this.$parent.$options.methods.setVisSec({
          name: 'bride',
          visible: true
        })
      }
    },

    enterBrideGroom($v) {
      $v.enter = el => {
        this.$parent.$options.methods.setVisSec({
          name: 'bride_groom',
          visible: true
        })
      }
    },

    enterGroom($v) {
      $v.enter = el => {
        this.$parent.$options.methods.setVisSec({
          name: 'groom',
          visible: true
        })
      }
    }
  }
}
</script>

<style scoped>
.level-title {
  font-family: 'Montserrat', Arial, sans-serif!important;
  margin-bottom: 0px;
}

.circular-label {
  cursor: pointer;
}
</style>
