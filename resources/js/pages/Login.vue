<template>
    <div class="login-container">
        <div class="login-box" @keyup.enter="login">
            <h2 class="login-text">Sign In</h2>
            <el-input v-model="signInForm.email" class="login-input" placeholder="Email" clearable />
            <el-input type="password" v-model="signInForm.password" class="login-input" placeholder="Password" clearable />
            <el-button type="primary" class="login-btn" @click="login">Sign Up</el-button>
            <a href="#" @click="goToRegister">Don't have an account ?</a>
        </div>
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
            goToRegister () {
                this.$router.push('register')
            },
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
    .login-container {
        display: flex;
        justify-content: center;
    }

    .login-text {
        text-align: center;
    }

    .login-box {
        padding: 20px 20px 20px 20px;
        background-color: white;
        width: 500px;
        text-align: center;
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

    a {
        text-decoration: none;
    }

    @media screen and (max-width: 600px) {
        .login-box {
            margin-left: 0;
            margin-right: 0;
            width: 100%;
        }

        .login-input {
            width: 100%;
        }

        .login-btn {
            width: 100%;
        }
    }
</style>