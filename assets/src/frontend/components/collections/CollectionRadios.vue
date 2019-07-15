<template>
  <div>
    <div id="collections" />

    <div class="container-fluid p-3">
      <div
        class="row"
        data-aos="fade-in"
        data-aos-duration="1000"
        data-aos-delay="200"
      >
        <div
          v-inview:on="enterCollections"
          class="col-md-12"
        >
          <h4>
            <strong class="h2">
              Step 2:
            </strong>
            <span class="italic">
              Choose a pre-designed collection
            </span>
            <span
              id="initial-collection-and-level"
              class="d-none"
            >
              {{ selected_collection }}
            </span>
          </h4>
          <hr />
        </div>
      </div>

      <form>
        <fieldset>
          <div class="collection-wrap row">
            <div
              v-for="(cat, index) in collection_cats"
              :key="index"
              class="collection col-md-4"
              :value="index"
            >
              <collection
                :collection-name="cat.name"
                :collection-slug="cat.slug"
                :collection-id="cat.cat_ID"
                :collection-img="cat.attachment_image"
                :collection-index="index"
              />
            </div>
          </div>
        </fieldset>
      </form>
      <div v-if="selected_collection !== ''">
        <prev-next-buttons
          prev="/"
          next="/wedding_details"
        />
      </div>
      <div v-else>
        <p class="lead text-right mt-4">
          Please select a collection to move to the next step.
        </p>
      </div>
    </div>
    <!--end container-fluid shadow-->
  </div>
</template>

<script>
import { mapFields } from 'vuex-map-fields'
import { mapState } from 'vuex'
import Collection from './Collection'

export default {
  name: 'CollectionRadio',

  components: {
    Collection
  },

  data() {
    return {
      // eslint-disable-next-line no-undef
      collection_cats
    }
  },

  computed: {
    ...mapFields(['overviewForm.selected_collection']),
    ...mapState(['overviewForm.selected_collection'])
  },

  methods: {
    enterCollections($v) {
      $v.enter = () => {
        this.$parent.$options.methods.setVisSec({
          name: 'collections',
          visible: true
        })
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


