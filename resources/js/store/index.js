import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        query: '',
        filters: '',
        cart: [],
        authToken: null
    },
    getters: {
        getQuery: state => {
            return state.query
        },
        getFilters: state => {
            return state.filters
        },
        getAuthToken: state => {
            return state.authToken
        },
        getCart: state => {
            return state.cart
        }
    },
    mutations: {
        setQuery (state, q) {
            state.query = q
        },
        setFilters (state, f) {
            state.filters = f
        },
        setAuthToken (state, t) {
            state.authToken = t
        },
        setCart (state, o) {
            state.cart = o
        },
        addToCart (state, o) {
            state.cart.push(o)
            localStorage.setItem('cart', JSON.stringify(state.cart))
        },
        removeFromCart (state, index) {
            state.cart.splice(index, 1)
            localStorage.setItem('cart', JSON.stringify(state.cart))
        },
        emptyCart (state) {
            state.cart = []
        }
    },
    actions: {
        addToCart ({commit, state}, book) {
            if (! state.cart.some(element => {
                return element.id === book.id
            })) {
                commit('addToCart', book)
            }
        }
    }
})