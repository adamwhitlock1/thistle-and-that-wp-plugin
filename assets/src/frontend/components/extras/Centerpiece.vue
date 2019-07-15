<template>
  <div
    class="text-center"
    data-aos="fade-in"
    data-aos-delay="600"
    data-aos-duration="1000"
  >
    <div class="container-fluid">
      <div class="row pt-3">
        <div class="col-md-12">
          <h3 class="text-center">
            {{ info[overviewForm.selected_collection].name }}
          </h3>
          <div class="row indiv-centerpiece-wrap">
            <div
              v-for="(item, index) in info[overviewForm.selected_collection]['avail_vars']"
              v-if="index < 3"
              :key="index"
              class="col-md-4 px-1"
              :class="{active: (item.attributes.attribute_options === selected_level)}"
            >
              <figure
                class="effect-sadie"
                @click="setSelectedCenterpiece(index)"
              >
                <img
                  :src="info[overviewForm.selected_collection]['avail_vars'][index]['image']['src']"
                  class="img-fluid flower-thumbnail-main"
                >
                <figcaption>
                  <h2>
                    {{ info[overviewForm.selected_collection]['avail_vars'][index].attributes.attribute_options }}: ${{ info[overviewForm.selected_collection]['avail_vars'][index].display_price }}
                  </h2>
                </figcaption>
              </figure>

              <div class="row">
                <div class="col-md-12">
                  <p
                    v-if="item.attributes.attribute_options === selected_level"
                    class="select selected-btn"
                  >
                    selected
                  </p>
                  <p
                    v-else
                    class="select select-btn"
                    @click="setSelectedCenterpiece(index)"
                  >
                    select
                  </p>
                </div>
                <div
                  v-if="item.attributes.attribute_options === selected_level"
                  class="col-md-4"
                  :class="{'offset-md-4': info[overviewForm.selected_collection]['avail_vars'].length < 4}"
                >
                  <md-field>
                    <label
                      for="centerpiece_qty"
                      class="qty-label"
                    >
                      quantity
                    </label>
                    <md-input
                      v-model="qty"
                      name="centerpiece_qty"
                      type="number"
                      class="qty-input"
                      @change="setSelectedCenterpiece(selectedLevel)"
                    />
                  </md-field>
                </div>
                <div
                  v-if="info[overviewForm.selected_collection]['avail_vars'].length > 3 && item.attributes.attribute_options === selected_level"
                  class="col-md-8"
                >
                  <span
                    class="text-center m-0 p-0"
                  >
                    Style
                  </span>
                  <select
                    v-model="selectedLevel"
                    class="dropdown-select m-0 p-0"
                    @change="setSelectedCenterpiece(selectedLevel)"
                  >
                    <option
                      v-for="(item, index) in levelsForExpanedStylesDropdown[info[overviewForm.selected_collection]['avail_vars'][index].attributes.attribute_options]"
                      :key="index"
                      :value="item.value"
                    >
                      <span>
                        {{ item.name }}
                      </span>
                    </option>
                  </select>
                </div>
              </div>
              <div class="col-md-12 text-center">
                <p>
                  Details:<br>
                  <span v-html="info[overviewForm.selected_collection]['avail_vars'][index]['variation_description']" />
                </p>
              </div>
            </div>
          </div>
          <!-- end section for all levels -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
    props: {
      // eslint-disable-next-line vue/require-default-prop
      info: Object,
    // eslint-disable-next-line vue/require-default-prop
    centerpieceName: {
      type: String
    }
  },
  data() {
    return {
      the_prod_id: this.info[this.$store.state.selectedConfig.initialCollection.collection]['prod_id'],
      selectedLevel: "",
      qty: 0
    }
  },
  computed: {
    ...mapState(['overviewForm']),
    selected_level(){
      return this.$store.state.activeSelections[this.centerpieceName][0].level
    },
    selectedCenterpiece: {
      get() {
        return this.$store.state.activeSelections[this.centerpieceName][0].level_index
      }
    },
    totalCost(){
      let total = this.$store.state.activeSelections[this.centerpieceName][0].price * this.qty
      return total
    },
    levelsForExpanedStylesDropdown() {

      let avail_vars = this.info[this.$store.state.overviewForm.selected_collection].avail_vars
      // console.log(avail_vars)
      let optionsObj = {}
      for (let i = 0; i < avail_vars.length; i++) {
        let propNumber = Object.keys(avail_vars[i].attributes).length

        if (propNumber > 1) {
          if (!optionsObj.hasOwnProperty(avail_vars[i].attributes.attribute_options)) {
            optionsObj[avail_vars[i].attributes.attribute_options] = []
          }
          optionsObj[avail_vars[i].attributes.attribute_options].push({name: avail_vars[i].attributes.attribute_color, value: i})
        }
      }
      return optionsObj
    }
  },

  mounted(){
    this.initializeQty()
    this.initializeIndex()
  },

  methods: {
    setSelectedCenterpiece(newVal) {
      this.selected_prod_id = (this.info[this.$store.state.selectedConfig.initialCollection.collection]['prod_id']).toString()
      this.selectedLevel = newVal
      // console.log(newVal)
        let obj = {
          member: this.centerpieceName,
          collection: this.$store.state.overviewForm.selected_collection,
          level: newVal,
          productInfo: this.info,
          qty: this.qty
        }
        this.selectedLevel = newVal
        this.$store.dispatch('activeSelections/setActiveCenterpieceSelection', obj, { root: true }).then(()=>{
          this.profileUpdateMixin('multi', this.centerpieceName)
        })
    },
    initializeQty(){
      if (typeof this.$store.state.activeSelections[this.centerpieceName][0].qty !== 'number' ){
          this.qty = 0
          // console.log("NOTHING FOR QTY")
        } else {
          this.qty = this.$store.state.activeSelections[this.centerpieceName][0].qty
        }
    },
    initializeIndex(){
      // console.log(parseInt(this.$store.state.activeSelections[this.centerpieceName][0].level_index) + " " + this.centerpieceName)
      if (this.$store.state.activeSelections[this.centerpieceName][0].level_index === "" ){
          this.selectedLevel = 1
          // console.log("NOTHING FOR INDEX OF " + this.centerpieceName)
        } else {
          this.selectedLevel = this.$store.state.activeSelections[this.centerpieceName][0].level_index
        }
    },
  }
  }
</script>

<style scoped>
.active img {
  border: 3px solid #D8CFE8 !important;
}

img {
  transition: .4s;
  border: 3px solid rgba(0,0,0,0);
}

</style>