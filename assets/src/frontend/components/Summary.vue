<template>
  <div>
    <div id="summary" />

    <div class="container-fluid p-4">
      <div
        class="row"
        data-aos="fade-in"
        data-aos-duration="850"
        data-aos-delay="100"
      >
        <div class="col-md-12">
          <h4>
            <strong class="h2">
              Step 8:
            </strong>
            <span class="italic">
              Summary
            </span>
            <hr />
          </h4>
        </div>

        <div class="container-fluid vh-105">
          <div
            v-inview:on="enterSummary"
            class="row"
          >
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                  <p class="h4 bold">
                    Warehouse Usage:
                  </p>
                  <p class="pt-2 h5">
                    We offer a space in our warehouse, including tools needed,
                    for you to create your arrangements. Maximum total of 12
                    people.
                    <strong>
                      Contact us for more information and pricing.
                    </strong>
                  </p>
                </div>

                <div class="col-md-6">
                  <table class="table table-sm">
                    <thead>
                      <tr class="thead-tr">
                        <th scope="col">
                          Name
                        </th>
                        <th scope="col">
                          Qty
                        </th>
                        <th scope="col">
                          Price Per
                        </th>
                        <th scope="col">
                          Total
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">
                          Bridal
                        </th>
                        <td>{{ allState.overviewForm.bridal_qty }}</td>
                        <td>
                          ${{ allState.activeSelections.bridal[0].price }}
                        </td>
                        <td>
                          ${{
                            allState.overviewForm.bridal_qty *
                              allState.activeSelections.bridal[0].price
                          }}
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                          Boutonniere
                        </th>
                        <td>{{ boutonniereQty }}</td>
                        <td>
                          ${{ allState.activeSelections.boutonniere[0].price }}
                        </td>
                        <td>
                          ${{
                            boutonniereQty *
                              allState.activeSelections.boutonniere[0].price
                          }}
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                          Bridesmaids
                        </th>
                        <td>{{ allState.overviewForm.bridesmaids_qty }}</td>
                        <td>
                          ${{ allState.activeSelections.bridesmaids[0].price }}
                        </td>
                        <td>
                          ${{
                            allState.overviewForm.bridesmaids_qty *
                              allState.activeSelections.bridesmaids[0].price
                          }}
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                          Mothers/Grand
                        </th>
                        <td>
                          {{
                            allState.overviewForm.grandmothers_qty +
                              allState.overviewForm.mothers_qty
                          }}
                        </td>
                        <td>
                          ${{ allState.activeSelections.mothers[0].price }}
                        </td>
                        <td>
                          ${{
                            (allState.overviewForm.grandmothers_qty +
                              allState.overviewForm.mothers_qty) *
                              allState.activeSelections.mothers[0].price
                          }}
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                          Flowergirl
                        </th>
                        <td>{{ allState.overviewForm.flowergirl_qty }}</td>
                        <td>
                          ${{ allState.activeSelections.flowergirl[0].price }}
                        </td>
                        <td>
                          ${{
                            allState.overviewForm.flowergirl_qty *
                              allState.activeSelections.mothers[0].price
                          }}
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                          Candles
                        </th>
                        <td>{{ allState.overviewForm.candles_qty }}</td>
                        <td>
                          ${{ (allState.activeSelections.candles[0].price).toFixed(2) }}
                        </td>
                        <td>
                          ${{
                            (allState.overviewForm.candles_qty *
                              allState.activeSelections.candles[0].price).toFixed(2)
                          }}
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                          Centerpieces
                        </th>
                        <td>{{ centerpieceSummary.centerpieceQty }}</td>
                        <td>variable</td>
                        <td>${{ centerpieceSummary.centerpieceTotal }}</td>
                      </tr>
                      <tr>
                        <th scope="row">
                          Arrangements
                        </th>
                        <td>{{ arrangementSummary.arrangementQty }}</td>
                        <td>variable</td>
                        <td>${{ arrangementSummary.arrangementTotal }}</td>
                      </tr>
                    </tbody>
                  </table>

                  <h4 class="float-right h5">
                    Total Cost: ${{ currentTotal }}
                  </h4>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <md-button
                type="button"
                class="md-raised md-secondary float-left"
                data-aos="fade-in"
                data-aos-duration="650"
                data-aos-delay="650"
                @click="$router.push('/overview')"
              >
                <i
                  class="ua-icon ua-icon-arrow-left"
                  aria-hidden="true"
                />
                previous
              </md-button>

              <md-button
                id="add-composite"
                type="button"
                class="md-raised md-secondary float-right"
                data-aos="fade-in"
                data-aos-duration="650"
                data-aos-delay="650"
                @click="checkCartForComposite"
              >
                add to cart
                <i
                  class="ua-icon ua-icon-arrow-right"
                  aria-hidden="true"
                />
              </md-button>

              <!-- begin dialog for after add to cart is completed -->
              <md-dialog :md-active.sync="showContinueToCart">
                <div class="container-fluid p-3">
                  <h2>
                    Your wedding flower package has been added to your cart!
                  </h2>

                  <md-dialog-actions>
                    <a href="/wholesale">
                      <md-button
                        class="md-secondary mx-2"
                        @click="goToWholesale"
                      >
                        Visit Wholesale Flowers
                      </md-button>
                    </a>
                    <a href="/cart">
                      <md-button
                        class="md-secondary mx-2"
                        @click="goToCart"
                      >
                        Proceed to cart >
                      </md-button>
                    </a>
                  </md-dialog-actions>
                </div>
              </md-dialog>
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
import { mapGetters } from 'vuex'

