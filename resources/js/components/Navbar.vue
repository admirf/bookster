<template>
    <div>
        <el-menu :default-active="$route.path"
                 background-color="#011e4f"
                 text-color="#e5eefc"
                 active-text-color="#9fc1f9"
                 @select="handleSelect"
                 mode="horizontal"
                 :router="true">
            <el-menu-item index="/">Home</el-menu-item>
            <el-menu-item index="/results">Search</el-menu-item>
            <el-menu-item index="/basket">My Basket</el-menu-item>
            <el-menu-item index="#" route="#" class="right" @click="openLogin">Login</el-menu-item>
        </el-menu>
    </div>
</template>

<script>
    export default {
        name: "navbar",
        data() {
            return {
                activeIndex: '0',
            };
        },
        methods: {
            handleSelect(key, keyPath) {
                console.log(key, keyPath)
            },
            openLogin() {
                console.log('clicked')
            }
        }
    }
</script>

<style scoped>
    .right {
        float: right;
    }
</style>