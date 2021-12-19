/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


import Vue from 'vue'
import router from './router';
import Locations from './components/Locations';
import App from './components/App';
import Navbar from './components/Navbar';
import LocationDetails from './components/LocationDetails';
import Weather from './components/Weather';

require('./bootstrap');

window.Vue = require('vue').default;

import { library } from '@fortawesome/fontawesome-svg-core';
import { faUserSecret,faCloudSun,faArrowUp,faArrowDown } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import moment from 'moment';

library.add(faUserSecret,faCloudSun,faArrowUp,faArrowDown)

Vue.component('font-awesome-icon', FontAwesomeIcon)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('locations', require('./components/Locations.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 Vue.filter('formatUnixToDateTime', function(value,format='ddd, MM/DD/YYYY hh:mm A') {
    if (value) {
        return moment.unix(value).format(format)
    }
});
Vue.filter('formatToDateTime', function(value) {
    if (value) {
      return moment(String(value)).format('ddd, MM/DD/YYYY hh:mm A')
    }
});
Vue.filter('formatToDate', function(value) {
    if (value) {
      return moment(String(value)).format('YYYY-MM-DD')
    }
});
Vue.filter('formatToTime', function(value) {
    if (value) {
      return moment(String(value)).format('hh:mm A')
    }
});


const app = new Vue({
    el: '#app',
    components:{
        App,
        Locations,
        Navbar,
        LocationDetails,
        Weather,
    },
    router
});
