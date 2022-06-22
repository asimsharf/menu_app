import './bootstrap';

import { createApp } from 'vue';

import * as VueRouter from 'vue-router'


import Home from './components/home.vue';
import About from './components/about/about.vue';
import Login from './components/auth/login.vue';
import Register from './components/auth/register.vue';
import Category from './components/category/category.vue';
import Product from './components/product/product.vue';
import CategoryProduct from './components/product/category_product.vue'

const routes = [
    { path: '/', component: Home },
    { path: '/about', component: About },
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    { path: '/category', component: Category },
    { path: '/product', component: Product },
    { path: '/category_product', name: 'category_product', component: CategoryProduct}

];

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes,
});

const app = createApp({});

app.use(router)

app.component('home', Home);

app.mount('#app');
