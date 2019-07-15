<template>
  <div>
    <div
      id="welcome"
    />

    <div
      id="update_profile"
      class="container-fluid p-3"
    >
      <div
        class="row"
        data-aos="fade-in"
        data-aos-duration="850"
        data-aos-delay="100"
      >
        <div
          class="col-md-12"
        >
          <h4>
            <strong class="h2">
              Step 1:
            </strong>
            <span class="italic">
              Tell us a little about your event.
            </span>
          </h4>
          <hr>
          <p>
            <b>please start by entering some basic details</b>
          </p>
        </div>
      </div>

      <div class="row mt-2">
        <!-- first name -->
        <div
          class="col-md-4"
          data-aos="fade-in"
          data-aos-duration="650"
          data-aos-delay="100"
        >
          <md-field :class="getValidationClass('first_name')">
            <label>first name*</label>
            <md-input
              id="first-name"
              v-model="first_name"
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
            <label>last name*</label>
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
        <div
          class="col-md-4"
          data-aos="fade-in"
          data-aos-duration="650"
          data-aos-delay="150"
        >
          <md-field :class="getValidationClass('budget')">
            <label
              class="mdl-textfield__label"
              for="budgetFloating"
            >
              your budget
            </label>
            <md-input
              id="budgetFloating"
              v-model="budget"
              class="mdl-textfield__input"
              type="text"
              @blur="profileUpdateMixin('budget')"
            />
            <span
              v-if="!$v.budget.required"
              class="md-error"
            >
              A budget is required
            </span>
            <span
              v-else-if="!$v.budget.numeric"
              class="md-error"
            >
              Budget must be a number
            </span>
          </md-field>
        </div>
      </div>
      <!--end row-->

      <div class="row mt-5">
        <!-- phone number -->
        <div
          class="col-md-4"
          data-aos="fade-in"
          data-aos-duration="650"
          data-aos-delay="200"
        >
          <md-field :class="getValidationClass('phone_number')">
            <label
              for="phone_number"
              class="mdl-textfield__label"
            >
              phone number*
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
              v-if="!$v.phone_number.maxLength"
              class="md-error"
            >
              phone number must be 10 digits (no dashes)
            </span>
            <span
              v-else-if="!$v.phone_number.minLength"
              class="md-error"
            >
              phone number must be 10 digits (no dashes)
            </span>
            <span
              v-else-if="!$v.phone_number.numeric"
              class="md-error"
            >
              phone number cannot contain letters
            </span>
            <span
              v-else-if="!$v.phone_number.required"
              class="md-error"
            >
              phone number is required
            </span>
          </md-field>
        </div>

        <!-- email -->
        <div
          class="col-md-4"
          data-aos="fade-in"
          data-aos-duration="650"
          data-aos-delay="250"
        >
          <md-field :class="getValidationClass('billing_email')">
            <label
              for="email"
              class="mdl-textfield__label"
            >
              e-mail*
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
          class="col-md-4"
          data-aos="fade-in"
          data-aos-duration="650"
          data-aos-delay="300"
        >
          <md-field :class="getValidationClass('wedding_date')">
            <label
              for="wedding_date"
              class="mdl-textfield__label"
            >
              wedding date*
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
              weddings must be booked a minimum of 2 weeks ahead of time
            </span>
          </md-field>
        </div>
      </div>

      <div
        class="row text-right"
        data-aos="fade-in"
        data-aos-duration="600"
        data-aos-delay="600"
      >
        <div class="col-md-12">
          <a
            id="welcome-next"
            @click="validateInputs"
          >
            <button
              type="button"
              class="md-raised md-secondary float-right px-4"
            >
              next step
              <i
                class="ua-icon ua-icon-arrow-right"
                aria-hidden="true"
              />
            </button>
          </a>
        </div>
      </div>
    </div>
    <!--end container-fluid shadow-->
  </div>
</template>

<script>
import flatpickr from "flatpickr"
import moment from 'moment'
import { validationMixin } from 'vuelidate'
import {
    required,
    minLength,
    maxLength,
    numeric,
    email
  } from 'vuelidate/lib/validators'
import { mapFields } from 'vuex-map-fields'

const dateValid = (value) => {
        let wed_date = moment(value, "MM/DD/YYYY")
        let two_weeks = moment().add(14, 'days')
        return wed_date.isAfter(two_weeks)
      }

export default {
  name: 'Welcome',
  mixins: [validationMixin],
  data() {
    return {
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
      budget: {
        numeric,
        required,
        minLength: minLength(2),
        maxLength: maxLength(5)
      },
      phone_number: {
        required,
        minLength: minLength(10),
        maxLength: maxLength(13),
        numeric
      },
      billing_email: {
        required,
        email
      },
      wedding_date: {
        required,
        dateValid
      },


  },
  computed: {
    ...mapFields([
      'overviewForm.first_name',
      'overviewForm.last_name',
      'overviewForm.phone_number',
      'overviewForm.billing_email',
      'overviewForm.wedding_date',
      'overviewForm.budget'
    ])
  },

  mounted(){
    this.$parent.$options.methods.setVisSec({ name: 'welcome', visible: true })
    // init the date picker ui for wedding date
    flatpickr("#wedding_date", {
      enableTime: false,
      dateFormat: "m/d/Y"
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

    goToNextStep(){
      this.$router.push('/collections')
    },

    validateInputs() {
        this.$v.$touch()

        if (!this.$v.$invalid) {
          this.goToNextStep()
        }
      }
  }
}
</script>

<style>
.md-raised {
  border-radius: 500px !important;
}
</style>
