<template>
  <div class="section-design-your-wedding">
    <div
      v-if="$store.state.activeSelections"
      id="arrangements"
    />

    <div class="container-fluid p-4">
      <div
        class="row"
        data-aos="fade-in"
        data-aos-duration="850"
        data-aos-delay="100"
      >
        <div
          v-inview:on="enterArrangements"
          class="col-md-12"
        >
          <h4>
            <strong class="h2">
              Step 6c:
            </strong>
            <span class="italic">
              Add Extra Decor
            </span>
          </h4>
          <hr>
        </div>
      </div>

      <div

        class="row"
        data-aos="fade-in"
        data-aos-duration="850"
        data-aos-delay="200"
      >
        <div class="row">
          <arrangement
            :info="$store.state.productInfo.largebuffet_arrangementInfo[0]"
            arrangement-name="largebuffet_arrangement"
          />
        </div>
        <div class="row">
          <arrangement
            :info="$store.state.productInfo.arch_arrangementInfo[0]"
            arrangement-name="arch_arrangement"
          />
        </div>

        <div class="row">
          <Candelabra></Candelabra>
        </div>

        <Smilex></Smilex>
      </div>


      <prev-next-buttons
        prev="/centerpieces"
        next="/overview"
      />
    </div>
    <!--end container-fluid shadow-->
  </div>
</template>

<script>
import Candelabra from './Candelabra'
import Smilex from './Smilex'
import Arrangement from './Arrangement'
import { mapState } from 'vuex'

export default {
  name: 'Arrangements',
  components: {
    Arrangement,
    Candelabra,
    Smilex
  },

  computed: {
    ...mapState(['overviewForm'])
  },

  methods: {
    enterArrangements($v) {
      $v.enter = () => {
        this.$store.commit('setVisibleSection', { name: 'arrangements', visible: true })
      }
    }
  }
}
</script>

<style scoped>
label > input {
  /* HIDE RADIO */
  opacity: 0; /* Makes input not-clickable */
  position: absolute; /* Remove input from document flow */
}

label > input + img {
  /* IMAGE STYLES */
  cursor: pointer;
  border: 6px solid #cc9b1b;
  transition: 0.4s;
}

label > input:checked + img {
  /* (RADIO CHECKED) IMAGE STYLES */
  border: 6px solid rgba(158, 158, 158, 0.5);
}

label {
  margin-bottom: 0;
}
</style>

<style>


</style>
