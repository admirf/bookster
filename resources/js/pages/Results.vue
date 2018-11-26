<template>
    <el-container>
        <el-aside class="aside">
            <Categories></Categories>
        </el-aside>
        <el-main>
            <SearchBox></SearchBox>
            <BookList></BookList>
        </el-main>
    </el-container>
</template>

<script>
    import Categories from '../components/Categories'
    import BookList from '../components/BookList'
    import SearchBox from '../components/SearchBox'

    export default {
        name: "Results",
        components: {
            Categories,
            BookList,
            SearchBox
        }
    }
</script>

<style scoped>
    @media only screen and (max-width: 600px) {
        .aside {
            display: none;
        }
    }
</style>