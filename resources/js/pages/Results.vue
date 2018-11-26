<template>
    <el-container>
        <el-aside class="aside">
            <FilterTable></FilterTable>
        </el-aside>
        <el-main>
            <SearchBox></SearchBox>
            <BookList></BookList>
        </el-main>
    </el-container>
</template>

<script>
    import FilterTable from '../components/FilterTable'
    import BookList from '../components/BookList'
    import SearchBox from '../components/SearchBox'

    export default {
        name: "Results",
        components: {
            FilterTable,
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