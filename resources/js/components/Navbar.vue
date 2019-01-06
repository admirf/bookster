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
            <el-menu-item index="/cart">Cart</el-menu-item>
            <el-menu-item v-if="authToken" index="#" @click="logout" class="right">Log Out</el-menu-item>
            <el-menu-item v-if="!authToken" index="/login" class="right">Login</el-menu-item>
            <el-menu-item v-if="!authToken" index="/register" class="right">Register</el-menu-item>
            <el-menu-item v-if="authToken" index="/account" class="right">Account</el-menu-item>
            <el-menu-item v-if="authToken" index="/create-book" class="right"><i class="el-icon-plus"></i></el-menu-item>
        </el-menu>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import axios from 'axios'
    import ErrorHandler from '../util/errorHandler'

    export default {
        name: "navbar",
        data() {
            return {
                activeIndex: '0',
            };
        },
        computed: {
            ...mapGetters({
                authToken: 'getAuthToken',
            })
        },
        methods: {
            handleSelect(key, keyPath) {
                console.log(key, keyPath)
            },
            logout () {
                axios.get('/api/logout', {
                    headers: {
                        Authorization: `Bearer ${this.authToken}`
                    }
                }).then(response => {
                    this.$store.commit('setAuthToken', '')
                    this.$router.push('/')
                }).catch(error => {
                    ErrorHandler.handle(error, this)
                })
            }
        }
    }
</script>

<style scoped>
    .right {
        float: right;
    }
</style>