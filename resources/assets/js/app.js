
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('login', require('./components/LoginComponent.vue'));
Vue.component('user', require('./components/UserComponent.vue'));
Vue.component('registry', require('./components/RegistryComponent.vue'));
Vue.component('product', require('./components/AdminProductComponent.vue'));

const app = new Vue({
    el: '#app'
});
