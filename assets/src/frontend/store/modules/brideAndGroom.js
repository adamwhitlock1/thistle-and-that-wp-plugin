export default {
  namespaced: true,
  state: {},

  getters: {
    productInfo: (state, getters, rootState) => {
      return rootState.productInfo.bridalInfo[0]
    }
  },

  mutations: {}
}
