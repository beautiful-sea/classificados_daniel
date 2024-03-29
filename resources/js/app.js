/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//Import axios
import axios from 'axios';
import toastr from 'toastr';
import Calendar from 'v-calendar/lib/components/calendar.umd'
import DatePicker from 'v-calendar/lib/components/date-picker.umd'

window.axios = axios;
window.toastr = toastr;
window.swal = require('sweetalert2');
window.Vue = require('vue').default;

//Obtenha o valor do token CSRF da meta tag
const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

// Configure o token CSRF como cabeçalho de solicitação global para o Axios
axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('v-calendar', Calendar)
Vue.component('v-date-picker', DatePicker)

Vue.component('loader', require('./components/helpers/Loader.vue').default);
Vue.component('admin-usuarios', require('./components/admin/Usuarios.vue').default);
Vue.component('admin-avaliacoes-list', require('./components/admin/avaliacoes/AvaliacoesList.vue').default);
Vue.component('admin-campos-avaliacoes', require('./components/admin/avaliacoes/CamposAvaliacao.vue').default);
Vue.component('admin-categorias', require('./components/admin/Categorias.vue').default);
Vue.component('anunciante-editar-perfil', require('./components/anunciante/EditarPerfil.vue').default);
Vue.component('categorias-page', require('./components/Categorias.vue').default);
Vue.component('anunciante-page', require('./components/Anunciante.vue').default);
Vue.component('anunciante-avaliacoes', require('./components/anunciante/avaliacoes/AvaliacoesList.vue').default);
Vue.component('form-avaliacao', require('./components/FormAvaliacao.vue').default);
Vue.component('admin-usuarios-avaliacoes', require('./components/admin/usuarios/Avaliacoes.vue').default);

Vue.component('tabs-anunciantes', require('./components/TabsAnunciantes.vue').default);
Vue.component('anunciante-agenda', require('./components/anunciante/agenda/Agenda.vue').default);
Vue.component('agendar', require('./components/Agendar.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
