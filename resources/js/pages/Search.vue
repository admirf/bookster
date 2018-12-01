<template>
    <div class="search-box" @keyup.enter="search">
        <h2 class="search-text">Search for Books</h2>
        <p>
            Bookster is a clever sell and buy platform for books.
        </p>
        <el-input v-model="query" class="search-input" placeholder="Harry Potter..." clearable />
        <el-button type="primary" class="search-btn" @click="search">Search</el-button>
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
                this.$store.commit('setQuery', this.query)
                this.$router.push('results')
            }
        }
    }
</script>

<style scoped>
    .search-text {
        text-align: center;
    }

    .search-box {
        margin: 20px 15% 20px 15%;
        padding: 20px 20px 20px 20px;
        background-color: white;
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

    @media only screen and (max-width: 600px) {
        .search-input {
            width: auto;
        }

        .search-btn {
            width: 100%;
        }

        .search-box {
            margin: 0;
        }
    }
</style>