<template>
    <div class="categories">
        <div style="text-align: center">
            <h3>Categories</h3>
        </div>

        <div class="category-form">
            <el-input v-model="categoryName" placeholder="Category name..." clearable />
            <div class="horizontal-spacer"></div>
            <el-button type="primary" @click="createCategory">Create Category</el-button>
        </div>

        <div class="category align-vertical" v-for="(category, index) in categories" :key="category.id" :class="color(index)">
            <div><strong>ID:</strong> <em>{{ category.id }}</em></div>
            <div>Name: {{ category.name }}</div>
            <div>
                <el-button type="danger" @click="deleteCategory(category.id, index)">Delete</el-button>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import ErrorHandler from '../util/errorHandler'
    import { mapGetters } from 'vuex'

    export default {
        name: "AdminCategories",
        data () {
            return {
                categories: [],
                categoryName: ''
            }
        },
        computed: {
            ...mapGetters({
                authToken: 'getAuthToken'
            })
        },
        created () {
            axios.get('/api/categories').then(response => {
                this.categories = response.data.data
            }).catch(error => {
                ErrorHandler.handle(error, this)
            })
        },
        methods: {
            createCategory () {
                if (this.categoryName.length) {
                    axios.post('/api/categories', {
                        name: this.categoryName
                    },
                        {
                        headers: {
                            Authorization: `Bearer ${this.authToken}`
                        }
                    }).then(response => {
                        this.categories.push(response.data.data)
                        this.$notify.success(`Successfully created Category ID: ${response.data.data.id}`)
                    }).catch(error => {
                        ErrorHandler.handle(error, this)
                    })
                }
            },
            deleteCategory (id, index) {
                axios.delete(`/api/categories/${id}`, {
                    headers: {
                        Authorization: `Bearer ${this.authToken}`
                    }
                }).then(response => {
                    this.categories.splice(index, 1)
                    this.$notify.success('Category removed.')
                }).catch(error => {
                    ErrorHandler.handle(error, this)
                })
            },
            color (index) {
                return index % 2 === 1 ? 'background': ''
            }
        }
    }
</script>

<style scoped>
    .horizontal-spacer {
        width: 10px;
    }

    .category-form {
        display: flex;
        flex-direction: row;
        margin-bottom: 20px;
        padding: 10px;
    }

    .align-vertical {
        line-height: 40px;
    }

    .category {
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-evenly;
        padding-bottom: 9px;
        padding-top: 9px;
        border-top: #011e4f 1px solid;
    }

    .background {
        background-color: whitesmoke;
    }

    .categories {
        width: 600px;
        background-color: white;
        padding: 18px;
    }

    @media screen and (max-width: 700px) {
        .users {
            width: 100%;
        }
    }
</style>