<template>
    <div class="top-level">
        <el-tabs v-model="activeName">
            <el-tab-pane label="Users" name="users"></el-tab-pane>
            <el-tab-pane label="Categories" name="categories"></el-tab-pane>
            <el-tab-pane label="Books" name="books"></el-tab-pane>
            <el-tab-pane label="Report" name="reports"></el-tab-pane>
        </el-tabs>
        <div class="acc-container">
            <AdminUsers v-show="activeName === 'users'" />
            <AdminCategories v-show="activeName === 'categories'" />
            <div v-show="activeName === 'books'" ></div>
            <div v-show="activeName === 'reports'" ></div>
        </div>
    </div>
</template>

<script>
    import AdminUsers from '../components/AdminUsers'
    import AdminCategories from '../components/AdminCategories'

    export default {
        name: "Admin",
        components: {
            AdminCategories,
            AdminUsers
        },
        data () {
            return {
                activeName: 'users'
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