<template>
    <div class="top-level">
        <el-tabs v-model="activeName">
            <el-tab-pane label="Settings" name="credits"></el-tab-pane>
            <el-tab-pane label="Transactions" name="transactions"></el-tab-pane>
            <el-tab-pane label="Books" name="books"></el-tab-pane>
            <el-tab-pane label="Report" name="reports"></el-tab-pane>
        </el-tabs>
        <div class="acc-container">
            <Credits v-show="activeName === 'credits'" />
            <MyTransactions v-show="activeName === 'transactions'" />
            <div v-show="activeName === 'books'">test</div>
            <Report v-show="activeName === 'reports'" />
        </div>
    </div>

</template>

<script>
    import MyTransactions from '../components/MyTransactions'
    import Credits from '../components/Credits'
    import Report from '../components/Report'

    export default {
        name: "Account",
        components: {
            MyTransactions,
            Credits,
            Report
        },
        data () {
            return {
                activeName: 'credits'
            }
        }
    }
</script>

<style scoped>
    .top-level {
        display: flex;
        flex-direction: column;
    }

    .acc-container {
        display: flex;
        justify-content: space-evenly;
    }

</style>