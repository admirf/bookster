<template>
    <div class="search-container">
        <div class="search-box" @keyup.enter="search">
            <h2 class="search-text">Search for Books</h2>
            <p>
                Bookster is a clever sell and buy platform for books.
            </p>
            <el-input v-model="query" class="search-input" placeholder="Harry Potter..." clearable />
            <el-button type="primary" class="search-btn" @click="search">Search</el-button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Home",
        data () {
            return {
                query: ''
            }
        },
        methods: {
            search() {
                if (this.query.length === 0) {
                    this.query = '*'
                }

                this.$store.commit('setQuery', this.query)
                this.$router.push('results')
            }
        }
    }
</script>

<style scoped>
    .search-container {
        display: flex;
        justify-content: center;
    }

    .search-text {
        text-align: center;
    }

    .search-box {
        padding: 20px 20px 20px 20px;
        background-color: white;
        width: 500px;
    }

    .search-btn {
        width: 350px;
        display: block;
        margin: 0 auto 20px auto;
    }

    .search-input {
        width: 350px;
        display: block;
        margin: 20px auto 20px auto;
    }

    p {
        text-align: center;
    }

    @media screen and (max-width: 600px) {
        .search-box {
            width: 100%;
        }

        .search-input {
            width: 100%;
        }

        .search-btn {
            width: 100%;
        }
    }
</style>