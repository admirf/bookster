<template>
    <div :class="addStyle">
        <div class="items" v-loading="loading" :class="loading ? 'loader': ''">
            <div class="item" v-for="book in books">
                <BookCard :book="book"></BookCard>
            </div>
        </div>
        <div class="pagination" v-if="books.length">
            <el-pagination
                    class="pagination-item"
                    layout="prev, pager, next"
                    @current-change="handlePageChange"
                    :page-size="perPage"
                    :total="total">
            </el-pagination>
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
                loading: false,
                total: 0,
                perPage: 0,
                currPage: 1
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
                this.resetPage()
                this.search()
            },
            filters () {
                this.resetPage()
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
                    axios.get(`/api/search?q=${this.query}${this.filters}&page=${this.currPage}`).then((response) => {
                        self.books = response.data.data
                        self.perPage = response.data.meta.per_page
                        self.total = response.data.meta.total
                    }).catch(error => {
                        ErrorHandler.handle(error, self)
                    }).finally(() => {
                        self.loading = false
                    })
                }
            },
            handlePageChange (page) {
                this.currPage = page
                this.search()
            },
            resetPage () {
                this.currPage = 1
            }
        }
    }
</script>

<style scoped>
    .loader {
        margin-top: 50px;
    }

    .book-box {
        border: 1px solid #C0C4CC;
        background-color: white;
        margin-top: 20px;
        margin-bottom: 20px;
        padding: 18px;
    }

    .items {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-evenly;
    }

    .items .item {
        padding: 18px;
    }

    .pagination {
        display: flex;
        justify-content: center;
    }
</style>