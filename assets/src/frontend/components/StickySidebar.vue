<template>
  <div
    id="sticky-sidebar"
    class="container-fluid shadow position-sticky"
    data-margin-top="175"
  >
    <div
      v-if="$store.state.productInfo"
      class="row row-budget-total"
    >
      <div class="col-md-6">
        <!-- budget field -->
        <div
          id="budgetFloatingDiv"
          class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"
        >
          <md-field>
            <label
              class="mdl-textfield__label"
              for="budgetFloating"
            >
              your budget
            </label>
            <span class="md-prefix">
              $
            </span>
            <md-input
              id="budgetFloating"
              v-model="budget"
              class="mdl-textfield__input"
              type="number"
              @blur="profileUpdateMixin('budget')"
            />
          </md-field>
        </div>
      </div>
      <!-- current total -->
      <div class="col-md-6">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label cur-total">
          <md-field>
            <label
              class="mdl-textfield__label"
              for="sample3"
            >
              current total
            </label>
            <span class="md-prefix">
              $
            </span>
            <md-input
              :value="currentTotal"
              class="mdl-textfield__input"
              type="text"
            />
          </md-field>
        </div>
        <span
          id="budgetdif"
          :title="budgetTitle"
          :class="{ greentext: budgetDif >= 0}"
        >
          ${{ budgetDif }}
        </span>
      </div>
    </div>

    <div v-else>
      <h3 class="mt-4 text-center">
        <div class="lds-dual-ring" />
      </h3>
    </div>
    <!-- WELCOME -->
    <sticky-sidebar-link
      anchor="/"
      text="Welcome"
      icon-classes="fa fa-heart"
      state-toggle="welcome"
    />

    <!-- COLLECTIONS -->
    <sticky-sidebar-link
      anchor="/collections"
      text="Collections"
      icon-classes="ua-icon ua-icon-Grid"
      state-toggle="collections"
    />

    <!-- WEDDING DETAILS -->
    <sticky-sidebar-link
      anchor="/wedding_details"
      text="Wedding Details"
      icon-classes="fa fa-list-ul"
      state-toggle="wedding_details"
    />

    <!-- BRIDE AND GROOM -->
    <sticky-sidebar-link
      anchor="/bride_groom"
      text="Bride &amp; Groom"
      icon-classes="fa fa-diamond"
      state-toggle="bride"
    >
      <!-- BRIDE -->
      <sticky-sidebar-link
        v-if="this.$store.state.inView.bride_groom"
        class="sub"
        anchor="/bride_groom"
        state-toggle="bride"
        text="Bride"
      />

      <!-- GROOM -->
      <sticky-sidebar-link
        v-if="this.$store.state.inView.bride_groom"
        class="sub"
        anchor="/groom"
        text="Groom"
        state-toggle="groom"
      />
    </sticky-sidebar-link>

    <!-- WEDDING PARTY -->
    <sticky-sidebar-link
      anchor="/bridesmaids"
      text="Wedding Party"
      icon-classes="fa fa-birthday-cake"
      state-toggle="bridesmaids"
    >
      <!-- BRIDESMAIDS -->
      <sticky-sidebar-link
        v-if="this.$store.state.inView.wedding_party"
        class="sub"
        anchor="/bridesmaids"
        text="Bridesmaids"
        state-toggle="bridesmaids"
      />

      <!-- MOTHERS/GRANDS/TUSSY MUSSY -->
      <sticky-sidebar-link
        v-if="this.$store.state.inView.wedding_party"
        class="sub"
        anchor="/mothers"
        text="Mothers/Grands"
        state-toggle="mothers"
      />

      <!-- FLOWER GIRL -->
      <sticky-sidebar-link
        v-if="this.$store.state.inView.wedding_party"
        class="sub"
        anchor="/flowergirl"
        text="Flower Girl"
        state-toggle="flowergirl"
      />
    </sticky-sidebar-link>

    <!-- EXTRAS -->
    <sticky-sidebar-link
      anchor="/candles"
      text="Extras"
      icon-classes="fa fa-fire"
      state-toggle="candles"
    >
      <!-- CANDLES -->
      <sticky-sidebar-link
        v-if="this.$store.state.inView.extras"
        class="sub"
        anchor="/candles"
        text="Candles"
        state-toggle="candles"
      />

      <!-- CENTERPIECES -->
      <sticky-sidebar-link
        v-if="this.$store.state.inView.extras"
        class="sub"
        anchor="/centerpieces"
        text="Centerpieces"
        state-toggle="centerpieces"
      />

      <!-- ARRANGMENTS -->
      <sticky-sidebar-link
        v-if="this.$store.state.inView.extras"
        class="sub"
        anchor="/arrangements"
        text="Decor/Arrangements"
        state-toggle="arrangements"
      />
    </sticky-sidebar-link>

    <!-- OVERVIEW -->
    <sticky-sidebar-link
      anchor="/overview"
      text="Overview"
      icon-classes="ua-icon ua-icon-List"
      state-toggle="overview"
    />

    <!-- SUMMARY -->
    <sticky-sidebar-link
      anchor="/summary"
      text="Summary"
      icon-classes="ua-icon ua-icon-Compose"
      state-toggle="summary"
    />

    <button
      v-if="$store.state.overviewForm.first_name === 'adamwhitlock'"
      @click="clearSelections"
    >
      Clear selections!
    </button>
    <!--end container fluid shadow-->
  </div>
