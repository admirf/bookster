<template>
    <div class="users">
        <div style="text-align: center">
            <h3>Users</h3>
        </div>
        <div class="user align-vertical" v-for="(user, index) in users" :key="user.id" :class="color(index)">
            <div><strong>ID:</strong> <em>{{ user.id }}</em></div>
            <div>Email: {{ user.email }}</div>
            <div>
                <el-button type="primary" @click="goToUser(user.id)"><i class="el-icon-view"></i></el-button>
                <el-button type="danger" @click="deleteUser(user.id, index)">Ban</el-button>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import ErrorHandler from '../util/errorHandler'
    import { mapGetters } from 'vuex'

    export default {
        name: "AdminUsers",
        data () {
            return {
                users: []
            }
        },
        computed: {
            ...mapGetters({
                authToken: 'getAuthToken'
            })
        },
        created () {
            axios.get('/api/users').then(response => {
                this.users = response.data.data
            }).catch(error => {
                ErrorHandler.handle(error, this)
            })
        },
        methods: {
            goToUser (id) {
                this.$router.push({
                    name: 'user',
                    params: {
                        id: id
                    }
                })
            },
            deleteUser (id, index) {
                axios.delete(`/api/users/${id}`, {
                    headers: {
                        Authorization: `Bearer ${this.authToken}`
                    }
                }).then(response => {
                    this.users.splice(index, 1)
                    this.$notify.success('User removed.')
                }).catch(error => {
                    ErrorHandler.handle(error, this)
                })
            },
            color (index) {
                return index % 2 === 1 ? 'background': ''
            }
        }
    }
</script>

<style scoped>
    .align-vertical {
        line-height: 40px;
    }

    .user {
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-evenly;
        padding-bottom: 9px;
        padding-top: 9px;
        border-top: #011e4f 1px solid;
    }

    .background {
        background-color: whitesmoke;
    }

    .users {
        width: 600px;
        background-color: white;
        padding: 18px;
    }

    @media screen and (max-width: 700px) {
        .users {
            width: 100%;
        }
    }
</style>