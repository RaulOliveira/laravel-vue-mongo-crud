
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
window.Vue.use(VueRouter);

import Vuetify from 'vuetify'
Vue.use(Vuetify)

import SodasIndex from './components/sodas/SodasIndex.vue';
import SodasCreate from './components/sodas/SodasCreate.vue';
import SodasEdit from './components/sodas/SodasEdit.vue';

const routes = [
    {path: '/', components: { sodasIndex: SodasIndex } },
    {path: '/sodas/create', component: SodasCreate, name: 'createSoda'},
    {path: '/sodas/edit/:id', component: SodasEdit, name: 'editSoda'},
]

const router = new VueRouter({ routes })
const app = new Vue({ router }).$mount('#app')
