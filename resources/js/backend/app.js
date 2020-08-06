import '@coreui/coreui'

import '../plugins';
import Vue from 'vue';

window.Vue = Vue;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));


 
Vue.component('fullcalendar-component', require('./components/otCalendar.vue').default);

Vue.component('example-component2', require('./components/ExampleComponent2.vue').default);

Vue.component('grafica-component', require('./components/graficos.vue').default);

Vue.component('graficaingresos-component', require('./components/graficosIngresos.vue').default);

Vue.component('graficastatusots-component', require('./components/graficosStatusOt.vue').default);

Vue.component('ganttots-component', require('./components/ganttOtComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    
});
