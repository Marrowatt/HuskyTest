require('./bootstrap');

window.Vue = require('vue').default;
window.axios = require('axios');

import JwPagination from 'jw-vue-pagination';
import Vue from 'vue';
Vue.component('jw-pagination', JwPagination);

import Multiselect from 'vue-multiselect';
Vue.component('multiselect', Multiselect);

import Delivery from './components/deliveries/Delivery.vue';
Vue.component('createdelivery', require('./components/deliveries/CreateDelivery.vue').default);
Vue.component('editdelivery', require('./components/deliveries/EditDelivery.vue').default);
Vue.component('editstatus', require('./components/deliveries/EditStatus.vue').default);
Vue.component('editdeliver', require('./components/deliveries/EditDeliver.vue').default);

const app = new Vue({
    el: '#app',
    components: {
        Delivery,
    }
});
