/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.select2 = require('select2');


import { 
    ModalPlugin,
    TablePlugin,
    FormSelectPlugin,
    FormTextareaPlugin,
    LayoutPlugin,
    CardPlugin,
    CollapsePlugin,
    AlertPlugin,
    TabsPlugin,
    ToastPlugin,
    FormGroupPlugin,
    PaginationPlugin 
} from 'bootstrap-vue'

import Vuelidate from 'vuelidate';
require('particles.js');


Vue.use(FormGroupPlugin )
Vue.use(PaginationPlugin   )
Vue.use(Vuelidate)
Vue.use(ModalPlugin )
Vue.use(FormSelectPlugin)
Vue.use(FormTextareaPlugin)
Vue.use(LayoutPlugin)
Vue.use(CardPlugin)
Vue.use(AlertPlugin)
Vue.use(CollapsePlugin)
Vue.use(TablePlugin )
Vue.use(TabsPlugin )
Vue.use(ToastPlugin )
require("@fortawesome/fontawesome-free/js/brands.js");
require("@fortawesome/fontawesome-free/js/solid.js");
require("@fortawesome/fontawesome-free/js/fontawesome.min.js");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('v-select', vSelect)

Vue.component('pagination', require('laravel-vue-pagination'));

Vue.component('role-component', require('./components/admin/Role.vue').default);

Vue.component('employe-component', require('./components/Employe.vue').default);
Vue.component('distrub-component', require('./components/Distrub.vue').default);
Vue.component('directory-component', require('./components/directory.vue').default);

Vue.component('journal-component', require('./components/Journal.vue').default);
Vue.component('dvr-component', require('./components/Dvrstatus.vue').default);

Vue.component('linechart-component', require('./components/LineChart.vue').default);
Vue.component('barchart-component', require('./components/BarChart.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



// Vue.filter('truncate', function (text, stop, clamp) {
//     return text.slice(0, stop) + (stop < text.length ? clamp || '...' : '')
// })

const app = new Vue({
    el: '#app',
});


$('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var recipient = button.data('value')

    var modal = $(this)
    // modal.find('.modal-title').text('New message to ' + recipient)
    modal.find('.modal-body #deleteUserId').val(recipient)
})
$('#passModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var recipient = button.data('pass')

    var modal = $(this)
    // modal.find('.modal-title').text('New message to ' + recipient)
    modal.find('.modal-body #UserPassId').val(recipient)
})

$('#imageView').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var recipient = button.attr('src')

    var modal = $(this)
    // modal.find('.modal-title').text('New message to ' + recipient)
    modal.find('.modal-body .modalViewImage').attr('src', recipient)
})
// $(document).ready(function() {
//     $('#operator').select2({
//         placeholder: 'Выберите оператора',
//         selectionCssClass: ' bg-gray-400 outline-none',
//         language: "ru"
//     });
// });