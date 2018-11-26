import Vue from 'vue'
import Vuex from 'vuex'
import VueRouter from 'vue-router'
import App from './pages/App'
import Search from './pages/Search'
import Basket from './pages/Basket'
import Results from './pages/Results'
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
            path: '/basket',
            name: 'basket',
            component: Basket
        },
        {
            path: '/results',
            name: 'results',
            component: Results
        }
    ]
})

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});