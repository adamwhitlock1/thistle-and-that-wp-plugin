<template>
  <div>
    <div class="container-fluid">
      <div
        v-if="productInfo"
        class="row"
      >
        <div
          v-if="productInfo.candelabraInfo"
          class="col-md-12 col-xs-12"
        >
          <h3 class="text-center">
            Candelabra
          </h3>
          <hr>

          <div
            v-if="$store.state.productInfo"
            class="row"
          >
            <div
              v-for="(item, index) in candelabraInfo[0].master.avail_vars"
              :key="index"
              :class="{'offset-md-1': (index === 0) }"
              class="col-md-5 text-center"
            >
              <label class="circular-label">
                <input
                  :value="index"
                  type="radio"
                  name="collection"
                  class="circular-radio"
                  :class="{active: index === selectedCandelabraLevelIndex}"
                  @input="setCandelabra(index)"
                />
                <img
                  :src="item['image']['src']"
                  class="img-fluid w-75"
                  alt
                />
                <h5 class="w-100 level-title">
                  {{
                    item['attributes']['attribute_style']
                  }}
                </h5>
                <h6 class="w-100 level-title">
                  ${{ item['display_price'] }}
                </h6>
                <p
                  v-if="index === selectedCandelabraLevelIndex"
                  class="select selected-btn w-75 mx-auto"
                >
                  selected
                </p>
                <p
                  v-else
                  class="select select-btn w-75 mx-auto"
                  @click="setCandelabra(index)"
                >
                  select
                </p>

                <div
                  v-if="index === selectedCandelabraLevelIndex"
                  class="col-md-4 offset-md-4"
                >
                  <md-field>
                    <label
                      for="candelabra_qty"
                      class="qty-label"
                    >
                      quantity
                    </label>
                    <md-input
                      v-model="qty"
                      name="candelabra_qty"
                      type="number"
                      class="qty-input"
                      @change="setCandelabra(index)"
                    />
                  </md-field>
                </div>

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
</template>

<script>
import { mapFields } from 'vuex-map-fields'
import { mapMultiRowFields } from 'vuex-map-fields'
import { mapGetters, mapMutations, mapState } from 'vuex'

  export default {

    data() {
      return {
        showDialog: false,
        qty: 0,
        selectedCandelabraLevelIndex: 0
      }
    },

    computed: {
      ...mapFields(['selectedConfig.initialCollection', 'ribbonColors']),
      ...mapMultiRowFields(['activeSelections.candelabra', 'productInfo.candelabraInfo']),
      ...mapGetters(['variantProps']),
      ...mapState(['productInfo'])
    },

    mounted() {
      this.initializeQty()
      this.selectedCandelabraLevelIndex = this.$store.state.activeSelections.candelabra[0].level_index
    },

    methods: {
    ...mapMutations(['../store/modules/activeSelections']),

    setActiveVariant(value) {
      this.$store.commit('setActiveVariant', value)
    },

    setCandelabra(index) {

      let levelName = this.$store.state.productInfo.candelabraInfo[0].master.avail_vars[index].attributes['attribute_style']
      this.selectedCandelabraLevelIndex = index

      let obj = {
        member: 'candelabra',
        collection: this.$store.state.overviewForm.selected_collection,
        level_index: index,
        level: levelName,
        productInfo: this.$store.state.productInfo.candelabraInfo[0].master,
        qty: this.qty
      }
      // console.log(obj)
        this.$store.dispatch('activeSelections/setActiveSelection', obj, { root: true }).then(()=>{
          this.profileUpdateMixin('multi', 'candelabra')
        })
    },

    initializeQty(){
      // console.log(this.$store.state.activeSelections.candelabra[0].qty)
      if (this.$store.state.activeSelections.candelabra[0].qty === " " || this.$store.state.activeSelections.candelabra[0].qty === "" ){
          this.qty = 0
          // console.log("NOTHING FOR QTY")
        } else {
          this.qty = this.$store.state.activeSelections.candelabra[0].qty
        }
    }

  }
  }
</script>

<style scoped>

</style>