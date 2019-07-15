export default {
  state: {
    welcome: false,
    overview: false,
    collections: false,
    wedding_details: false,
    wedding_party: false,
    bride_groom: false,
    bride: false,
    groom: false,
    groomsmen: false,
    fathers: false,
    grandfathers: false,
    bridesmaids: false,
    mothers: false,
    grandmothers: false,
    ring_bearer: false,
    flowergirl: false,
    extras: false,
    candles: false,
    centerpieces: false,
    arrangements: false,
    summary: false
  },

  mutations: {
    setVisibleSection(state, section) {
      state[section.name] = section.visible

      Object.keys(state).forEach(function(itm) {
        if (itm != section.name) state[itm] = false

        switch (section.name) {
          case 'bride':
            state.bride_groom = true
            break
          case 'groom':
            state.bride_groom = true
            break
          case 'bridesmaids':
            state.wedding_party = true
            break
          case 'mothers':
            state.wedding_party = true
            break
          case 'flowergirl':
            state.wedding_party = true
            break
          case 'candles':
            state.extras = true
            break
          case 'centerpieces':
            state.extras = true
            break
          case 'arrangements':
            state.extras = true
            break
        }
      })
    }
  }
}
