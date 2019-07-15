<template>
  <div
    id="groom"
  >
    <div class="container-fluid">
      <div
        v-if="productInfo"
        class="row"
      >
        <div
          v-if="productInfo.boutonniereInfo"
          v-inview:on="enterGroom"
          class="col-md-12 col-xs-12 grooms-party"
        >
          <h4>
            <strong class="h2">
              Step 4b:
            </strong>
            <span class="italic">
              The Groom's Boutonnieres
            </span>
          </h4>
          <hr>

          <div
            v-if="$store.state.productInfo"
            class="row"
          >
            <div class="col-md-4">
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
                  :src="boutonniere[0].img"
                  alt
                >
              </div>
            </div>
            <div class="col-md-8">
              <div class="row pt-2">
                <div
                  v-for="(item, index) in boutonniereInfo[0].master.avail_vars"
                  :key="index"
                  class="col-md-4 text-center"
                >
                  <label class="circular-label">
                    <input
                      :value="index"
                      type="radio"
                      name="collection"
                      :class="{active: index === selectedBoutonniereLevelIndex}"
                      class="circular-radio"
                      @input="setBoutonniere(index)"
                    />
                    <img
                      :src="item['image']['src']"
                      class="img-fluid w-75"
                      alt
                    />
                    <h5 class="w-100 level-title">
                      {{
                        item['attributes']['attribute_options']
                      }}
                    </h5>
                    <h6 class="w-100 level-title">
                      ${{ item['display_price'] }}
                    </h6>
                    <p
                      v-if="index === selectedBoutonniereLevelIndex"
                      class="select selected-btn"
                    >
                      selected
                    </p>
                    <p
                      v-else
                      class="select select-btn"
                      @click="setBoutonniere(index)"
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
        prev="/bride_groom"
        next="/bridesmaids"
      />
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
        selectedBoutonniereLevelIndex: null
      }
    },

    computed: {
      ...mapFields(['selectedConfig.initialCollection', 'ribbonColors']),
      ...mapMultiRowFields(['activeSelections.boutonniere', 'productInfo.boutonniereInfo']),
      ...mapGetters(['variantProps']),
      ...mapState(['productInfo'])
    },

    mounted(){
      this.selectedBoutonniereLevelIndex = this.$store.state.activeSelections.boutonniere[0].level_index
    },

    methods: {
    ...mapMutations(['../store/modules/activeSelections']),

    setBoutonniere(index){
      let levelName = this.$store.state.productInfo.boutonniereInfo[0].master.avail_vars[index].attributes['attribute_options']

      let obj = {
        member: 'boutonniere',
        collection: this.$store.state.overviewForm.selected_collection,
        level: levelName.toLowerCase(),
        level_index: index
      }

      this.selectedBoutonniereLevelIndex = index

      this.$store
        .dispatch('activeSelections/setActiveSelection', obj, { root: true })
        .then(() => {
          this.profileUpdateMixin('multi', 'boutonniere')
        })
    },

    enterGroom($v) {
      $v.enter = el => {
        this.$parent.$options.methods.setVisSec({ name: 'groom', visible: true })
      }
    }
  }
  }
</script>

<style scoped>

</style>