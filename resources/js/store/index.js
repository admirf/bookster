import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        query: '',
        authToken: null
    },
    getters: {
        getQuery: state => {
            return state.query
        },
        getAuthToken: state => {
            return state.authToken
        }
    },
    mutations: {
        setQuery (state, q) {
            state.query = q
        },
        setAuthToken (state, t) {
            state.authToken = t
        }
    }
})