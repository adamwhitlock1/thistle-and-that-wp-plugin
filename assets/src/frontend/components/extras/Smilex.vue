<template>
  <div class="container-fluid">
    <div
      v-if="productInfo"
      class="row"
    >
      <div
        v-if="productInfo.smilexInfo"
        class="col-md-12 col-xs-12"
      >
        <h3 class="text-center">
          Smilex
        </h3>
        <hr>

        <div
          v-if="$store.state.productInfo"
          class="row"
        >
          <div
            v-for="(item, index) in productInfo.smilexInfo[0]"
            :key="index"
            class="col-md-4 offset-md-4 text-center"
          >
            <label class="circular-label">
              <input
                :value="index"
                type="radio"
                name="collection"
                class="circular-radio"
                :class="{active: 0 === selectedSmilexLevelIndex}"
                @input="setSmilex(0)"
              />
              <img
                :src="item['img']"
                class="img-fluid w-75"
                alt
              />
              <h6 class="w-100 level-title">
                ${{ item['price'] }}
              </h6>
              <p
                v-if="0 === selectedSmilexLevelIndex"
                class="select selected-btn w-75 mx-auto"
              >
                selected
              </p>
              <p
                v-else
                class="select select-btn w-75 mx-auto"
                @click="setSmilex(0)"
              >
                select
              </p>

              <div
                v-if="0 === selectedSmilexLevelIndex"
                class="col-md-4 offset-md-4"
              >
                <md-field>
                  <label
                    for="smilex_qty"
                    class="qty-label"
                  >
                    quantity
                  </label>
                  <md-input
                    v-model="qty"
                    name="smilex_qty"
                    type="number"
                    class="qty-input"
                    @change="setSmilex(0)"
                  />
                </md-field>
              </div>

              <p
                class="w-100"
              >
                <small v-html="item.desc">
                </small>
              </p>
            </label>
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
        selectedSmilexLevelIndex: 0
      }
    },

    computed: {
      ...mapFields(['selectedConfig.initialCollection', 'ribbonColors']),
      ...mapMultiRowFields(['activeSelections.smilex', 'productInfo.smilexInfo']),
      ...mapGetters(['variantProps']),
      ...mapState(['productInfo'])
    },

    mounted() {
      this.initializeQty()
      this.selectedSmilexLevelIndex = this.$store.state.activeSelections.smilex[0].level_index
    },

    methods: {
    ...mapMutations(['../store/modules/activeSelections']),

    setActiveVariant(value) {
      this.$store.commit('setActiveVariant', value)
    },

    setSmilex(index) {

      // let levelName = this.$store.state.productInfo.smilexInfo[0].master.avail_vars[index].attributes['attribute_style']


      let obj = {
        member: 'smilex',
        collection: this.$store.state.overviewForm.selected_collection,
        level: ' ',
        qty: this.qty
      }

      this.selectedSmilexLevelIndex = index

      console.log(obj)
        this.$store.dispatch('activeSelections/setActiveSmilexSelection', obj, { root: true }).then(()=>{
          this.profileUpdateMixin('multi', 'smilex')
        })
    },

    initializeQty(){
      console.log(this.$store.state.activeSelections.smilex[0].qty)
      if (this.$store.state.activeSelections.smilex[0].qty === " " || this.$store.state.activeSelections.smilex[0].qty === "" ){
          this.qty = 0
          console.log("NOTHING FOR QTY")
        } else {
          this.qty = this.$store.state.activeSelections.smilex[0].qty
        }
    }

  }
  }
</script>

<style scoped>

</style>