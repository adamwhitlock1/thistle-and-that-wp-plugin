import axios from 'axios'
export default {
  methods: {
    profileUpdateMixin(fieldToUpdate, member = 'none') {
      // if (fieldToUpdate !== 'all' && member == 'none' ) // console.log('INDIVIDUAL FIELD UPDATE')
      // we are JSON.stringifying the state stores overviewForm so that it becomes a private variable and non-reactive
      let jsonProfile = JSON.stringify(this.$store.state.overviewForm)
      // now parse it to use it as a plain json object
      let userProfile = JSON.parse(jsonProfile)
      // append some more data to the object
      userProfile.current_total = this.$store.state.overviewForm.current_total
      userProfile.billing_first_name = this.$store.state.overviewForm.first_name
      userProfile.billing_last_name = this.$store.state.overviewForm.last_name
      userProfile.selected_collection = this.$store.state.selectedConfig.initialCollection.collection

      // if we are updating all fields with the ajax call then append active selections to the object as well
      if (fieldToUpdate === 'all' || fieldToUpdate === 'clear') {
        userProfile['activeSelections'] = this.$store.state.activeSelections
      }

      if (fieldToUpdate === 'all_chunk') {
        console.log("ALL NEW CHUNK UPDATE")
        return true
      }

      // console.log(userProfile)

      let memberData = {}
      if (member !== 'none') {
        // console.log("member " + member + " is being updated")
        memberData = this.$store.state.activeSelections[member][0]
      }

      let ajaxRoute = this.$store.state.ajaxUrl
      // console.log(memberData)
      this.$http
        .post(
          ajaxRoute,
          { action: 'update_profile', field_to_update: fieldToUpdate, user_profile: userProfile, member, memberData },
          {
            headers: {
              'Content-Type': 'multipart/form-data'
            },
            emulateJSON: true
          }
        )
        .then(
          res => {
            // console.log(res.body)
          },
          res => {
            console.log('ERROR')
            console.log(res.status)
          }
        )
    }
  }
}
