<template>
    <div class="aside">
        <div class="title">
            Filters
        </div>
        <hr>
        <el-row :gutter="20">
            <el-col :span="12" class="text-center">
                <label>Price Min</label>
                <el-input @change="submitForm" v-model="form.price_gte" suffix-icon="el-icon-minus" />
            </el-col>
            <el-col :span="12" class="text-center">
                <label>Price Max</label>
                <el-input @change="submitForm" v-model="form.price_lte" suffix-icon="el-icon-plus" />
            </el-col>
        </el-row>
        <br>
        <el-row :gutter="20">
            <el-col :span="12" class="text-center">
                <label>Pages Min</label>
                <el-input @change="submitForm" v-model="form.pages_gte" suffix-icon="el-icon-minus" />
            </el-col>
            <el-col :span="12" class="text-center">
                <label>Pages Max</label>
                <el-input @change="submitForm" v-model="form.pages_lte" suffix-icon="el-icon-plus" />
            </el-col>
        </el-row>
        <br>
        <el-row>
            <el-col class="text-center">
                <label>Select Category</label>
                <el-select @change="submitForm" v-model="form.category" placeholder="Category..." class="cat-select">
                    <el-option v-for="category in categories" :label="category.name" :key="category.id" :value="category.id">{{ category.name }}</el-option>
                </el-select>
            </el-col>
        </el-row>
        <br>
        <el-row>
            <el-col class="text-center">
                <label>Author</label>
                <el-input @change="submitForm" v-model="form.author" placeholder="Author" />
            </el-col>
        </el-row>
        <br>
        <el-row>
            <el-col class="text-center">
                <label>Language</label>
                <el-select @change="submitForm" v-model="form.language" class="cat-select" placeholder="Language">
                    <el-option v-for="language in languages" :value="language" :key="language">{{ language }}</el-option>
                </el-select>
            </el-col>
        </el-row>
        <br>
        <el-row>
            <el-col>
                <el-checkbox @change="submitForm" v-model="form.available">Available</el-checkbox>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    import axios from 'axios'
    import { mapGetters } from 'vuex'

    export default {
        name: "FilterTable",
        computed: {
            ...mapGetters({
                query: 'getQuery',
                filters: 'getFilters'
            }),
        },
        data () {
            return {
                categories: [],
                languages: [
                    'en', 'bs', 'sr'
                ],
                form: {
                    category: null,
                    language: null,
                    price_lte: '',
                    price_gte: '',
                    pages_lte: '',
                    pages_gte: '',
                    author: '',
                    available: true
                }
            }
        },
        created () {
            this.$store.commit('setFilters', '')
            this.loadCategories()
        },
        methods: {
            loadCategories () {
                axios.get('/api/categories').then(response => {
                    this.categories = response.data.data
                })
            },
            submitForm () {
                let filters = this.buildQuery()
                this.$store.commit('setFilters', filters)
            },
            buildQuery () {
                let query = ''
                for (let key in this.form) {
                    if (this.form[key] != null && this.form[key] !== '') {
                        query += `&${key}=${this.form[key]}`
                    }
                }

                return query
            }
        }
    }
</script>

<style scoped>
    .aside {
        border: 1px solid #C0C4CC;
        height: 480px;
        background-color: white;
        border-radius: 4px;
        padding: 20px;
    }

    .title {
        font-size: large;
        text-align: center;

    }

    .text-center {
        font-size: small;
        text-align: center;
    }

    .cat-select {
        width: 100%;
    }

    hr {
        background-color: #011e4f;
        color: #011e4f;
        border: none;
        height: 1px;
        margin-bottom: 20px;
        margin-top: 20px;
    }
</style>