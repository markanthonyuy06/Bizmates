import Vue from 'vue';
import VueRouter from 'vue-router';
import LocationDetails from './components/LocationDetails';
import Locations from './components/Locations';
import Weather from './components/Weather';
Vue.use(VueRouter)
export default new VueRouter({
    routes:[
        {
            path:'/locations',
            // component:{Locations,LocationDetails}
        },
        { path: '/locations/:loc_id', component: Weather }
    ],
    mode:'history'
});