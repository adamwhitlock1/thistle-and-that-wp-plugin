<template>
  <div>
    <div id="overview" />

    <div
      id="update_profile"
      class="container-fluid p-4"
    >
      <div
        class="row"
        data-aos="fade-in"
        data-aos-duration="850"
        data-aos-delay="100"
      >
        <div
          v-inview:on="enterOverview"
          class="col-md-12"
        >
          <h4>
            <strong class="h2">
              Step 7:
            </strong>
            <span class="italic">
              final details
            </span>
          </h4>
          <hr />
        </div>
      </div>

      <div class="row">
        <!-- first name -->
        <div
          class="col-md-4"
          data-aos="fade-in"
          data-aos-duration="650"
          data-aos-delay="100"
        >
          <md-field :class="getValidationClass('first_name')">
            <label for="first-name">
              first name
            </label>
            <md-input
              id="first-name"
              v-model="first_name"
              name="first-name"
              autocomplete="given-name"
              @blur="profileUpdateMixin('first_name')"
            />
            <span
              v-if="!$v.first_name.required"
              class="md-error"
            >
              First name is required
            </span>
            <span
              v-else-if="!$v.first_name.minLength"
              class="md-error"
            >
              Invalid first name
            </span>
          </md-field>
        </div>

        <!-- last name -->
        <div
          class="col-md-4"
          data-aos="fade-in"
          data-aos-duration="650"
          data-aos-delay="150"
        >
          <md-field :class="getValidationClass('last_name')">
            <label>last name</label>
            <md-input
              id="last-name"
              v-model="last_name"
              @blur="profileUpdateMixin('last_name')"
            />
            <span
              v-if="!$v.last_name.required"
              class="md-error"
            >
              Last name is required
            </span>
            <span
              v-else-if="!$v.last_name.minLength"
              class="md-error"
            >
              Invalid last name
            </span>
          </md-field>
        </div>

        <!-- fiances name -->
        <div
          class="col-md-4"
          data-aos="fade-in"
          data-aos-duration="650"
          data-aos-delay="200"
        >
          <md-field :class="getValidationClass('fiances_name')">
            <label>fianc&eacute;'s name</label>
            <md-input
              id="fiances_name"
              v-model="fiances_name"
              @blur="profileUpdateMixin('fiances_name')"
            />
            <span
              v-if="!$v.fiances_name.required"
              class="md-error"
            >
              This field is required
            </span>
            <span
              v-else-if="!$v.fiances_name.minLength"
              class="md-error"
            >
              Invalid length, must be at least 2 characters
            </span>
          </md-field>
        </div>
      </div>
      <!--end row-->
      <div class="row">
        <!-- address 1 -->
        <div
          class="col-md-6"
          data-aos="fade-in"
          data-aos-duration="650"
          data-aos-delay="250"
        >
          <md-field :class="getValidationClass('billing_address_1')">
            <label for="billing_address_1">
              address
            </label>
            <md-input
              id="billing_address_1"
              v-model="billing_address_1"
              name="billing_address_1"
              type="text"
              @blur="profileUpdateMixin('billing_address_1')"
            />
            <span
              v-if="!$v.billing_address_1.required"
              class="md-error"
            >
              This field is required
            </span>
            <span
              v-else-if="!$v.billing_address_1.minLength"
              class="md-error"
            >
              Invalid length, must be at least 2 characters
            </span>
          </md-field>
        </div>

        <!-- address 2 -->
        <div
          class="col-md-6"
          data-aos="fade-in"
          data-aos-duration="650"
          data-aos-delay="300"
        >
          <md-field :class="getValidationClass('billing_address_2')">
            <label
              for="billing_address_2"
              class="mdl-textfield__label"
            >
              address (cont)
            </label>
            <md-input
              id="billing_address_2"
              v-model="billing_address_2"
              class="mdl-textfield__input"
              name="billing_address_2"
              type="text"
            />
          </md-field>
        </div>
      </div>

      <div class="row">
        <!-- city -->
        <div
          class="col-md-4"
          data-aos="fade-in"
          data-aos-duration="650"
          data-aos-delay="350"
        >
          <md-field :class="getValidationClass('billing_city')">
            <label
              for="billing_city"
              class="mdl-textfield__label"
            >
              city
            </label>
            <md-input
              id="billing_city"
              v-model="billing_city"
              class="mdl-textfield__input"
              name="billing_city"
              type="text"
              @blur="profileUpdateMixin('billing_city')"
            />
            <span
              v-if="!$v.billing_city.required"
              class="md-error"
            >
              This field is required
            </span>
            <span
              v-else-if="!$v.billing_city.minLength"
              class="md-error"
            >
              Invalid length, must be at least 2 characters
            </span>
          </md-field>
        </div>
        <div
          class="col-md-4"
          data-aos="fade-in"
          data-aos-duration="650"
          data-aos-delay="450"
        >
          <md-field :class="getValidationClass('billing_state')">
            <label for="billing_state">
              State
            </label>
            <md-select
              v-model="billing_state"
              name="billing_state"
              @input="setSelectedBillingState"
            >
              <md-option value="AL">
                Alabama
              </md-option>
              <md-option value="AK">
                Alaska
              </md-option>
              <md-option value="AZ">
                Arizona
              </md-option>
              <md-option value="AR">
                Arkansas
              </md-option>
              <md-option value="CA">
                California
              </md-option>
              <md-option value="CO">
                Colorado
              </md-option>
              <md-option value="CT">
                Connecticut
              </md-option>
              <md-option value="DE">
                Delaware
              </md-option>
              <md-option value="DC">
                District Of Columbia
              </md-option>
              <md-option value="FL">
                Florida
              </md-option>
              <md-option value="GA">
                Georgia
              </md-option>
              <md-option value="HI">
                Hawaii
              </md-option>
              <md-option value="ID">
                Idaho
              </md-option>
              <md-option value="IL">
                Illinois
              </md-option>
              <md-option value="IN">
                Indiana
              </md-option>
              <md-option value="IA">
                Iowa
              </md-option>
              <md-option value="KS">
                Kansas
              </md-option>
              <md-option value="KY">
                Kentucky
              </md-option>
              <md-option value="LA">
                Louisiana
              </md-option>
              <md-option value="ME">
                Maine
              </md-option>
              <md-option value="MD">
                Maryland
              </md-option>
              <md-option value="MA">
                Massachusetts
              </md-option>
              <md-option value="MI">
                Michigan
              </md-option>
              <md-option value="MN">
                Minnesota
              </md-option>
              <md-option value="MS">
                Mississippi
              </md-option>
              <md-option value="MO">
                Missouri
              </md-option>
              <md-option value="MT">
                Montana
              </md-option>
              <md-option value="NE">
                Nebraska
              </md-option>
              <md-option value="NV">
                Nevada
              </md-option>
              <md-option value="NH">
                New Hampshire
              </md-option>
              <md-option value="NJ">
                New Jersey
              </md-option>
              <md-option value="NM">
                New Mexico
              </md-option>
              <md-option value="NY">
                New York
              </md-option>
              <md-option value="NC">
                North Carolina
              </md-option>
              <md-option value="ND">
                North Dakota
              </md-option>
              <md-option value="OH">
                Ohio
              </md-option>
              <md-option value="OK">
                Oklahoma
              </md-option>
              <md-option value="OR">
                Oregon
              </md-option>
              <md-option value="PA">
                Pennsylvania
              </md-option>
              <md-option value="RI">
                Rhode Island
              </md-option>
              <md-option value="SC">
                South Carolina
              </md-option>
              <md-option value="SD">
                South Dakota
              </md-option>
              <md-option value="TN">
                Tennessee
              </md-option>
              <md-option value="TX">
                Texas
              </md-option>
              <md-option value="UT">
                Utah
              </md-option>
              <md-option value="VT">
                Vermont
              </md-option>
              <md-option value="VA">
                Virginia
              </md-option>
              <md-option value="WA">
                Washington
              </md-option>
              <md-option value="WV">
                West Virginia
              </md-option>
              <md-option value="WI">
                Wisconsin
              </md-option>
              <md-option value="WY">
                Wyoming
              </md-option>
            </md-select>
            <span
              v-if="!$v.billing_state.required"
              class="md-error"
            >
              This field is required
            </span>
          </md-field>

          <input
            id="billing_state"
            v-model="billing_state"
            hidden
            title="state-hidden"
            type="text"
          />
        </div>

        <!-- zip code -->
        <div
          class="col-md-4"
          data-aos="fade-in"
          data-aos-duration="650"
          data-aos-delay="450"
        >
          <md-field :class="getValidationClass('billing_postcode')">
            <label
              for="billing_postcode"
              class="mdl-textfield__label"
            >
              zip/postal code
            </label>
            <md-input
              id="billing_postcode"
              v-model="billing_postcode"
              class="mdl-textfield__input"
              name="billing_postcode"
              type="text"
              @blur="profileUpdateMixin('billing_postcode')"
            />
            <span
              v-if="!$v.billing_postcode.required"
              class="md-error"
            >
              This field is required
            </span>
            <span
              v-else-if="!$v.billing_postcode.minLength"
              class="md-error"
            >
              Invalid length, must be at least 5 characters
            </span>
          </md-field>
        </div>
      </div>

      <div class="row">
        <!-- phone number -->
        <div
          class="col-md-3"
          data-aos="fade-in"
          data-aos-duration="650"
          data-aos-delay="500"
        >
          <md-field :class="getValidationClass('phone_number')">
            <label
              for="phone_number"
              class="mdl-textfield__label"
            >
              phone number
            </label>
            <md-input
              id="phone_number"
              v-model="phone_number"
              class="mdl-textfield__input"
              name="phone_number"
              type="text"
              @blur="profileUpdateMixin('phone_number')"
            />
            <span
              v-if="!$v.phone_number.required"
              class="md-error"
            >
              This field is required
            </span>
            <span
              v-else-if="!$v.phone_number.minLength"
              class="md-error"
            >
              Invalid length, must be at least 10 characters
            </span>
          </md-field>
        </div>

        <!-- email -->
        <div
          class="col-md-3"
          data-aos="fade-in"
          data-aos-duration="650"
          data-aos-delay="550"
        >
          <md-field :class="getValidationClass('billing_email')">
            <label
              for="email"
              class="mdl-textfield__label"
            >
              e-mail
            </label>
            <md-input
              id="email"
              v-model="billing_email"
              class="mdl-textfield__input"
              name="email"
              type="text"
              @blur="profileUpdateMixin('billing_email')"
            />
            <span
              v-if="!$v.billing_email.email"
              class="md-error"
            >
              invalid email address
            </span>
            <span
              v-else-if="!$v.billing_email.required"
              class="md-error"
            >
              email address is required
            </span>
          </md-field>
        </div>

        <!-- wedding date -->
        <div
          class="col-md-3"
          data-aos="fade-in"
          data-aos-duration="650"
          data-aos-delay="600"
        >
          <md-field :class="getValidationClass('wedding_date')">
            <label
              for="wedding_date"
              class="mdl-textfield__label"
            >
              wedding date
            </label>
            <md-input
              id="wedding_date"
              v-model="wedding_date"
              class="mdl-textfield__input"
              name="wedding_date"
              type="text"
              @blur="profileUpdateMixin('wedding_date')"
            />
            <span
              v-if="!$v.wedding_date.required"
              class="md-error"
            >
              wedding date is required
            </span>
            <span
              v-else-if="!$v.wedding_date.dateValid"
              class="md-error"
            >
              Weddings must be booked a minimum of 2 weeks ahead of time
            </span>
          </md-field>
        </div>

        <!-- wedding venue/location -->
        <div
          class="col-md-3"
          data-aos="fade-in"
          data-aos-duration="650"
          data-aos-delay="650"
        >
          <md-field :class="getValidationClass('wedding_venue')">
            <label
              for="venue"
              class="mdl-textfield__label"
            >
              venue
            </label>

            <md-input
              id="venue"
              v-model="wedding_venue"
              class="mdl-textfield__input"
              name="venue"
              type="text"
              @blur="profileUpdateMixin('wedding_venue')"
            />
            <span
              v-if="!$v.wedding_venue.required"
              class="md-error"
            >
              This field is required
            </span>
            <span
              v-else-if="!$v.wedding_venue.minLength"
              class="md-error"
            >
              Invalid length, must be at least 2 characters
            </span>
          </md-field>
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
            @click="$router.push('/arrangements')"
          >
            <i
              class="ua-icon ua-icon-arrow-left"
              aria-hidden="true"
            />
            previous
          </md-button>

          <md-button
            type="button"
            data-aos="fade-in"
            data-aos-duration="650"
            data-aos-delay="650"
            class="float-right md-secondary md-raised"
            @click="validateInputs"
          >
            next step
            <i
              class="ua-icon ua-icon-arrow-right"
              aria-hidden="true"
            />
          </md-button>
        </div>
      </div>
    </div>
    <!--end container-fluid shadow-->
  </div>
