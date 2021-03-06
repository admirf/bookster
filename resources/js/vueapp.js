import Vue from 'vue'
import Vuex from 'vuex'
import VueRouter from 'vue-router'
import App from './pages/App'
import Login from './pages/Login'
import NotFound from './pages/NotFound'
import Register from './pages/Register'
import Transaction from './pages/Transaction'
import User from './pages/User'
import Search from './pages/Search'
import Book from './pages/Book'
import CreateBook from './pages/CreateBook'
import EditBook from './pages/EditBook'
import Account from './pages/Account'
import Admin from './pages/Admin'
import Cart from './pages/Cart'
import Results from './pages/Results'
import Report from './pages/Report'
import ElementUI from 'element-ui';
import store from './store/index'
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(ElementUI)
Vue.use(VueRouter)
Vue.use(Vuex)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'search',
            component: Search,
        },
        {
            path: '/user/:id',
            name: 'user',
            component: User
        },
        {
            path: '/account',
            name: 'account',
            component: Account
        },
        {
            path: '/admin',
            name: 'admin',
            component: Admin
        },
        {
            path: '/transaction/:id',
            name: 'transaction',
            component: Transaction
        },
        {
            path: '/cart',
            name: 'cart',
            component: Cart
        },
        {
            path: '/results',
            name: 'results',
            component: Results
        },
        {
            path: '/report/:id',
            name: 'report',
            component: Report
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/book/:id',
            name: 'book',
            component: Book,
        },
        {
            path: '/create-book',
            name: 'create-book',
            component: CreateBook,
        },
        {
            path: '/edit-book/:id',
            name: 'edit-book',
            component: EditBook,
        },
        {
            path: '/not-found',
            name: 'not-found',
            component: NotFound
        }
    ]
})

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});