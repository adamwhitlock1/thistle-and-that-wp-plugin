<template>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12 col-xs-12 justify-content-center">
        <div
          class="row justify-content-center"
        >
          <div
            class="col-md-5 justify-content-center"
            data-aos="fade-in"
            data-aos-delay="300"
          >
            <transition name="fade">
              <img
                :key="activeSelections[product][0].img"
                :src="activeSelections[product][0].img"
                alt=""
              />
            </transition>
          </div>
          <div class="col-md-7 text-center">
            <h4
              class="mt-4 h2 text-center"
              data-aos="fade-in"
              data-aos-delay="200"
            >
              {{ product }}
              votive candles
            </h4>
            <hr />
            <div class="row">
              <div class="col-md-12">
                Votives will be a mix of shapes and sizes.
              </div>
              <div class="col-md-6">
                <div class="row">
                  <md-field>
                    <label>style for {{ productInfo[product + 'Info'][0].master.name }}</label>
                    <md-select
                      v-model="selectedCandlesLevel"
                      name=""
                    >
                      <!-- NEED TO CREATE COMPUTED PROP TO GIVE ARRAY OF AVAIL VARS FOR MULTIPLE STYLE PRODUCTS -->
                      <md-option
                        v-for="(item, index) in productInfo[info][0].master.avail_vars"
                        :key="product + index"
                        :value="index"
                      >
                        {{
                          item.attributes['attribute_style'] +
                            ' - ' +
                            item.attributes['attribute_candle-type']
                        }}
                      </md-option>
                    </md-select>
                  </md-field>
                  <md-field>
                    <label :for="product + '_qty'">
                      quantity
                    </label>
                    <md-input
                      :id="product + '_qty'"
                      v-model="candles_qty"
                      :name="product + '_qty'"
                      type="number"
                      @blur="profileUpdateMixin(product + '_qty')"
                    />
                  </md-field>
                </div>
              </div>

              <div class="col-md-6">
                <h4
                  class="mt-2 text-center"
                  data-aos="fade-in"
                  data-aos-delay="200"
                >
                  <span
                    v-if="
                      activeSelections.candles[0]
                        .price == 0.5
                    "
                  >
                    Price Each: ${{
                      activeSelections.candles[0].price
                    }}0
                  </span>
                  <span v-else>
                    Price Each: ${{
                      activeSelections.candles[0].price
                    }}
                  </span>
                </h4>
                <p class="mb-0">
                  We recommend 3 votives per round table.
                </p>
                <h4
                  class="mt-1 text-center"
                  data-aos="fade-in"
                  data-aos-delay="200"
                >
                  Total Cost: ${{ totalCost }}
                </h4>
              </div>
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
import { mapGetters, mapState } from 'vuex'

export default {
  name: 'Candles',
  props: {
    product:{
      type: String,
      default: "candles"
    },
    info:{
      type: String,
      default: "candlesInfo"
    },

  },

  computed: {
    ...mapFields([
      'overviewForm',
      'overviewForm.candles_qty'
    ]),
    ...mapState(['productInfo', 'activeSelections']),

    selectedCandlesLevel: {
      get() {
        return this.activeSelections.candles[0].level_index
      },
      set(newVal) {
        // this function will run whenever the input changes
        // console.log(newVal)
        let obj = {
          member: 'candles',
          collection: this.$store.state.overviewForm.selected_collection,
          level: newVal,
          level_index: newVal
        }
        // console.log(obj)
        this.$store.dispatch('activeSelections/setActiveCandleSelection', obj, {
          root: true
        }).then(() => {
          this.profileUpdateMixin('multi', 'candles')
        })
      }
    },

    totalCost() {
      return (
        this.activeSelections.candles[0].price *
        this.$store.state.overviewForm.candles_qty
      )
    }
  }
}
</script>

<style scoped>
i {
  font-size: 18px;
}
</style>
