import Vue from "vue"
import Router from "vue-router"
import Welcome from '../components/Welcome.vue'
import WeddingDetails from '../components/WeddingDetails.vue'
import CollectionRadios from '../components/collections/CollectionRadios.vue'
import Bride from '../components/wedding_party/Bride.vue'
import Groom from '../components/wedding_party/Groom.vue'
import Bridesmaids from '../components/wedding_party/Bridesmaids.vue'
import Mothers from '../components/wedding_party/Mothers.vue'
import FlowerGirl from '../components/wedding_party/FlowerGirl.vue'
import CandlesLinensChairs from '../components/extras/CandlesLinesChairs.vue'
import Centerpieces from '../components/extras/Centerpieces.vue'
import Arrangements from '../components/extras/Arrangements.vue'
import WeddingParty from '../components/wedding_party/WeddingParty.vue'
import Overview from '../components/Overview.vue'
import Summary from '../components/Summary.vue'

Vue.use(Router)

export default new Router({
  routes: [
    {path: '/', component: Welcome},
    {path: '/collections', component: CollectionRadios},
    {path: '/wedding_details', component: WeddingDetails},
    {path: '/bride_groom', component: Bride},
    {path: '/groom', component: Groom},
    {path: '/wedding_party', component: WeddingParty},
    {path: '/bridesmaids', component: Bridesmaids},
    {path: '/mothers', component: Mothers},
    {path: '/flowergirl', component: FlowerGirl},
    {path: '/candles', component: CandlesLinensChairs},
    {path: '/centerpieces', component: Centerpieces},
    {path: '/arrangements', component: Arrangements},
    {path: '/overview', component: Overview},
    {path: '/summary', component: Summary},
  ]
})
