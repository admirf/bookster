<template>
    <div class="book-form">
        <h3>Post a Book Listing</h3>
        <el-input v-model="form.title" placeholder="Title..." :clearable="true"></el-input>
        <div class="vertical-spacer"></div>
        <el-input v-model="form.author" placeholder="Author..." :clearable="true"></el-input>
        <div class="vertical-spacer"></div>
        <el-input v-model="form.isbn" placeholder="ISBN (Optional)" :clearable="true"></el-input>
        <div class="vertical-spacer"></div>
        <el-input v-model="form.edition" placeholder="Edition (Optional)" :clearable="true"></el-input>
        <div class="vertical-spacer"></div>

        <div class="flex-container">
            <el-select v-model="form.category_id" placeholder="Category...">
                <el-option v-for="category in categories" :key="category.id" :value="category.id" :label="category.name"></el-option>
            </el-select>
            <div class="horizontal-spacer"></div>
            <el-select class="lang" v-model="form.language" placeholder="Language...">
                <el-option v-for="(language, index) in languages" :key="index" :value="language" :label="language"></el-option>
            </el-select>
        </div>
        <div class="vertical-spacer"></div>

        <div class="flex-container">
            <el-input-number v-model="form.price" placeholder="Price..."></el-input-number>
            <div class="horizontal-spacer"></div>
            <el-button class="my-btn" type="primary" @click="submit">Submit</el-button>
        </div>
        <hr>
        <div class="vertical-spacer"></div>
        <label>Add an Image</label>
        <div class="vertical-spacer"></div>
        <div class="flex-container">
            <input ref="file" v-on:change="handleFile"" class="file-input" type="file" />
            <div class="horizontal-spacer"></div>
            <el-button type="primary">Upload</el-button>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import ErrorHandler from '../util/errorHandler'
    import { mapGetters } from 'vuex'

    export default {
        name: "BookForm",
        props: {
            mode: {
                required: true
            },
            book: {
                required: false
            }
        },
        computed: {
            ...mapGetters({
                authToken: 'getAuthToken'
            })
        },
        data () {
            return {
                form: {},
                categories: [],
                languages: [
                    'bs', 'hr', 'sr', 'en'
                ],
                image: null
            }
        },
        created () {
            if (this.mode === 'edit' && this.book) {
                this.form = Object.assign({}, this.book)
            }

            this.loadCategories()
        },
        methods: {
            handleFile() {

            },
            submit () {
                if (this.mode === 'create') {
                    this.store()
                } else if (this.mode === 'edit') {
                    this.edit()
                }
            },
            store () {
                axios.post('/api/books', this.form, {
                    headers: {
                        Authorization: `Bearer ${this.authToken}`
                    }
                }).then(response => {
                    this.form = {}
                    this.form.id = response.data.data.id
                    this.$notify.success(`Book created with ID: ${response.data.data.id}`)
                }).catch(error => {
                    ErrorHandler.handle(error, this)
                })
            },
            edit () {
                axios.put(`/api/books/${this.book.id}`, this.form, {
                    headers: {
                        Authorization: `Bearer ${this.authToken}`
                    }
                }).then(response => {
                    this.$notify.success(`Book updated with ID: ${response.data.data.id}`)
                }).catch(error => {
                    ErrorHandler.handle(error, this)
                })
            },
            loadCategories () {
                axios.get('/api/categories').then(response => {
                    this.categories = response.data.data
                });
            }
        }
    }
</script>

<style scoped>
    .file-input {
        width: 100%;
        line-height: 35px;
    }

    .my-btn {
        width: 250px;
    }

    .book-form {
        width: 400px;
        background-color: white;
        padding: 10px;
        text-align: center;
    }

    .flex-container {
        display: flex;
        flex-wrap: nowrap;
        flex-direction: row;
    }

    .horizontal-spacer {
        width: 10px;
    }

    .vertical-spacer {
        height: 10px;
    }

    @media screen and (max-width: 500px) {
        .book-form {
            width: 100%;
        }

        .flex-container {
            flex-direction: column;
        }

        .my-btn {
            width: 100%;
        }

        .horizontal-spacer {
            height: 10px;
            width: 0;
        }
    }
</style>