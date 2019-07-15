<template>
  <div
    class="row mt-4"
    data-aos="fade-in"
    data-aos-duration="800"
    data-aos-delay="500"
  >
    <div class="col-md-12">
      <md-button
        type="button"
        class="float-left md-secondary md-raised"
        @click="goTo(prev)"
      >
        <i
          class="ua-icon ua-icon-arrow-left"
          aria-hidden="true"
        />
        previous
      </md-button>

      <md-button
        class="float-right md-secondary md-raised"
        @click="goTo(next)"
      >
        next step
        <i
          class="ua-icon ua-icon-arrow-right"
          aria-hidden="true"
        />
      </md-button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'PrevNextButtons',
  props: {
    prev: {
      type: String,
      default: '/'
    },
    next: {
      type: String,
      default: '/'
    }
  },
  methods: {
    goTo(pos){
      this.$router.push(pos)
      window.scrollTo(0, 0)
    }
  }
}
</script>

<style>
</style>