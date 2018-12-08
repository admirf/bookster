<template>
    <div :class="addStyle">
        <div class="items" v-loading.fullscreen.lock="loading">
            <div class="item" v-for="book in books">
                <BookCard :book="book"></BookCard>
            </div>
        </div>
    </div>
</template>

<script>
    import BookCard from './BookCard'
    import ErrorHandler from '../util/errorHandler'
    import { mapGetters } from 'vuex'
    import axios from 'axios'

    export default {
        name: "BookList",
        components: {
            BookCard
        },
        data() {
            return {
                books: [],
                loading: false
            }
        },
        computed: {
            ...mapGetters({
                query: 'getQuery',
                filters: 'getFilters'
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
            },
            filters () {
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
                    console.log(`/api/search?q=${this.query}${this.filters}`)
                    axios.get(`/api/search?q=${this.query}${this.filters}`).then((response) => {
                        self.books = response.data.data
                        self.loading = false
                    }).catch(error => {
                        ErrorHandler.handle(error, self)
                        self.loading = false
                    })
                }
            },

        }
    }
</script>

<style scoped>
    .book-box {
        border: 1px solid #C0C4CC;
        background-color: white;
        margin-top: 20px;
        margin-bottom: 20px;
        display: flex;
    }

    .items {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .items .item {
        padding: 18px;
    }
</style>