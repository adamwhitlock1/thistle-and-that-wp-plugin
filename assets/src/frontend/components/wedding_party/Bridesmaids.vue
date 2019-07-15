<template>
  <div>
    <div class="container-fluid px-3">
      <div v-if="$store.state.productInfo">
        <div
          v-if="$store.state.productInfo.bridesmaidsInfo"
          id="bridesmaids"
          class="row mt-2"
          data-aos="fade-in"
          data-aos-duration="800"
          data-aos-delay="100"
        >
          <div
            v-inview:on="enterBridesmaids"
            class="col-md-12"
          >
            <h4>
              <strong class="h2">
                Step 5:
              </strong>
              <span class="italic">
                Bridesmaid's Bouquets
              </span>
              <hr>
            </h4>

            <div class="container-fluid">
              <div
                class="row justify-content-center"
              >
                <div class="col-md-12 col-xs-12 justify-content-center">
                  <div

                    class="row justify-content-center"
                  >
                    <div class="col-md-4 justify-content-center">
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
                          :src="variantProps('bridesmaids').selectedImage()"
                          alt=""
                        >
                      </div>
                      <div class="form__field mt-3 text-center">
                        <div
                          class="form__label"
                          data-aos="fade-in"
                          data-aos-delay="500"
                          data-aos-duration="800"
                        >
                          <strong>
                            Choose a ribbon color:
                            {{ bridesmaids[0].ribbon_color_name }}
                          </strong>
                          <swatches
                            v-model="bridesmaids[0].ribbon_color"
                            :colors="ribbonColors.hex"
                            swatch-size="50"
                            inline
                            @input="setRibbonColorNameMixin(bridesmaids[0].ribbon_color, 'bridesmaids')"
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
                        class="row pt-2"
                      >
                        <div
                          v-for="(item, index) in bridesmaidsInfo[0][
                            bridesmaids[0]['collection']
                          ]['avail_vars']"
                          :key="index"
                          class="col-md-4 text-center"
                        >
                          <label class="circular-label">
                            <input
                              :value="index"
                              type="radio"
                              name="collection"
                              :class="{active: index === selectedBridesmaidsLevelIndex}"
                              class="circular-radio"
                              @input="setBridesmaids(index)"
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
                              v-if="index === selectedBridesmaidsLevelIndex"
                              class="select selected-btn"
                            >
                              selected
                            </p>
                            <p
                              v-else
                              class="select select-btn"
                              @click="setBridesmaids(index)"
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
                </div>
              </div>


              <prev-next-buttons
                prev="/groom"
                next="/mothers"
              />
            </div>
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
  name: 'Bridesmaids',

  data() {
    return {
      selectedBridesmaidsLevelIndex: null
    }
  },

  computed: {
    ...mapFields(['overviewForm', 'selectedConfig.initialCollection', 'ribbonColors']),
    ...mapMultiRowFields(['activeSelections.bridesmaids', 'productInfo.bridesmaidsInfo']),
    ...mapGetters(['variantProps']),
    ...mapState(['productInfo']),
  },

  mounted(){
    this.selectedBridesmaidsLevelIndex = this.$store.state.activeSelections.bridesmaids[0].level_index
  },

  methods: {
    ...mapMutations(['../store/modules/activeSelections']),

    setBridesmaids(index){
      let levelName = this.$store.state.productInfo.bridesmaidsInfo[0][this.$store.state.overviewForm.selected_collection].avail_vars[index].attributes['attribute_bouquet-options']

      let obj = {
        member: 'bridesmaids',
        collection: this.$store.state.overviewForm.selected_collection,
        level: levelName.toLowerCase(),
        level_index: index
      }

      this.selectedBridesmaidsLevelIndex = index

      this.$store
        .dispatch('activeSelections/setActiveSelection', obj, { root: true })
        .then(() => {
          this.profileUpdateMixin('multi', 'bridesmaids')
        })
    },

    enterBridesmaids($v) {
      $v.enter = el => {
        this.$store.commit('setVisibleSection', { name: 'bridesmaids', visible: true })
      }
    }
  }
}
</script>

<style scoped>
</style>
