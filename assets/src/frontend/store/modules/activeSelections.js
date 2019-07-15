export default {
  namespaced: true,
  state: {
    boutonniere: [
      {
        collection: '',
        level: '',
        level_index: 1,
        price: 0,
        prod_id: 0,
        ribbon_color: '#ffffff',
        ribbon_color_name: 'ivory',
        variant_id: 0,
        img: '',
        desc: ''
      }
    ],
    bridal: [
      {
        collection: '',
        level: '',
        level_index: 1,
        price: 0,
        prod_id: 0,
        ribbon_color: '#ffffff',
        ribbon_color_name: 'ivory',
        variant_id: 0,
        img: '',
        desc: ''
      }
    ],
    bridesmaids: [
      {
        collection: '',
        level: '',
        level_index: 1,
        price: 0,
        prod_id: 0,
        ribbon_color: '#ffffff',
        ribbon_color_name: 'ivory',
        variant_id: '',
        img: '',
        desc: ''
      }
    ],
    mothers: [
      {
        collection: '',
        level: '',
        level_index: 1,
        price: 0,
        prod_id: 0,
        ribbon_color: '#ffffff',
        ribbon_color_name: 'ivory',
        variant_id: 0,
        img: '',
        desc: ''
      }
    ],
    flowergirl: [
      {
        collection: '',
        level: '',
        level_index: 1,
        price: 0,
        prod_id: 0,
        ribbon_color: '#ffffff',
        ribbon_color_name: 'ivory',
        variant_id: 0,
        img: '',
        desc: ''
      }
    ],

    candles: [
      {
        collection: '',
        level: '',
        level_index: 1,
        price: 0,
        prod_id: 0,
        style: '',
        type: '',
        ribbon_color: '#ffffff',
        ribbon_color_name: 'ivory',
        variant_id: 0,
        img: '',
        desc: ''
      }
    ],

    multivase_centerpiece: [
      {
        collection: '',
        name: '',
        level: '',
        level_index: 1,
        price: 0,
        prod_id: 0,
        ribbon_color: '#ffffff',
        ribbon_color_name: 'ivory',
        variant_id: 0,
        img: '',
        desc: '',
        qty: 0
      }
    ],

    wood_centerpiece: [
      {
        collection: '',
        name: '',
        level: '',
        level_index: 1,
        price: 0,
        prod_id: 0,
        ribbon_color: '#ffffff',
        ribbon_color_name: 'ivory',
        variant_id: 0,
        img: '',
        desc: '',
        qty: 0,
        color: ''
      }
    ],

    glassbowl_centerpiece: [
      {
        collection: '',
        name: '',
        level: '',
        level_index: 1,
        price: 0,
        prod_id: 0,
        ribbon_color: '#ffffff',
        ribbon_color_name: 'ivory',
        variant_id: 0,
        img: '',
        desc: '',
        qty: 0
      }
    ],

    urn_centerpiece: [
      {
        collection: '',
        name: '',
        level: '',
        level_index: 1,
        price: 0,
        prod_id: 0,
        ribbon_color: '#ffffff',
        ribbon_color_name: 'ivory',
        variant_id: 0,
        img: '',
        desc: '',
        qty: 0
      }
    ],

    arch_arrangement: [
      {
        collection: '',
        name: '',
        level: '',
        level_index: 1,
        price: 0,
        prod_id: 0,
        ribbon_color: '#ffffff',
        ribbon_color_name: 'ivory',
        variant_id: 0,
        img: '',
        desc: '',
        qty: 0
      }
    ],
    metalstandfoam_arrangement: [
      {
        collection: '',
        name: '',
        level: '',
        level_index: 1,
        price: 0,
        prod_id: 0,
        ribbon_color: '#ffffff',
        ribbon_color_name: 'ivory',
        variant_id: 0,
        img: '',
        desc: '',
        qty: 0,
        color: "",
      }
    ],
    tallglasswater_arrangement: [
      {
        collection: '',
        name: '',
        level: '',
        level_index: 1,
        price: 0,
        prod_id: 0,
        ribbon_color: '#ffffff',
        ribbon_color_name: 'ivory',
        variant_id: 0,
        img: '',
        desc: '',
        qty: 0
      }
    ],
    tallglassfoam_arrangement: [
      {
        collection: '',
        name: '',
        level: '',
        level_index: 1,
        price: 0,
        prod_id: 0,
        ribbon_color: '#ffffff',
        ribbon_color_name: 'ivory',
        variant_id: 0,
        img: '',
        desc: '',
        qty: 0
      }
    ],
    largebuffet_arrangement: [
      {
        collection: '',
        name: '',
        level: '',
        level_index: 1,
        color: "",
        price: 0,
        prod_id: 0,
        ribbon_color: '#ffffff',
        ribbon_color_name: 'ivory',
        variant_id: 0,
        img: '',
        desc: '',
        qty: 0
      }
    ],
    candelabra: [
      {
        collection: '',
        name: '',
        level: '',
        level_index: 0,
        color: "",
        price: 0,
        prod_id: 0,
        ribbon_color: '#ffffff',
        ribbon_color_name: 'ivory',
        variant_id: 0,
        img: '',
        desc: '',
        qty: 0
      }
    ],
    smilex: [
      {
        collection: '',
        name: '',
        level: '',
        level_index: 0,
        color: "",
        price: 0,
        prod_id: 0,
        ribbon_color: '#ffffff',
        ribbon_color_name: 'ivory',
        variant_id: 0,
        img: '',
        desc: '',
        qty: 0
      }
    ]
  },
  mutations: {
    /**
     * this is the initial state saturation mutatation for activeSelections
     * it takes the activeSelections that is received by the rest endpoint
     * and updates the activeSelections of vuex with that data
     *
     * @param {*} state
     * @param {*} activeSelections
     */
    setAllActiveSelections(state, activeSelections) {
      // when the app loads, we grab activeSelections via REST request and pass to this mutation
      // each key value gets mirrored to state.activeSelections
      for ( let key in activeSelections) {
        state[key] = activeSelections[key]
      }
    },

    setSingleActiveSelection(state, obj) {
      state[obj.member][0] = obj.data
    },
    /**
     * a general mutation to set a part of activeSelections state
     *
     * @param state
     * @param obj - contains all the activeSelections properties to set
     *
     * obj.member - wedding party member that we are setting
     * obj.collection - floral collection
     * obj.level - modest, recommended, or lux level
     *
     * we use the productInfo state object to get the product price,
     * or any other info on that specific product that has been selected.
     *
     */
    setActiveSelection(state, obj) {

      state[obj.member][0]['collection'] = obj.collection
      state[obj.member][0]['level'] = obj.level

      // console.log("Obj for setActiveSelection")
      // console.log(obj)

      if ('master' in obj.productInfo[0] ) {
        // console.log("STANDARD PRODUCT W/OUT COLLECTION BASED VARIANTS")

        state[obj.member][0]['price'] = obj.productInfo[0]['master'].avail_vars[obj.level_index].display_price
        state[obj.member][0]['variant_id'] = obj.productInfo[0]['master'].avail_vars[obj.level_index].variation_id
        state[obj.member][0]['prod_id'] = obj.productInfo[0]['master'].prod_id
        state[obj.member][0]['level_index'] = obj.level_index
        state[obj.member][0]['desc'] = obj.productInfo[0]['master'].avail_vars[obj.level_index].variation_description
        state[obj.member][0]['img'] = obj.productInfo[0]['master'].avail_vars[obj.level_index].image.src
        if ( 'qty' in obj ){
          state[obj.member][0]['qty'] = obj.qty
        }
      } else {
        // variant product with collections
        state[obj.member][0]['price'] = obj.productInfo[0][obj.collection].avail_vars[obj.level_index].display_price
        state[obj.member][0]['variant_id'] = obj.productInfo[0][obj.collection].avail_vars[obj.level_index].variation_id
        state[obj.member][0]['level_index'] = obj.level_index
        state[obj.member][0]['desc'] = obj.productInfo[0][obj.collection].avail_vars[obj.level_index].variation_description
        state[obj.member][0]['img'] = obj.productInfo[0][obj.collection].avail_vars[obj.level_index].image.src
      }

    },

    setActiveSmilexSelection(state, obj){
      // console.log(obj)
      state[obj.member][0]['collection'] = obj.collection
      state[obj.member][0]['prod_id'] = obj.productInfo.prod_id
      state[obj.member][0]['price'] = obj.productInfo.price
      state[obj.member][0]['qty'] = obj.qty
    },

    setActiveCandleSelection(state, obj) {
      // console.log("Obj for setActiveCandleSelection")
      // console.log(obj)

      state[obj.member][0]['collection'] = obj.collection
      state[obj.member][0]['level_index'] = obj.level_index
      state[obj.member][0]['style'] = obj.productInfo[0]['master'].avail_vars[obj.level_index].attributes.attribute_style

      state[obj.member][0]['type'] =
        obj.productInfo[0]['master'].avail_vars[obj.level_index].attributes['attribute_candle-type']

      state[obj.member][0]['prod_id'] = obj.productInfo[0]['master'].prod_id
      state[obj.member][0]['variant_id'] = obj.productInfo[0]['master'].avail_vars[obj.level_index].variation_id

      state[obj.member][0]['level'] =
        obj.productInfo[0]['master'].avail_vars[obj.level_index].attributes['attribute_style'] +
        ' - ' +
        obj.productInfo[0]['master'].avail_vars[obj.level_index].attributes['attribute_candle-type']

      state[obj.member][0]['price'] = obj.productInfo[0]['master'].avail_vars[obj.level_index].display_price
      state[obj.member][0]['img'] = obj.productInfo[0]['master'].avail_vars[obj.level_index].image.src
      state[obj.member][0]['desc'] = obj.productInfo[0]['master'].avail_vars[obj.level_index].variation_description
    },

    setActiveCenterpieceSelection(state, obj) {

      // console.log(obj)

      state[obj.member][0].collection = obj.collection
      state[obj.member][0].level_index = obj.level
      state[obj.member][0].level = obj.productInfo[obj.collection].avail_vars[obj.level].attributes.attribute_options
      state[obj.member][0].prod_id = obj.productInfo[obj.collection].prod_id
      state[obj.member][0].variant_id = obj.productInfo[obj.collection].avail_vars[obj.level].variation_id

      state[obj.member][0].name =
        obj.productInfo[obj.collection].name +
        ' - ' +
        obj.productInfo[obj.collection].avail_vars[obj.level].attributes.attribute_options

      state[obj.member][0].price = obj.productInfo[obj.collection].avail_vars[obj.level].display_price
      state[obj.member][0].img = obj.productInfo[obj.collection].avail_vars[obj.level].image.src
      state[obj.member][0].desc = obj.productInfo[obj.collection].avail_vars[obj.level].variation_description
      state[obj.member][0].color = obj.productInfo[obj.collection].avail_vars[obj.level].attributes.attribute_color
      state[obj.member][0].qty = parseInt(obj.qty)
    },

    setRibbonColorName(state, payload) {
      // console.log(payload)
      state[payload.data.member][0]['ribbon_color_name'] = payload.sel_name
      state[payload.data.member][0]['ribbon_color'] = payload.data.value
    }
  },
  actions: {
    /**
     * when app is created, take the userSelections that are provided by the rest endpoint
     * and set the state to them if they have existing selections.
     * Otherwise if they do not have a selections then create a 'default'
     * selection to use as a starting point, especially for first time users
     *
     * @param {*} { state, commit, rootState }
     * @param {*} activeSelections - the selections that are provided by rest endpoint
     */
    appCreated({state, commit, rootState }, { activeSelections, productInfo }) {
      // because we are passing the activeSelections as reactive data, we JSON.stringify then parse it to remove reactivity from inital data
      // console.log(activeSelections)

      let activeSelectionsJson = JSON.parse(JSON.stringify(activeSelections))
      commit('setAllActiveSelections', activeSelectionsJson)
    },

    setActiveSelection({ commit, rootState }, obj) {
      // before commiting the 'setActiveSelection' mutation we append the product info for the wedding member to the obj
      // that way the product info can be used in the mutation where needed
      obj['productInfo'] = rootState.productInfo[obj.member + 'Info']
      commit('setActiveSelection', obj)
    },

    setActiveCandleSelection({ commit, rootState }, obj) {
      // before commiting the 'setActiveCandleSelection' mutation we append the product info for the wedding member to the obj
      // that way the product info can be used in the mutation where needed
      obj['productInfo'] = rootState.productInfo[obj.member + 'Info']
      // console.log("OBJECT for setActiveCandleSelection")
      // console.log(obj)
      commit('setActiveCandleSelection', obj)
    },
    setActiveSmilexSelection({ commit, rootState }, obj) {
      // before commiting the 'setActiveCandleSelection' mutation we append the product info for the wedding member to the obj
      // that way the product info can be used in the mutation where needed
      obj['productInfo'] = rootState.productInfo[obj.member + 'Info'][0].master
      // console.log("OBJECT for setActiveSmilexSelection")
      // console.log(obj)
      commit('setActiveSmilexSelection', obj)
    },

    setActiveCenterpieceSelection({ commit }, obj) {
      commit('setActiveCenterpieceSelection', obj)
    },

    setRibbonColorName({ commit, rootState }, data) {
      // console.log('HEX from action' + data.value)
      const allHex = rootState.ribbonColors.hex
      // console.log(allHex)
      // console.log(allHex.indexOf(data.value))
      const sel_name = rootState.ribbonColors.ribbon_color_names[allHex.indexOf(data.value)]

      commit('setRibbonColorName', { data, sel_name })
    }
  },
  getters: {
    getActiveCenterpieceIndex(state) {
      return state.flower_girl
    }
  }
}
