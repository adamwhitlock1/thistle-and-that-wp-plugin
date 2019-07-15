import Vue from 'vue'
import Vuex from 'vuex'
import { getField, updateField } from 'vuex-map-fields'

import activeSelections from './modules/activeSelections'
// import productInfo from './modules/productInfo'
import overviewForm from './modules/overviewForm'
import inView from './modules/inView'
import ribbonColors from './modules/ribbonColors'

Vue.use(Vuex)

export default new Vuex.Store({
  strict: true,
  modules: {
    activeSelections,
    overviewForm,
    inView,
    ribbonColors
  },

  state: {
    ajaxUrl: ajax_url[0],
    selectedConfig: {
      initialCollection: {
        collection: 'classic_collection',
        level: 'recommended',
        level_index: 1
      }
    }
  },

  getters: {
    getField,

    getTotalCost(state) {
      let boutonniereTotal =
        state.activeSelections.boutonniere[0].price *
        ((parseInt(state.overviewForm.groom_qty) || 0) +
          (parseInt(state.overviewForm.groomsmen_qty) || 0) +
          (parseInt(state.overviewForm.fathers_qty) || 0) +
          (parseInt(state.overviewForm.grandfathers_qty) || 0) +
          (parseInt(state.overviewForm.ring_bearer_qty) || 0))

      let bridalTotal =
        state.activeSelections.bridal[0].price *
        (parseInt(state.overviewForm.bridal_qty) || 0)
      let bridesmaidsTotal =
        state.activeSelections.bridesmaids[0].price *
        (parseInt(state.overviewForm.bridesmaids_qty) || 0)

      let mothersGrandsTotal =
        state.activeSelections.mothers[0].price *
        ((parseInt(state.overviewForm.grandmothers_qty) || 0) +
          (parseInt(state.overviewForm.mothers_qty) || 0))

      let flowerGirlTotal =
        state.activeSelections.flowergirl[0].price *
        (parseInt(state.overviewForm.flowergirl_qty) || 0)

      let centerPiecesTotal =
        state.activeSelections.glassbowl_centerpiece[0].qty *
          (parseInt(state.activeSelections.glassbowl_centerpiece[0].price) ||
            0) +
        state.activeSelections.urn_centerpiece[0].qty *
          (parseInt(state.activeSelections.urn_centerpiece[0].price) || 0) +
        state.activeSelections.wood_centerpiece[0].qty *
          (parseInt(state.activeSelections.wood_centerpiece[0].price) || 0) +
        state.activeSelections.multivase_centerpiece[0].qty *
          (parseInt(state.activeSelections.multivase_centerpiece[0].price) || 0)

      let arrangementTotal =
        state.activeSelections.arch_arrangement[0].qty *
          (parseInt(state.activeSelections.arch_arrangement[0].price) || 0) +
        state.activeSelections.largebuffet_arrangement[0].qty *
          (parseInt(state.activeSelections.largebuffet_arrangement[0].price) ||
            0) +
        state.activeSelections.metalstandfoam_arrangement[0].qty *
          (parseInt(
            state.activeSelections.metalstandfoam_arrangement[0].price
          ) || 0) +
        state.activeSelections.tallglassfoam_arrangement[0].qty *
          (parseInt(
            state.activeSelections.tallglassfoam_arrangement[0].price
          ) || 0)

      let candlesTotal =
        (parseInt(state.overviewForm.candles_qty) || 0) *
        state.activeSelections.candles[0].price

      let candelabrasTotal = (parseInt(state.activeSelections.candelabra[0].qty) || 0) *
      state.activeSelections.candelabra[0].price

      let smilexTotal = (parseInt(state.activeSelections.smilex[0].qty) || 0) *
      parseInt(state.activeSelections.smilex[0].price)

      return (
        bridalTotal +
        boutonniereTotal +
        bridesmaidsTotal +
        mothersGrandsTotal +
        flowerGirlTotal +
        centerPiecesTotal +
        candlesTotal +
        arrangementTotal +
        candelabrasTotal +
        smilexTotal
      )
    },

    getCenterpieceSummary(state) {
      let centerpieceTotal =
        state.activeSelections.glassbowl_centerpiece[0].qty *
          (parseInt(state.activeSelections.glassbowl_centerpiece[0].price) ||
            0) +
        state.activeSelections.urn_centerpiece[0].qty *
          (parseInt(state.activeSelections.urn_centerpiece[0].price) || 0) +
        state.activeSelections.wood_centerpiece[0].qty *
          (parseInt(state.activeSelections.wood_centerpiece[0].price) || 0) +
        state.activeSelections.multivase_centerpiece[0].qty *
          (parseInt(state.activeSelections.multivase_centerpiece[0].price) || 0)

      let centerpieceQty =
        (parseInt(state.activeSelections.glassbowl_centerpiece[0].qty) || 0) +
        (parseInt(state.activeSelections.urn_centerpiece[0].qty) || 0) +
        (parseInt(state.activeSelections.wood_centerpiece[0].qty) || 0) +
        (parseInt(state.activeSelections.multivase_centerpiece[0].qty) || 0)

      return { centerpieceQty, centerpieceTotal }
    },

    getArrangementSummary(state) {
      let arrangementTotal =
        state.activeSelections.arch_arrangement[0].qty *
          (parseInt(state.activeSelections.arch_arrangement[0].price) || 0) +
        state.activeSelections.largebuffet_arrangement[0].qty *
          (parseInt(state.activeSelections.largebuffet_arrangement[0].price) ||
            0) +
        state.activeSelections.metalstandfoam_arrangement[0].qty *
          (parseInt(
            state.activeSelections.metalstandfoam_arrangement[0].price
          ) || 0) +
        state.activeSelections.candelabra[0].qty *
          (parseInt(
            state.activeSelections.candelabra[0].price
          ) || 0) +
        state.activeSelections.tallglasswater_arrangement[0].qty *
          (parseInt(
            state.activeSelections.tallglasswater_arrangement[0].price
          ) || 0) +
          (parseInt(state.activeSelections.smilex[0].qty) || 0) *
          parseInt(state.activeSelections.smilex[0].price)

      let arrangementQty =
        (parseInt(state.activeSelections.arch_arrangement[0].qty) || 0) +
        (parseInt(state.activeSelections.largebuffet_arrangement[0].qty) || 0) +
        (parseInt(state.activeSelections.candelabra[0].qty) || 0) +
        (parseInt(state.activeSelections.metalstandfoam_arrangement[0].qty) ||
          0) +
        (parseInt(state.activeSelections.tallglasswater_arrangement[0].qty) ||
          0) +
          (parseInt(state.activeSelections.smilex[0].qty) || 0)

      return { arrangementQty, arrangementTotal }
    },

    // get various properties of a specific variant based on the member it is passed
    // properties are accessed via returned functions
    // image(), price(), and description() require an index integer to be passed into them to access a specific property
    variantProps: state => member => {
      let level_index = state.activeSelections[member][0].level_index
      let initialColName = state.activeSelections[member][0].collection
      let selImg

      let selPrices = []
      let selImages = []
      let selDescriptions = []

      if (member == 'boutonniere' || member == 'candles') {
        if (state.productInfo === undefined) {
          selImages = []
          selDescriptions = []
          selImg = '/wp-content/uploads/2018/10/gen-placeholder.png'
          for (var i in [0]) {
            selPrices.push('0')
            selImages.push('/wp-content/uploads/2018/10/gen-placeholder.png')
            selDescriptions.push('desc')
          }
        } else {
          selImages = []
          selDescriptions = []
          selImg =
            state.productInfo[member + 'Info'][0]['master'].avail_vars[
              level_index
            ].image.src
          for (var i in [
            state.productInfo[member + 'Info'][0]['master'].avail_vars
          ]) {
            selPrices.push(
              state.productInfo[member + 'Info'][0]['master'].avail_vars[i]
                .display_price
            )
            selImages.push(
              state.productInfo[member + 'Info'][0]['master'].avail_vars[i]
                .image.src
            )
            selDescriptions.push(
              state.productInfo[member + 'Info'][0]['master'].avail_vars[i]
                .variation_description
            )
          }
        }
      } else {
        if (state.productInfo === undefined) {
          selImg = '/wp-content/uploads/2018/10/gen-placeholder.png'
          selDescriptions = []
          for (var i in [0, 1, 2]) {
            selPrices.push('0')
            selImages.push('/wp-content/uploads/2018/10/gen-placeholder.png')
            selDescriptions.push('desc')
          }
        } else {
          selImages = []
          selDescriptions = []
          selImg =
            state.productInfo[member + 'Info'][0][initialColName].avail_vars[
              level_index
            ].image.src
          for (var i2 in [
            state.productInfo[member + 'Info'][0][initialColName].avail_vars
          ]) {
            selPrices.push(
              state.productInfo[member + 'Info'][0][initialColName].avail_vars[
                i2
              ].display_price
            )
            selImages.push(
              state.productInfo[member + 'Info'][0][initialColName].avail_vars[
                i2
              ].image.src
            )
            selDescriptions.push(
              state.productInfo[member + 'Info'][0][initialColName].avail_vars[
                i2
              ].variation_description
            )
          }
        }
      }

      return {
        image(num) {
          return selImages[num]
        },
        selectedImage() {
          return selImg
        },
        price(num) {
          return selPrices[num]
        },
        description(num) {
          return selDescriptions[num]
        },
        collection() {
          return initialColName
        },
        collectionIndex() {
          return level_index
        }
      }
    },

    // we probably need to remove this and use a more specified state object,
    // bc this is causing the entire state object to be returned when needed for prototyping
    allState: state => {
      return state
    },

    variantPropsSingle: state => member => {
      let level_index = state.activeSelections[member][0].level_index
      let initialColName = state.activeSelections[member][0].collection
      let selImg = state.productInfo[member + 'Info'][0][initialColName].img

      let selPrice = state.productInfo[member + 'Info'][0][initialColName].price

      let selDescription =
        state.productInfo[member + 'Info'][0][initialColName].desc

      return {
        selectedImage() {
          return selImg
        },
        price() {
          return selPrice
        },
        description() {
          return selDescription
        },
        collection() {
          return initialColName
        },
        collectionIndex() {
          return level_index
        }
      }
    },

    /**
     * calculates total running cost as changes occur in configuration
     * TODO: add the rest of the bridal party members, only bride and boutonnieres, and bridesmaids totals right now
     *
     * @param state
     * @returns {number} - total cost to be used in the sidebar section
     */
    totalCost: state => {
      let bridalTotal =
        state.activeSelections.bridal[0].price *
        (parseInt(state.overviewForm.bridal_qty) || 0)
      let boutonniereTotal =
        state.activeSelections.boutonniere[0].price *
        ((parseInt(state.overviewForm.groom_qty) || 0) +
          (parseInt(state.overviewForm.groomsmen_qty) || 0) +
          (parseInt(state.overviewForm.fathers_qty) || 0) +
          (parseInt(state.overviewForm.grandfathers_qty) || 0) +
          (parseInt(state.overviewForm.ring_bearer_qty) || 0))

      let bridesmaidsTotal =
        state.activeSelections.bridesmaids[0].price *
        (parseInt(state.overviewForm.bridesmaids_qty) || 0)

      let mothersGrandsTotal =
        state.activeSelections.mothers[0].price *
        ((parseInt(state.overviewForm.grandmothers_qty) || 0) +
          (parseInt(state.overviewForm.mothers_qty) || 0))

      let flowerGirlTotal =
        state.activeSelections.flowergirl[0].price *
        (parseInt(state.overviewForm.flowergirl_qty) || 0)

      return (
        bridalTotal +
        boutonniereTotal +
        bridesmaidsTotal +
        mothersGrandsTotal +
        flowerGirlTotal
      )
    },

    budget: state => {
      return state.overviewForm.budget
    },

    getSingleOverviewFormField(state) {
      return getField(state.overviewForm)
    }
  },

  mutations: {
    updateField,

    setProdInfo(state, prodInfo) {
      Vue.set(state, 'productInfo', prodInfo)
      return 'done'
    },

    setProdInfoExtra(state, prodInfo) {
      for (let key in prodInfo) {
        Vue.set(state.productInfo, key, prodInfo[key])
      }
    },

    updateSingleOverviewFormField(state, field) {
      updateField(state.overviewForm, field)
    },

    setTotalCost(state, total) {
      let bridalTotal =
        state.activeSelections.bridal[0].price *
        (parseInt(state.overviewForm.bridal_qty) || 0)
      let boutonniereTotal =
        state.activeSelections.boutonniere[0].price *
        ((parseInt(state.overviewForm.groom_qty) || 0) +
          (parseInt(state.overviewForm.groomsmen_qty) || 0) +
          (parseInt(state.overviewForm.fathers_qty) || 0) +
          (parseInt(state.overviewForm.grandfathers_qty) || 0) +
          (parseInt(state.overviewForm.ring_bearer_qty) || 0))

      let bridesmaidsTotal =
        state.activeSelections.bridesmaids[0].price *
        (parseInt(state.overviewForm.bridesmaids_qty) || 0)

      let mothersGrandsTotal =
        state.activeSelections.mothers[0].price *
        ((parseInt(state.overviewForm.grandmothers_qty) || 0) +
          (parseInt(state.overviewForm.mothers_qty) || 0))

      let flowerGirlTotal =
        state.activeSelections.flowergirl[0].price *
        (parseInt(state.overviewForm.flowergirl_qty) || 0)

      let centerPiecesTotal =
        state.activeSelections.glassbowl_centerpiece[0].qty *
          (parseInt(state.activeSelections.glassbowl_centerpiece[0].price) ||
            0) +
        state.activeSelections.urn_centerpiece[0].qty *
          (parseInt(state.activeSelections.urn_centerpiece[0].price) || 0) +
        state.activeSelections.wood_centerpiece[0].qty *
          (parseInt(state.activeSelections.wood_centerpiece[0].price) || 0) +
        state.activeSelections.multivase_centerpiece[0].qty *
          (parseInt(state.activeSelections.multivase_centerpiece[0].price) || 0)

      state.overviewForm.current_total =
        bridalTotal +
        boutonniereTotal +
        bridesmaidsTotal +
        mothersGrandsTotal +
        flowerGirlTotal +
        centerPiecesTotal
    },

    setInitialCollection(state, initialSel) {
      // console.log('INITIAL COLLECTION SELECTION')
      // console.log(initialSel)

      state.overviewForm.selected_collection = initialSel.collection
      state.selectedConfig.initialCollection.collection = initialSel.collection
      state.selectedConfig.initialCollection.level = initialSel.level
      state.selectedConfig.initialCollection.level_index =
        initialSel.level_index

      // setting bridal info
      state.activeSelections.bridal[0].collection = initialSel.collection
      state.activeSelections.bridal[0].level = initialSel.level
      state.activeSelections.bridal[0].level_index = initialSel.level_index
      state.activeSelections.bridal[0].prod_id =
        state.productInfo.bridalInfo[0][initialSel.collection].prod_id
      state.activeSelections.bridal[0].variant_id =
        state.productInfo.bridalInfo[0][initialSel.collection].avail_vars[
          initialSel.level_index
        ].variation_id
      state.activeSelections.bridal[0].desc =
        state.productInfo.bridalInfo[0][initialSel.collection].avail_vars[
          initialSel.level_index
        ].variation_description
      state.activeSelections.bridal[0].img =
        state.productInfo.bridalInfo[0][initialSel.collection].avail_vars[
          initialSel.level_index
        ].image.src
      state.activeSelections['bridal'][0]['price'] =
        state.productInfo['bridalInfo'][0][
          initialSel.collection
        ].avail_vars[1].display_price

      // setting bridesmaids info
      state.activeSelections.bridesmaids[0].collection = initialSel.collection
      state.activeSelections.bridesmaids[0].level = initialSel.level
      state.activeSelections.bridesmaids[0].level_index = initialSel.level_index
      state.activeSelections.bridesmaids[0].prod_id =
        state.productInfo.bridesmaidsInfo[0][initialSel.collection].prod_id
      state.activeSelections.bridesmaids[0].variant_id =
        state.productInfo.bridesmaidsInfo[0][initialSel.collection].avail_vars[
          initialSel.level_index
        ].variation_id
      state.activeSelections['bridesmaids'][0]['price'] =
        state.productInfo['bridesmaidsInfo'][0][
          initialSel.collection
        ].avail_vars[1].display_price

      // setting mothers info
      state.activeSelections.mothers[0].collection = initialSel.collection
      state.activeSelections.mothers[0].level = initialSel.level
      state.activeSelections.mothers[0].level_index = initialSel.level_index
      state.activeSelections.mothers[0].prod_id =
        state.productInfo.mothersInfo[0][initialSel.collection].prod_id
      state.activeSelections.mothers[0].variant_id =
        state.productInfo.mothersInfo[0][initialSel.collection].avail_vars[
          state.activeSelections.mothers[0].level_index
        ].variation_id
      state.activeSelections.mothers[0].desc =
        state.productInfo.mothersInfo[0][initialSel.collection].avail_vars[
          state.activeSelections.mothers[0].level_index
        ].variation_description
      state.activeSelections.mothers[0].img =
        state.productInfo.mothersInfo[0][initialSel.collection].avail_vars[
          state.activeSelections.mothers[0].level_index
        ].image.src
      state.activeSelections['mothers'][0]['price'] =
        state.productInfo['mothersInfo'][0][
          initialSel.collection
        ].avail_vars[1].display_price

      // setting boutonniere info
      state.activeSelections.boutonniere[0].collection = initialSel.collection
      state.activeSelections.boutonniere[0].prod_id =
        state.productInfo.boutonniereInfo[0].master.prod_id
      state.activeSelections.boutonniere[0].level_index = 0
      state.activeSelections.boutonniere[0].level = 'white'
      state.activeSelections.boutonniere[0].variant_id =
        state.productInfo.boutonniereInfo[0].master.avail_vars[0].variation_id
      state.activeSelections.boutonniere[0].img =
        state.productInfo.boutonniereInfo[0].master.avail_vars[0].image.src
      state.activeSelections.boutonniere[0].desc =
        state.productInfo.boutonniereInfo[0].master.avail_vars[0].variation_description
      state.activeSelections.boutonniere[0].price =
        state.productInfo.boutonniereInfo[0].master.avail_vars[0].display_price

      // setting flower girl info
      state.activeSelections.flowergirl[0].collection = initialSel.collection
      state.activeSelections.flowergirl[0].prod_id =
        state.productInfo.flowergirlInfo[0][initialSel.collection].prod_id
      state.activeSelections.flowergirl[0].desc =
        state.productInfo.flowergirlInfo[0][initialSel.collection].desc
      state.activeSelections.flowergirl[0].img =
        state.productInfo.flowergirlInfo[0][initialSel.collection].img
      state.activeSelections.flowergirl[0].price =
        state.productInfo.flowergirlInfo[0][initialSel.collection].price

      // setting candle info
      state.activeSelections.candles[0].collection = initialSel.collection
      state.activeSelections.candles[0].prod_id =
        state.productInfo.candlesInfo[0].master.prod_id
      state.activeSelections.candles[0].level_index = 0
      state.activeSelections.candles[0].desc =
        state.productInfo.candlesInfo[0].master.avail_vars[0].variation_description
      state.activeSelections.candles[0].img =
        state.productInfo.candlesInfo[0].master.avail_vars[0].image.src
      state.activeSelections.candles[0].price =
        state.productInfo.candlesInfo[0].master.avail_vars[0].display_price
    }
  },
  actions: {
    setInitialCollectionAction({dispatch, commit, rootState}, obj){
      // console.log("dispatch setInitialCollectionAction")
      commit('setInitialCollection', obj)
      dispatch('activeSelections/setActiveCandleSelection',
      {...obj, member:"candles"}, { root: true} )
    }
  }
})
