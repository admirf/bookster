<template>
    <div>
        <el-menu :default-active="$route.path"
                 background-color="#011e4f"
                 text-color="#e5eefc"
                 active-text-color="#9fc1f9"
                 @select="handleSelect"
                 mode="horizontal"
                 :router="true">

            <el-menu-item index="/">
                <div v-if="collapse">H</div>
                <div v-else>Home</div>
            </el-menu-item>
            <el-menu-item index="/results">
                <div v-if="collapse">S</div>
                <div v-else>Search</div>
            </el-menu-item>
            <el-menu-item index="/cart">
                <div v-if="collapse">C</div>
                <div v-else>Cart</div>
            </el-menu-item>
            <el-menu-item v-if="authToken" index="#" @click="logout" class="right">
                <div v-if="collapse">L</div>
                <div v-else>Log Out</div>
            </el-menu-item>
            <el-menu-item v-if="!authToken" index="/login" class="right">
                <div v-if="collapse">L</div>
                <div v-else>Login</div>
            </el-menu-item>
            <el-menu-item v-if="!authToken" index="/register" class="right">
                <div v-if="collapse">R</div>
                <div v-else>Register</div>
            </el-menu-item>
            <el-menu-item v-if="authToken" index="/account" class="right">
                <div v-if="collapse">AC</div>
                <div v-else>Account</div>
            </el-menu-item>
            <el-menu-item v-if="authToken && admin" index="/admin" class="right">
                <div v-if="collapse">A</div>
                <div v-else>Admin</div>
            </el-menu-item>
            <el-menu-item v-if="authToken" index="/create-book" class="right">
                <div v-if="collapse">+</div>
                <div v-else><i class="el-icon-plus"></i></div>
            </el-menu-item>
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
                width: 0
            };
        },
        computed: {
            ...mapGetters({
                authToken: 'getAuthToken',
                admin: 'getAdmin'
            }),
            collapse () {
                return this.width < 560
            }
        },
        mounted() {
            this.$nextTick(() => {
                window.addEventListener('resize', () => {
                    this.width = window.innerWidth
                });
            })
        },
        created () {
            this.width = window.innerWidth

            if (this.authToken) {
                axios.get('/api/me', {
                    headers: {
                        Authorization: `Bearer ${this.authToken}`
                    }
                }).then(response => {
                    response.data.data.roles.forEach(item => {
                        if (item.name === 'admin') {
                            this.$store.commit('setAdmin', true)
                        }
                    })
                }).catch(error => {
                    ErrorHandler.handle(error, this)
                })
            }
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
                    this.$store.commit('setAdmin', false)
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