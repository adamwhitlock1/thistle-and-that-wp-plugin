<template>
  <div>
    <div class="container-fluid px-3">
      <div
        id="wedding_details"
        class="row mt-2"
        data-aos="fade-in"
        data-aos-duration="800"
        data-aos-delay="100"
      >
        <div
          v-inview:on="enterWeddingDetails"
          class="col-md-12"
        >
          <h4>
            <strong class="h2">
              Step 3:
            </strong>
            <span class="italic">
              Customize your wedding details
            </span>
          </h4>
          <hr>
        </div>
      </div>

      <div
        v-if="$store.state.overviewForm"
        class="row"
      >
        <div class="col-md-6 col-xs-12">
          <p
            class="mb-0"
            data-aos="fade-in"
            data-aos-delay="200"
          >
            <b>bridal wedding party</b>
          </p>

          <div
            data-aos="fade-in"
            data-aos-delay="200"
          >
            <md-field>
              <label for="bridal_qty">
                bridal bouquet
              </label>
              <md-input
                id="bridal_qty"
                v-model="bridal_qty"
                name="bridal_qty"
                type="number"
                @blur="profileUpdateMixin('bridal_qty')"
              />
            </md-field>
          </div>

          <div
            data-aos="fade-in"
            data-aos-delay="200"
          >
            <md-field>
              <label for="bridesmaids_qty">
                bridesmaids
              </label>
              <md-input
                id="bridesmaids_qty"
                v-model="bridesmaids_qty"
                name="bridesmaids_qty"
                type="number"
                @blur="profileUpdateMixin('bridesmaids_qty')"
              />
            </md-field>
          </div>

          <div
            data-aos="fade-in"
            data-aos-delay="200"
          >
            <md-field>
              <label for="mothers_qty">
                mothers
              </label>
              <md-input
                id="mothers_qty"
                v-model="mothers_qty"
                name="mothers_qty"
                type="number"
                @blur="profileUpdateMixin('mothers_qty')"
              />
            </md-field>
          </div>

          <div
            data-aos="fade-in"
            data-aos-delay="200"
          >
            <md-field>
              <label for="grandmothers_qty">
                grandmothers
              </label>
              <md-input
                id="grandmothers_qty"
                v-model="grandmothers_qty"
                name="grandmothers_qty"
                type="number"
                @blur="profileUpdateMixin('grandmothers_qty')"
              />
            </md-field>
          </div>

          <div
            data-aos="fade-in"
            data-aos-delay="200"
          >
            <md-field>
              <label
                for="flower_girl_qty"
                class="mdl-textfield__label"
              >
                flower girl
              </label>
              <md-input
                id="flower_girl_qty"
                v-model="flowergirl_qty"
                class="mdl-textfield__input"
                name="flowergirl_qty"
                type="number"
                @blur="profileUpdateMixin('flowergirl_qty')"
              />
            </md-field>
          </div>
        </div>

        <div class="col-md-6 col-xs-12 grooms-party">
          <p
            class="mb-0"
            data-aos="fade-in"
            data-aos-delay="200"
          >
            <b>groom's wedding party</b>
          </p>

          <div
            data-aos="fade-in"
            data-aos-delay="300"
          >
            <md-field>
              <label for="groom_qty">
                groom's boutonniere
              </label>
              <md-input
                id="groom_qty"
                v-model="groom_qty"
                name="groom_qty"
                type="number"
                @blur="profileUpdateMixin('groom_qty')"
              />
            </md-field>
          </div>

          <div
            data-aos="fade-in"
            data-aos-delay="300"
          >
            <md-field>
              <label
                for="groomsmen_qty"
                class="mdl-textfield__label"
              >
                groomsmen
              </label>
              <md-input
                id="groomsmen_qty"
                v-model="groomsmen_qty"
                name="groomsmen_qty"
                type="number"
                @blur="profileUpdateMixin('groomsmen_qty')"
              />
            </md-field>
          </div>

          <div
            data-aos="fade-in"
            data-aos-delay="300"
          >
            <md-field>
              <label for="fathers_qty">
                fathers
              </label>
              <md-input
                id="fathers_qty"
                v-model="fathers_qty"
                name="fathers_qty"
                type="number"
                @blur="profileUpdateMixin('fathers_qty')"
              />
            </md-field>
          </div>

          <div
            data-aos="fade-in"
            data-aos-delay="300"
          >
            <md-field>
              <label for="grandfathers_qty">
                grandfathers
              </label>
              <md-input
                id="grandfathers_qty"
                v-model="grandfathers_qty"
                name="grandfathers_qty"
                type="number"
                @blur="profileUpdateMixin('grandfathers_qty')"
              />
            </md-field>
          </div>

          <div
            data-aos="fade-in"
            data-aos-delay="300"
          >
            <md-field>
              <label for="ring_bearer_qty">
                ring bearer
              </label>
              <md-input
                id="ring_bearer_qty"
                v-model="ring_bearer_qty"
                name="ring_bearer_qty"
                type="number"
                @blur="profileUpdateMixin('ring_bearer_qty')"
              />
            </md-field>
          </div>
        </div>
      </div>

      <prev-next-buttons
        prev="/collections"
        next="/bride"
      />
    </div>
  </div>
</template>

<script>
import { mapFields } from 'vuex-map-fields'

export default {
  name: 'WeddingDetails',
  computed: {
    ...mapFields([
      'overviewForm.bridal_qty',
      'overviewForm.bridesmaids_qty',
      'overviewForm.mothers_qty',
      'overviewForm.grandmothers_qty',
      'overviewForm.flowergirl_qty',
      'overviewForm.groom_qty',
      'overviewForm.groomsmen_qty',
      'overviewForm.fathers_qty',
      'overviewForm.grandfathers_qty',
      'overviewForm.ring_bearer_qty',
      'overviewForm.centerpieces_qty',
      'overviewForm.candles_qty',
      'overviewForm.vases_qty',
      'overviewForm.linens_qty'
    ]),
  },
  methods: {
    enterWeddingDetails($v) {
      $v.enter = () => this.$parent.$options.methods.setVisSec({ name: 'wedding_details', visible: true })
    }
  }
}
</script>

<style scoped>
#linen-chart-btn {
  height: 45px;
}
i {
  font-size: 18px;
}

.section-design-your-wedding {
  height: 100vh;
}

.md-field {
  margin-bottom: 15px;
}
</style>