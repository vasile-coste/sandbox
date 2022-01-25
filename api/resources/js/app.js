require('./bootstrap');

import Notifications from 'vue-notification';

window.Vue = require('vue').default;

// register plugins
Vue.use(Notifications);


// Components
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('login', require('./components/Login.vue').default);
Vue.component('nav-menu', require('./components/NavMenu.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});