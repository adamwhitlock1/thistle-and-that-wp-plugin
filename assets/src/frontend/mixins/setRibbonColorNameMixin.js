
export default {
  methods: {
    setRibbonColorNameMixin(value, member = 'all') {
      // if (member !== 'all' ) console.log('INDIVIDUAL MEMBER RIBBON COLOR UPDATE')
      this.$store.dispatch('activeSelections/setRibbonColorName', { member, value }, { root: true }).then(()=>{
        // console.log("Ribbon Color Set To: " + this.$store.state.activeSelections['bridal'][0]['ribbon_color_name'])
        this.profileUpdateMixin('multi', member)
      })

    }
  }
}
