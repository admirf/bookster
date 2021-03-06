<template>
    <div class="box" v-if="user">
        <div class="title">
            <h3>User</h3>
        </div>
        <div class="row">
            <div>User ID:</div>
            <div>{{ user.id }}</div>
        </div>
        <div class="row">
            <div>Name:</div>
            <div>{{ user.name }}</div>
        </div>
        <div class="row">
            <div>User Since:</div>
            <div>{{ user.created_at.date}}</div>
        </div>
        <div class="title">
            <h4>Books</h4>
        </div>
        <div v-for="(book, index) in user.books" :key="book.id" class="row" :class="color(index)">
            <div>Book ID: <a :href="`/book/${book.id}`"><strong>{{ book.id }}</strong></a></div>
            <div>{{ book.title}} {{ book.price }} $</div>
        </div>

        <div class="cont">
            <div v-if="authToken && admin" class="horizontal-spacer"></div>
            <div v-if="authToken && admin" class="right-btn">
                <el-button type="danger" class="my-btn" @click="deleteUser(user.id)">Delete</el-button>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import { mapGetters } from 'vuex'
    import ErrorHandler from '../util/errorHandler'

    export default {
        name: "UserDetails",
        props: {
            user: {
                required: true
            }
        },
        computed: {
            ...mapGetters({
                authToken: 'getAuthToken',
                admin: 'getAdmin'
            })
        },
        methods: {
            deleteUser (id) {
                axios.delete(`/api/users/${id}`, {
                    headers: {
                        Authorization: `Bearer ${this.authToken}`
                    }
                }).then(response => {
                    this.$notify.success('Successfully deleted user.')
                    this.$router.go(-1)
                }).catch(error => {
                    ErrorHandler.handle(error, this)
                })
            },
            color (index) {
                return index % 2 === 1 ? 'background': ''
            },
        }
    }
</script>

<style scoped>
    .title {
        text-align: center;
        border-bottom: #011e4f 1px solid;
    }

    .background {
        background-color: whitesmoke;
    }

    .right-btn {
        width: 100px;
    }

    .my-btn {
        width: 100%;
    }

    .cont {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        margin-top: 18px;
    }

    .row {
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-between;
        padding-top: 18px;
        padding-bottom: 18px;
        border-bottom: #011e4f 1px solid;
    }

    .box {
        width: 400px;
        display: flex;
        flex-direction: column;
        background-color: white;
        padding: 18px;
    }

    @media screen and (max-width: 600px) {
        .box {
            width: 100%;
        }
    }
</style>