</template>

<script>
import StickySidebarLink from "./StickySidebarLink"
import { mapFields } from 'vuex-map-fields'
export default {
  name: 'StickySidebar',
  components: {
StickySidebarLink
  },
  data() {
    return {
      budgetTitle: ''
    }
  },

  computed: {
    ...mapFields(['overviewForm.budget', 'overviewForm.current_total']),
    currentTotal() {
        return this.$store.getters.getTotalCost
    },
    budgetDif: {
      get() {
        let budget = this.$store.getters.budget
        let total = this.$store.getters.getTotalCost
        if ( (budget - total) <= 0) {
          // eslint-disable-next-line vue/no-side-effects-in-computed-properties
          this.budgetTitle = 'You are under budget!'
        } else {
          // eslint-disable-next-line vue/no-side-effects-in-computed-properties
          this.budgetTitle = 'You are over budget.'
        }
        return budget - total
      }
    }
  },
methods: {
  clearSelections(){
    this.profileUpdateMixin('clear')
  }
}
}
</script>

<style scoped>

.md-button span,
.md-button i {
  transition: .35s !important;
}

.md-button:hover span,
.md-button:hover i {
  color:#be9a2f !important;
}

#sticky-sidebar {
  padding: 15px;
}

.row-budget-total {
  height: 65px;
}
.fl-button,
.fl-button span,
.fl-button i {
  color: #9e9e9e !important;
  transition: 0.3s;
  background-color: transparent;
}

.fl-button:hover {
  background-color: transparent;
  color: #be9a2f !important;
}

.active::after {
  content: ' ●';
  opacity: 1;
  color: #be9a2f;
  transition: 0.3s;
}

.active {
  color: #be9a2f !important;
  font-weight: bold !important;
}

.active_sub {
  font-weight: bold !important;
  padding: 0px 10px 2px 30px !important;
}

.sub >>> i,
.sub >>> span,
.sub >>> button,
.sub >>> a {
    font-size: 15px !important;
  padding: 0px 10px 0px 35px !important;
  line-height: 15px;
}


.active_sub span {
  font-size: 15px !important;
  padding: 0px;
  line-height: 15px;
}
.cur-total .md-field {
  margin-bottom: 1px !important;
}

#budgetdif {
  color: red;
  position: relative;
  margin-right: 10px;
  cursor: pointer;
  font-size: 12px;
}
#budgetdif::before {
  content: '';
  border: 10px solid transparent;
  border-left-width: 5px;
  border-right-width: 5px;
  position: absolute;
  margin-left: 5px;
  top: 50%;
  left: 95%;
  border-bottom: 10px solid red;
  transform: translateY(-80%);
}
#budgetdif.greentext {
  color: green;
}
#budgetdif.greentext::before {
  border-bottom-color: transparent;
  border-top-color: green;
  transform: translateY(-25%);
}
</style>
