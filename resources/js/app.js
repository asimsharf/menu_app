import './bootstrap';

import { createApp } from 'vue';

import * as VueRouter from 'vue-router'

// import Vuex from 'vuex'
import store from './store';

import Admin from './components/admin.vue';
import About from './components/about/about.vue';
import Login from './components/auth/login.vue';
import Register from './components/auth/register.vue';
import Category from './components/category/category.vue';
import Product from './components/product/product.vue';
import CategoryProduct from './components/product/category_product.vue'

const routes = [
    { path: '/admin', component: Admin },
    { path: '/about', component: About },
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    { path: '/category', component: Category },
    { path: '/product', component: Product },
    { path: '/category_product', name: 'category_product', component: CategoryProduct }

];

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes,
});


//Sweet alert start
import Swal from 'sweetalert2'
window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
});

window.Toast = Toast;


const app = createApp({});

app.use(router);


// import state from './store/state'
// import * as getters from './store/getters'
// import * as mutations from './store/mutations'
// import * as actions from './store/actions'

// const store = new Vuex.Store({
//     state,
//     getters,
//     mutations,
//     actions
// });

// app.use(Vuex);

app.use(store);

app.component('admin', Admin);

app.mount('#app');
