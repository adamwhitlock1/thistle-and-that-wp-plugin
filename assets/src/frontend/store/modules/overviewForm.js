export default {
  state() {
    return {
      "first_name":"",
      "last_name":"",
      "fiances_name":"",
      "selected_collection":"",
      "billing_address_1":"",
      "billing_address_2":"",
      "billing_city":"",
      "billing_state":"",
      "billing_postcode":"",
      "phone_number":"",
      "billing_email":"",
      "wedding_date":"",
      "wedding_venue":"",
      "budget":"",
      "bridal_qty":"",
      "bridesmaids_qty":"",
      "mothers_qty":"",
      "grandmothers_qty":"",
      "flowergirl_qty":"",
      "groom_qty":"",
      "groomsmen_qty":"",
      "fathers_qty":"",
      "grandfathers_qty":"",
      "ring_bearer_qty":"",
      "centerpieces_qty":"",
      "candles_qty": 0,
      "vases_qty":"",
      "linens_qty":"",
      "current_total": ""
    }
  },
  mutations: {
    setOverviewForm(state, data){
      for (let key in data) {
        state[key] = data[key]
      }
    },
    /**
     * a simple mutation to set the customers address state name to the correct value
     * based on the billing state dropdown.
     *
     * @param state
     * @param selState - the state info that was selected in customer info
     */
    setSelectedBillingState(state, selState) {
      state.billing_state = selState
    }
  }
}
