<template>
    <div class="books">
        <div style="text-align: center">
            <h3>Your Books</h3>
        </div>
        <div class="book align-vertical" v-for="(book, index) in books" :key="book.id" :class="color(index)">
            <div class="book-left">
                <div><strong>ID:</strong> <em>{{ book.id }}</em></div>
                <div>Price: {{ book.price }}</div>
                <div>Title: {{ book.title }}</div>
            </div>
            <div class="book-right">
                <el-button type="primary" @click="goToBook(book.id)"><i class="el-icon-view"></i></el-button>
                <el-button type="success" @click="goToEditBook(book.id)">Edit</el-button>
                <el-button type="danger" @click="deleteBook(book.id, index)">Delete</el-button>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import ErrorHandler from '../util/errorHandler'
    import { mapGetters } from 'vuex'

    export default {
        name: "MyBooks",
        data () {
            return {
                books: []
            }
        },
        computed: {
            ...mapGetters({
                authToken: 'getAuthToken'
            })
        },
        created () {
            axios.get('/api/me/books', {
                headers: {
                    Authorization: `Bearer ${this.authToken}`
                }
            }).then(response => {
                this.books = response.data.data
            }).catch(error => {
                ErrorHandler.handle(error, this)
            })
        },
        methods: {
            deleteBook (id, index) {
                axios.delete(`/api/books/${id}`, {
                    headers: {
                        Authorization: `Bearer ${this.authToken}`
                    }
                }).then(response => {
                    this.books.splice(index, 1)
                    this.$notify.success('Successfully deleted book.')
                }).catch(error => {
                    ErrorHandler.handle(error, this)
                })
            },
            goToBook (id) {
                this.$router.push({
                    name: 'book',
                    params: {
                        id: id
                    }
                })
            },
            goToEditBook (id) {
                this.$router.push({
                    name: 'edit-book',
                    params: {
                        id: id
                    }
                })
            },
            color (index) {
                return index % 2 === 1 ? 'background': ''
            }
        }
    }
</script>

<style scoped>
    .align-vertical {
        line-height: 40px;
    }

    .book {
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-between;
        padding-bottom: 9px;
        padding-top: 9px;
        border-top: #011e4f 1px solid;
    }

    .book-left {
        width: 100%;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: space-evenly;
    }

    .book-right {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: flex-end;
        padding-right: 9px;
    }

    .background {
        background-color: whitesmoke;
    }

    .books {
        width: 600px;
        background-color: white;
        padding: 18px;
    }

    @media screen and (max-width: 700px) {
        .books {
            width: 100%;
        }
    }
</style>