export default {
  name: 'SummarySection',

  data() {
    return {
      cart_item_key: '',
      showContinueToCart: false
    }
  },

  computed: {
    ...mapFields([
      'overviewForm',
      'selectedConfig.initialCollection',
      'ribbon_colors'
    ]),
    ...mapMultiRowFields(['activeSelections.candles', 'activeSelections']),
    ...mapGetters(['variantProps']),

    allState() {
      return this.$store.getters.allState
    },

    centerpieceSummary() {
      return this.$store.getters.getCenterpieceSummary
    },

    arrangementSummary() {
      return this.$store.getters.getArrangementSummary
    },

    currentTotal() {
      return this.$store.getters.getTotalCost
    },

    boutonniereQty() {
      let totalBoutonniers =
        (parseInt(this.allState.overviewForm.groom_qty) || 0) +
        (parseInt(this.allState.overviewForm.groomsmen_qty) || 0) +
        (parseInt(this.allState.overviewForm.fathers_qty) || 0) +
        (parseInt(this.allState.overviewForm.grandfathers_qty) || 0) +
        (parseInt(this.allState.overviewForm.ring_bearer_qty) || 0)
      return totalBoutonniers
    }
  },

  methods: {
    goToCart() {
      this.showContinueToCart = false
    },

    goToWholesale() {
      this.showContinueToCart = false
    },

    enterSummary($v) {
      $v.enter = () =>
        this.$store.commit('setVisibleSection', {
          name: 'summary',
          visible: true
        })
    },

    checkCartForComposite() {
      let options = {
        url: '/wp-json/wc/v2/cart',
        method: 'GET'
      }
      this.$http(options).then(res => {
        // console.log(res.body)
        if (Object.keys(res.body).length > 0) {
          // console.log('Items in cart.')
          let compositeInCart = false
          for (let key in res.body) {
            for (let key2 in res.body[key]) {
              if (key2 == 'product_id' && res.body[key][key2] == 1246) {
                compositeInCart = true
                this.cart_item_key = res.body[key]['key']
              }
            }
          }
          if (compositeInCart) {
            let overwrite = confirm(
              'You have a package type product already in your cart! \n Would you like to overwrite the current package in your cart with this new package? \n (Individual addon products will still remain in your cart)'
            )

            if (overwrite) {
              this.removeCompositeFromCart(this.cart_item_key)
              this.showContinueToCart = true
            }
          } else {
            this.addCompositeToCart()
            this.showContinueToCart = true
          }
        } else {
          this.addCompositeToCart()
          this.showContinueToCart = true
        }
      })
    },

    removeCompositeFromCart(cart_item_key) {
      let formData = new FormData()
      formData.append('action', 'remove_composite')
      formData.append('cart_item_key', cart_item_key)

      this.$http.post(ajax_url[0], formData).then(
        response => {
          // console.log(response.body)

          this.addCompositeToCart()
          this.updateCartTotal(response.body.cart_items)
        },
        response => {
          // error callback
          // console.log(response)
        }
      )
    },

    addCompositeToCart() {
      let formData = new FormData()
      formData.append('action', 'add_composite')
      // form data for bridal
      formData.append(
        'bridal_prod_id',
        this.allState.activeSelections.bridal[0].prod_id
      )
      formData.append(
        'bridal_variant_id',
        this.allState.activeSelections.bridal[0].variant_id
      )
      formData.append(
        'bridal_level',
        this.allState.activeSelections.bridal[0].level
      )
      formData.append(
        'bridal_qty',
        this.allState.overviewForm.bridal_qty
      )
      formData.append(
        'bridal_ribbon_color',
        this.allState.activeSelections.bridal[0].ribbon_color_name
      )

      // form data for bridesmaids
      formData.append(
        'bridesmaids_prod_id',
        this.allState.activeSelections.bridesmaids[0].prod_id
      )
      formData.append(
        'bridesmaids_variant_id',
        this.allState.activeSelections.bridesmaids[0].variant_id
      )
      formData.append(
        'bridesmaids_level',
        this.allState.activeSelections.bridesmaids[0].level
      )
      formData.append(
        'bridesmaids_qty',
        this.allState.overviewForm.bridesmaids_qty
      )
      formData.append(
        'bridesmaids_ribbon_color',
        this.allState.activeSelections.bridesmaids[0].ribbonColorName
      )

      // form data for boutonnieres
      let totalBoutonniers =
        (parseInt(this.allState.overviewForm.groom_qty) || 0) +
        (parseInt(this.allState.overviewForm.groomsmen_qty) || 0) +
        (parseInt(this.allState.overviewForm.fathers_qty) || 0) +
        (parseInt(this.allState.overviewForm.grandfathers_qty) || 0) +
        (parseInt(this.allState.overviewForm.ring_bearer_qty) || 0)
      formData.append(
        'boutonniere_prod_id',
        this.allState.activeSelections.boutonniere[0].prod_id
      )
      formData.append(
        'boutonniere_variant_id',
        this.allState.activeSelections.boutonniere[0].variant_id
      )
      formData.append(
        'boutonniere_level',
        this.allState.activeSelections.boutonniere[0].level
      )
      formData.append('boutonniere_qty', totalBoutonniers)
      // formData.append('boutonniere_ribbon_color', this.allState.activeSelections.boutonniere[0].ribbonColorName);

      // form data for mothers
      let totalMothers =
        (parseInt(this.allState.overviewForm.mothers_qty) || 0) +
        (parseInt(this.allState.overviewForm.grandmothers_qty) || 0)
      formData.append(
        'mothers_prod_id',
        this.allState.activeSelections.mothers[0].prod_id
      )
      formData.append(
        'mothers_variant_id',
        this.allState.activeSelections.mothers[0].variant_id
      )
      formData.append(
        'mothers_level',
        this.allState.activeSelections.mothers[0].level
      )
      formData.append('mothers_qty', totalMothers)
      formData.append(
        'mothers_ribbon_color',
        this.allState.activeSelections.mothers[0].ribbon_color_name
      )

      // form data for flower girl
      formData.append(
        'flowergirl_prod_id',
        this.allState.activeSelections.flowergirl[0].prod_id
      )
      formData.append(
        'flowergirl_qty',
        this.allState.overviewForm.flowergirl_qty
      )
      formData.append(
        'flowergirl_ribbon_color',
        this.allState.activeSelections.flowergirl[0].ribbon_color_name
      )

      // form data for flower girl
      formData.append(
        'candles_prod_id',
        this.allState.activeSelections.candles[0].prod_id
      )
      formData.append('candles_qty', this.allState.overviewForm.candles_qty)
      formData.append(
        'candles_variant_id',
        this.allState.activeSelections.candles[0].variant_id
      )
      formData.append(
        'candles_level',
        this.allState.activeSelections.candles[0].level
      )
      formData.append(
        'candles_style',
        this.allState.activeSelections.candles[0].style
      )
      formData.append(
        'candles_type',
        this.allState.activeSelections.candles[0].type
      )

      formData.append(
        'wood_centerpiece_prod_id',
        this.allState.activeSelections.wood_centerpiece[0].prod_id
      )
      formData.append(
        'wood_centerpiece_variant_id',
        this.allState.activeSelections.wood_centerpiece[0].variant_id
      )
      formData.append(
        'wood_centerpiece_level',
        this.allState.activeSelections.wood_centerpiece[0].level
      )
      formData.append(
        'wood_centerpiece_color',
        this.allState.activeSelections.wood_centerpiece[0].color
      )
      formData.append(
        'wood_centerpiece_qty',
        this.allState.activeSelections.wood_centerpiece[0].qty
      )

      formData.append(
        'urn_centerpiece_prod_id',
        this.allState.activeSelections.urn_centerpiece[0].prod_id
      )
      formData.append(
        'urn_centerpiece_variant_id',
        this.allState.activeSelections.urn_centerpiece[0].variant_id
      )
      formData.append(
        'urn_centerpiece_level',
        this.allState.activeSelections.urn_centerpiece[0].level
      )
      formData.append(
        'urn_centerpiece_color',
        this.allState.activeSelections.urn_centerpiece[0].color
      )
      formData.append(
        'urn_centerpiece_qty',
        this.allState.activeSelections.urn_centerpiece[0].qty
      )

      formData.append(
        'multivase_centerpiece_prod_id',
        this.allState.activeSelections.multivase_centerpiece[0].prod_id
      )
      formData.append(
        'multivase_centerpiece_variant_id',
        this.allState.activeSelections.multivase_centerpiece[0].variant_id
      )
      formData.append(
        'multivase_centerpiece_level',
        this.allState.activeSelections.multivase_centerpiece[0].level
      )
      formData.append(
        'multivase_centerpiece_color',
        this.allState.activeSelections.multivase_centerpiece[0].color
      )
      formData.append(
        'multivase_centerpiece_qty',
        this.allState.activeSelections.multivase_centerpiece[0].qty
      )

      formData.append(
        'glassbowl_centerpiece_prod_id',
        this.allState.activeSelections.glassbowl_centerpiece[0].prod_id
      )
      formData.append(
        'glassbowl_centerpiece_variant_id',
        this.allState.activeSelections.glassbowl_centerpiece[0].variant_id
      )
      formData.append(
        'glassbowl_centerpiece_level',
        this.allState.activeSelections.glassbowl_centerpiece[0].level
      )
      formData.append(
        'glassbowl_centerpiece_color',
        this.allState.activeSelections.glassbowl_centerpiece[0].color
      )
      formData.append(
        'glassbowl_centerpiece_qty',
        this.allState.activeSelections.glassbowl_centerpiece[0].qty
      )

      formData.append(
        'arch_arrangement_prod_id',
        this.allState.activeSelections.arch_arrangement[0].prod_id
      )
      formData.append(
        'arch_arrangement_variant_id',
        this.allState.activeSelections.arch_arrangement[0].variant_id
      )
      formData.append(
        'arch_arrangement_level',
        this.allState.activeSelections.arch_arrangement[0].level
      )
      formData.append(
        'arch_arrangement_color',
        this.allState.activeSelections.arch_arrangement[0].color
      )
      formData.append(
        'arch_arrangement_qty',
        this.allState.activeSelections.arch_arrangement[0].qty
      )

      formData.append(
        'largebuffet_arrangement_prod_id',
        this.allState.activeSelections.largebuffet_arrangement[0].prod_id
      )
      formData.append(
        'largebuffet_arrangement_variant_id',
        this.allState.activeSelections.largebuffet_arrangement[0].variant_id
      )
      formData.append(
        'largebuffet_arrangement_level',
        this.allState.activeSelections.largebuffet_arrangement[0].level
      )
      formData.append(
        'largebuffet_arrangement_color',
        this.allState.activeSelections.largebuffet_arrangement[0].color
      )
      formData.append(
        'largebuffet_arrangement_qty',
        this.allState.activeSelections.largebuffet_arrangement[0].qty
      )

      formData.append(
        'metalstandfoam_arrangement_prod_id',
        this.allState.activeSelections.metalstandfoam_arrangement[0].prod_id
      )
      formData.append(
        'metalstandfoam_arrangement_variant_id',
        this.allState.activeSelections.metalstandfoam_arrangement[0].variant_id
      )
      formData.append(
        'metalstandfoam_arrangement_level',
        this.allState.activeSelections.metalstandfoam_arrangement[0].level
      )
      formData.append(
        'metalstandfoam_arrangement_color',
        this.allState.activeSelections.metalstandfoam_arrangement[0].color
      )
      formData.append(
        'metalstandfoam_arrangement_qty',
        this.allState.activeSelections.metalstandfoam_arrangement[0].qty
      )

      formData.append(
        'tallglassfoam_arrangement_prod_id',
        this.allState.activeSelections.tallglassfoam_arrangement[0].prod_id
      )
      formData.append(
        'tallglassfoam_arrangement_variant_id',
        this.allState.activeSelections.tallglassfoam_arrangement[0].variant_id
      )
      formData.append(
        'tallglassfoam_arrangement_level',
        this.allState.activeSelections.tallglassfoam_arrangement[0].level
      )
      formData.append(
        'tallglassfoam_arrangement_color',
        this.allState.activeSelections.tallglassfoam_arrangement[0].color
      )
      formData.append(
        'tallglassfoam_arrangement_qty',
        this.allState.activeSelections.tallglassfoam_arrangement[0].qty
      )

      formData.append(
        'candelabra_prod_id',
        this.allState.activeSelections.candelabra[0].prod_id
      )
      formData.append(
        'candelabra_variant_id',
        this.allState.activeSelections.candelabra[0].variant_id
      )
      formData.append(
        'candelabra_qty',
        this.allState.activeSelections.candelabra[0].qty
      )
      formData.append(
        'candelabra_style',
        this.allState.activeSelections.candelabra[0].level
      )
      formData.append(
        'smilex_prod_id',
        this.allState.activeSelections.smilex[0].prod_id
      )
      formData.append(
        'smilex_qty',
        this.allState.activeSelections.smilex[0].qty
      )

      // add state object to post params
      let stateJson = JSON.parse(JSON.stringify(this.allState))

      // extra data can be deleted from the object before sending
      delete stateJson.ajaxUrl
      delete stateJson.currentTotal
      delete stateJson.inView
      delete stateJson.initialUserSelections
      delete stateJson.productInfo
      delete stateJson.ribbonColors
      delete stateJson.save_status
      delete stateJson.variant_options

      // previous cart json obj size 715kb
      // optimized cart json obj size 15kb !

      formData.append('all_state', JSON.stringify(stateJson))

      // eslint-disable-next-line no-undef
      this.$http.post(ajax_url[0], formData).then(
        response => {
          // get status
          response.status
          // get status text
          response.statusText
          // get 'Expires' header
          response.headers.get('Expires')
          // get body data
          this.someData = response.body
          // console.log(response.body)
          // console.log(response.body.cart_items);
          this.updateCartTotal(response.body.cart_items)
        },
        response => {
          // error callback
          // console.log(response)
        }
      )
    },

    setRibbonColorName(value) {
      this.$store.commit('setRibbonColorName', ['summary', value])
    },

    updateCartTotal(total) {
      (function($) {
        $('.cart-link').html(
          '<i class="ua-icon ua-icon-cart"></i>' + total + ' items'
        )
        // eslint-disable-next-line no-undef
      })(jQuery)
    }
  }
}
</script>

<style scoped>
i {
  font-size: 18px;
}

thead,
table,
.thead-tr,
.thead-tr th {
  border-top-color: rgba(0, 0, 0, 0);
  border-top-width: 0px;
}
</style>
