<template>
  <div class="section-design-your-wedding">
    <div
      v-if="$store.state.activeSelections"
      id="centerpieces"
    />

    <div class="container-fluid p-4">
      <div
        class="row"
        data-aos="fade-in"
        data-aos-duration="850"
        data-aos-delay="100"
      >
        <div
          v-inview:on="enterCenterpieces"
          class="col-md-12"
        >
          <h4>
            <strong class="h2">
              Step 6b:
            </strong>
            <span class="italic">
              Choose Your Centerpieces
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
        <div
          v-if="$store.state.productInfo.glassbowl_centerpieceInfo"
          class="row"
        >
          <centerpiece
            :info="$store.state.productInfo.glassbowl_centerpieceInfo[0]"
            centerpiece-name="glassbowl_centerpiece"
          />
        </div>
        <div
          v-if="$store.state.productInfo.multivase_centerpieceInfo"
          class="row"
        >
          <centerpiece
            :info="$store.state.productInfo.multivase_centerpieceInfo[0]"
            centerpiece-name="multivase_centerpiece"
          />
        </div>
        <div
          v-if="$store.state.productInfo.wood_centerpieceInfo"
          class="row"
        >
          <centerpiece
            :info="$store.state.productInfo.wood_centerpieceInfo[0]"
            centerpiece-name="wood_centerpiece"
          />
        </div>
        <div
          v-if="$store.state.productInfo.urn_centerpieceInfo"
          class="row"
        >
          <centerpiece
            :info="$store.state.productInfo.urn_centerpieceInfo[0]"
            centerpiece-name="urn_centerpiece"
          />
        </div>
        <div
          v-if="$store.state.productInfo.urn_centerpieceInfo"
          class="row"
        >
          <centerpiece
            :info="$store.state.productInfo.metalstandfoam_arrangementInfo[0]"
            centerpiece-name="metalstandfoam_arrangement"
          />
        </div>
        <div
          v-if="$store.state.productInfo.urn_centerpieceInfo"
          class="row"
        >
          <centerpiece
            :info="$store.state.productInfo.tallglassfoam_arrangementInfo[0]"
            centerpiece-name="tallglassfoam_arrangement"
          />
        </div>
      </div>

      <prev-next-buttons
        prev="/candles"
        next="/arrangements"
      />
    </div>
    <!--end container-fluid shadow-->
  </div>
</template>

<script>
import Centerpiece from './Centerpiece'
import { mapState } from 'vuex'

export default {
  name: 'Centerpieces',
  components: {
    Centerpiece
  },

  computed: {
    ...mapState(['overviewForm'])
  },

  methods: {
    enterCenterpieces($v) {
      $v.enter = () => {
        this.$store.commit('setVisibleSection', { name: 'centerpieces', visible: true })
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
