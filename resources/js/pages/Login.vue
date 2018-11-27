<template>
    <div class="login-box" @keyup.enter="login">
        <h2 class="login-text">Sign In</h2>
        <el-input v-model="signInForm.email" class="login-input" placeholder="Email" clearable />
        <el-input type="password" v-model="signInForm.password" class="login-input" placeholder="Password" clearable />
        <el-button type="primary" class="login-btn" @click="login">Sign Up</el-button>
    </div>
</template>

<script>
    import axios from 'axios'
    import ErrorHandler from '../util/errorHandler'

    export default {
        name: "Login",
        data () {
            return {
                signInForm: {
                    email: '',
                    password: ''
                }
            }
        },
        methods: {
            login () {
                let self = this
                axios.post('/api/login', this.signInForm).then(response => {
                    self.$store.commit('setAuthToken', response.data.access_token)
                    self.$notify.success({
                        title: 'Success',
                        message: "Successful login",
                    })
                    self.$router.push({
                        name: 'search'
                    })
                }).catch(error => {
                    ErrorHandler.handle(error, self)
                })
            }
        }
    }
</script>

<style scoped>
    .login-text {
        text-align: center;
    }

    .login-box {
        margin: 20px 15% 20px 15%;
        padding: 20px 20px 20px 20px;
        background-color: white;
    }

    .login-btn {
        width: 350px;
        display: block;
        margin: 0 auto 20px auto;
    }

    .login-input {
        width: 350px;
        display: block;
        margin: 20px auto 20px auto;
    }
</style>