import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './pages/App'
import Home from './pages/Home'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/home',
            name: 'home',
            component: Home,
        }
    ]
})

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});