
require('./bootstrap');

window.Vue = require('vue');

// bootsraps vue
import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)



import vSelect from 'vue-select'
Vue.component('v-select', vSelect)
import 'vue-select/dist/vue-select.css';

import Vue2Editor from "vue2-editor";
Vue.use(Vue2Editor);

import router from './router.js'
import App from './app.vue';
import store from './store'
const app = new Vue({
    el: '#app',
    router, store,
    components : {
        App
    }
});
