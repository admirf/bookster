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

    .items {
        display: flex;
        flex-wrap: wrap;
    }

    .items .item {
        padding: 10px;
    }
</style>