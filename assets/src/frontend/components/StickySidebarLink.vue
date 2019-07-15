<template>
  <div class="row">
    <div class="cb-button-list--button">
      <div
        class="fl-button-wrap fl-button-width-auto fl-button-left fl-button-has-icon"
        @click="scrollToTop"
      >
        <button
          class="fl-button"
          :class="{ active: this.$store.state.inView[computedStateToggle] }"
          role="button"
          @click="goToLink(anchor)"
        >
          <i
            v-if="iconClasses"
            :class="iconClasses"
            aria-hidden="true"
          />
          <span class="fl-button-text">
            {{ text }}
          </span>
        </button>
        <slot />
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      anchor: {
        type: String,
        default: ''
      },
      stateToggle: {
        type: String,
        default: ''
      },
      text: {
        type: String,
        default: 'welcome'
      },
      iconClasses: {
        type: String,
        default: ""
      }
      },
      computed: {
        computedStateToggle() {
          if (this.stateToggle) {
            return this.stateToggle
          } else {
            return this.anchor
          }
        },
      },
      methods: {
        validateInputs() {
        const btnReload = document.querySelector(`#${this.anchor}-next`)
        btnReload.click()
        },
        scrollToTop(){
          window.scrollTo(0, 0)
        },
        goToLink(anchor){
          // console.log(this.$route)
          // console.log(anchor)
          if ( this.$store.state.overviewForm.selected_collection !== "" || anchor === "/collections" || anchor === "/") {
            this.$router.push(anchor)
          } else {
            alert("Please choose a collection before moving to the next steps in the application.")
          }
        }
      }
  }
</script>

<style scoped>

.fl-button span,
.fl-button i,
.fl-button {
  color: #9e9e9e !important;
  transition: 0.3s;
  background-color: transparent !important;
}

.fl-button {
  padding-left: 20px !important;
}

.fl-button.active::after {
  content: ' ●';
  opacity: 1;
  color: #be9a2f;
  transition: 0.3s;
}

.fl-button.active,
.fl-button.active span,
.fl-button.active i {
  color: #be9a2f !important;
  font-weight: bold !important;
  background-color: transparent !important;
}

</style>