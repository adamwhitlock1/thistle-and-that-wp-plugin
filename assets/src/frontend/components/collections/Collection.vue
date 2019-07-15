<template>
  <div
    data-aos="fade-in"
    :data-aos-delay="(collectionIndex + 1) * 150"
    data-aos-duration="1000"
  >
    <div class="row mt-4">
      <div class="col-md-12 d-flex align-items-center text-center">
        <h5
          class="w-100 pt-2"
          @click="
            setSelected({
              collection: collectionSlug,
              level: 'recommended',
              level_index: 1
            })
          "
          v-html="collectionName"
        />
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 d-flex align-items-center text-center justify-content-center">
        <img
          :src="collectionImg"
          class="img-fluid collection-image"
          alt
          :class="{ selected_collection: selected }"
          @click="
            setSelected({
              collection: collectionSlug,
              level: 'recommended',
              level_index: 1
            })
          "
        />
        <span
          :class="{ selected_collection: selected }"
          class="select-text"
        >
          selected
        </span>
      </div>
    </div>
  </div>
</template>

<script>
import { mapFields } from 'vuex-map-fields'
export default {
  name: 'Collection',
  computed: {
    ...mapFields(['overviewForm.selected_collection']),
    selected() {
      // checks to see if the currect selected collection is equal to the collection passed in as props
      return this.$store.state.activeSelections.bridal[0].collection ==
        this.collectionSlug
        ? true
        : false
    }
  },
  props: {
    collectionName: {
      type: String,
      default: 'Collection'
    },
    collectionSlug: {
      type: String,
      default: 'collection'
    },
    collectionId: {
      type: [String, Number],
      default: 0
    },
    collectionImg: {
      type: String,
      default: '#'
    },
    collectionIndex: {
      type: Number,
      default: 0
    },
    collectionVariants: {
      type: Array,
      default: function() {
        return [
          {
            variantName: 'modest'
          },
          {
            variantName: 'recommended'
          },
          {
            variantName: 'lux'
          }
        ]
      }
    }
  },

  methods: {
    setSelected(initialSel) {
      // console.log(initialSel)
      let obj = {
        member: 'bridal',
        collection: initialSel.collection,
        level: initialSel.level,
        level_index: initialSel.level_index
      }


      this.$store.dispatch('setInitialCollectionAction', obj, {
          root: true
        }).then(() => {
          this.profileUpdateMixin('all')
        })

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

.select-text {
  opacity: 0;
  position: absolute;
  text-align: center;
  transition: .5s;
  top: 0px;
  background-color: #D8CFE8;
  color: #4e4e4e;
  border-radius: 50px;
  padding: 5px 15px;
  margin: 0 auto;
  box-shadow: 0 3px 6px rgba(255, 255, 255, 0.2), 0 3px 6px rgba(255, 255, 255, 0.3);
}

span.selected_collection {
  opacity: 1;
  transform: translateY(15px);
}

img {
  /* IMAGE STYLES */
  cursor: pointer;
  transition: 0.4s;
  box-shadow: 0 3px 6px rgba(0, 0, 0, .03), 0 3px 6px rgba(0, 0, 0, .05);
  border: 3px solid rgba(0, 0, 0, 0);
}

img:hover {
  transform: translateY(-3px);
}

img:hover + span.selected_collection {
  transform: translateY(11px);
}

img.selected_collection {
  border: 3px solid #fff;
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}

label {
  margin-bottom: 0;
}
.slick-slide img {
  display: block;
  margin: auto;
}
</style>