</template>

<script>
import flatpickr from 'flatpickr'
import { validationMixin } from 'vuelidate'
import moment from 'moment'
import { required, minLength, maxLength, email } from 'vuelidate/lib/validators'
import { mapFields } from 'vuex-map-fields'

const dateValid = value => {
  let wed_date = moment(value, 'MM/DD/YYYY')
  let two_weeks = moment().add(14, 'days')
  return wed_date.isAfter(two_weeks)
}

export default {
  name: 'Overview',
  mixins: [validationMixin],
  data() {
    return {
      items: ['item 1', 'item 2', 'item 3', 'item 4'],
      selectedItems: [],
      form: {
        firstName: null,
        lastName: null
      }
    }
  },

  validations: {
    first_name: {
      required,
      minLength: minLength(2)
    },
    last_name: {
      required,
      minLength: minLength(2)
    },
    fiances_name: {
      required,
      minLength: minLength(2)
    },
    billing_address_1: {
      required,
      minLength: minLength(2)
    },
    billing_city: {
      required,
      minLength: minLength(2)
    },
    billing_state: {
      required
    },
    billing_postcode: {
      required,
      minLength: minLength(5)
    },
    phone_number: {
      required,
      minLength: minLength(10),
      maxLength: maxLength(13)
    },
    billing_email: {
      required,
      email
    },
    wedding_date: {
      required,
      dateValid
    },
    wedding_venue: {
      required,
      minLength: minLength(2)
    }
  },

  computed: {
    ...mapFields([
      'overviewForm.budget',
      'overviewForm.first_name',
      'overviewForm.last_name',
      'overviewForm.fiances_name',
      'overviewForm.billing_address_1',
      'overviewForm.billing_address_2',
      'overviewForm.billing_city',
      'overviewForm.billing_state',
      'overviewForm.billing_postcode',
      'overviewForm.phone_number',
      'overviewForm.billing_email',
      'overviewForm.wedding_date',
      'overviewForm.wedding_venue'
    ])
  },
  mounted() {
    flatpickr('#wedding_date', {
      enableTime: false,
      dateFormat: 'm/d/Y'
    })
  },
  methods: {
    getValidationClass(fieldName) {
      const field = this.$v[fieldName]

      if (field) {
        return {
          'md-invalid': field.$invalid && field.$dirty
        }
      }
    },

    validateInputs() {
      this.$v.$touch()

      if (!this.$v.$invalid) {
        this.$router.push('/summary')
      }
    },

    selectChanged() {
      // console.log(this.$store.state.overviewForm.formData.billing_state.value)
      document.getElementById(
        'billing_state'
      ).value = this.$store.state.overviewForm.billing_state.value
    },
    setSelectedBillingState(selState) {
      this.$store.commit('setSelectedBillingState', selState)
      document.getElementById(
        'billing_state'
      ).value = this.$store.state.overviewForm.billing_state
      this.profileUpdateMixin('billing_state')
    },
    enterOverview($v) {
      $v.enter = el => {
        this.$parent.$options.methods.setVisSec({
          name: 'overview',
          visible: true
        })
      }
    }
  }
}
</script>

<style>
#state-selector {
  border: none !important;
  background-color: rgba(255, 255, 255, 0) !important;
}
</style>
