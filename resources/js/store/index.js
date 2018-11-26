import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        query: ''
    },
    getters: {
        getQuery: state => {
            return state.query
        }
    },
    mutations: {
        setQuery (state, q) {
            state.query = q
        }
    }
})