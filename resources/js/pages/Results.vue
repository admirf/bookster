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
    .aside {
        display: block;
    }

    @media only screen and (max-width: 700px) {
        .aside {
            display: none;
        }
    }
</style>