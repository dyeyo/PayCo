/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');

// window.Vue = require('vue');
import Vue from 'vue';



// VUETIFY
import '@mdi/font/css/materialdesignicons.css';
import Vuetify from 'vuetify';
Vue.use(Vuetify);

import LoginComponent from './components/Login.vue';

// IMPORTAR COMPONENTES  VUETIFY
import NavbarComponent from './components/Navbar.vue';

import ToolbarComponent from './components/Dashboard.vue';

// FIN IMPORTAR COMPONENTES  VUETIFY

//alerts
import swal from 'sweetalert';



Vue.component('login-component', LoginComponent);

// DEFINIR COMPONENTES  VUETIFY
Vue.component('nav-bar', NavbarComponent);
// Vue.component('button-component', ButtonComponent);
Vue.component('toolbar-component', ToolbarComponent);
// FIN DEFINIR COMPONENTES  VUETIFY

import router from './routes';


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    el: '#app',
    router,
    vuetify: new Vuetify({icons: {
        iconfont: 'mdiSvg' || 'mdi' // 'mdi' || 'mdiSvg' || 'md' || 'fa' || 'fa4'
      },}),
});
