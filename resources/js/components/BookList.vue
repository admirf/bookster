<template>
    <div :class="addStyle">
        <ul v-loading.fullscreen.lock="loading">
            <li v-for="book in books">
                {{ book }}
            </li>
        </ul>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import axios from 'axios'

    export default {
        name: "BookList",
        data() {
            return {
                books: [],
                loading: false
            }
        },
        computed: {
            ...mapGetters({
                query: 'getQuery',
            }),
            addStyle () {
                if (this.books.length > 0) {
                    return 'book-box'
                }
            }
        },
        watch: {
            query () {
                this.search()
            }
        },
        created () {
            this.search()
        },
        methods: {
            search () {
                if (this.query.length > 0) {
                    this.loading = true
                    let self = this
                    axios.get(`/api/search?q=${this.query}`).then((response) => {
                        self.books = response.data.data
                        self.loading = false
                    })
                }
            },

        }
    }
</script>

<style scoped>
    .book-box {
        background-color: white;
        padding: 20px;
        margin-top: 20px;
        margin-bottom: 20px;
        display: flex;
    }
</style>