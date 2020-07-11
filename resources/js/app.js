/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import vSelect from 'vue-select';

Vue.component('v-select', vSelect);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('category', require('./components/category/CategoryComponent.vue').default);
Vue.component('new-purchase', require('./components/purchase/NewPurchase.vue').default);
Vue.component('edit-purchase', require('./components/purchase/EditPurchase.vue').default);
Vue.component('new-sell', require('./components/sell/NewSell.vue').default);
Vue.component('edit-sell', require('./components/sell/EditSell.vue').default);
Vue.component('new-requisition', require('./components/requisition/NewRequision.vue').default);
Vue.component('edit-requisition', require('./components/requisition/EditRequisition.vue').default);
Vue.component('show-requisition', require('./components/requisition/ShowRequisition.vue').default);
Vue.component('department', require('./components/department/DepartmentComponent.vue').default);
Vue.component('designation', require('./components/designation/DesignationComponent.vue').default);
Vue.component('expense-category', require('./components/expense-category/ExpenseCategoryComponent.vue').default);
Vue.component('tax', require('./components/tax/Tax.vue').default);
Vue.component('role', require('./components/role/Role.vue').default);
Vue.component('todo', require('./components/todo/TodoComponent.vue').default);
Vue.component('todo-st2', require('./components/todo/TodoComponent2.vue').default);
Vue.component('todo-st3', require('./components/todo/TodoComponent3.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
