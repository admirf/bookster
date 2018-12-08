<template>
    <div class="register-container">
        <div class="register-box" @keyup.enter="register">
            <h2 class="register-text">Create an Account</h2>
            <el-input v-model="signUpForm.name" class="register-input" placeholder="User Name" clearable />
            <el-input v-model="signUpForm.email" class="register-input" placeholder="Email" clearable />
            <el-input type="password" v-model="signUpForm.password" class="register-input" placeholder="Password" clearable />
            <el-input type="password" v-model="signUpForm.password_confirmation" class="register-input" placeholder="Repeat Password" clearable />
            <el-button type="primary" class="register-btn" @click="register">Sign Up</el-button>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import ErrorHandler from '../util/errorHandler'

    export default {
        name: "Register",
        data () {
            return {
                signUpForm: {
                    name: "",
                    email: "",
                    password: "",
                    password_confirmation: ""
                }
            }
        },
        methods: {
            register () {
                let self = this
                axios.post('/api/sign-up', this.signUpForm).then(response => {
                    self.$notify.success({
                        title: 'Success',
                        message: response.data.status,
                    })
                }).catch(error => {
                    ErrorHandler.handle(error, self)
                })
            }
        }
    }
</script>

<style scoped>
    .register-container {
        display: flex;
        justify-content: center;
    }

    .register-text {
        text-align: center;
    }

    .register-box {
        padding: 20px 20px 20px 20px;
        background-color: white;
        width: 500px;
    }

    .register-btn {
        width: 350px;
        display: block;
        margin: 0 auto 20px auto;
    }

    .register-input {
        width: 350px;
        display: block;
        margin: 20px auto 20px auto;
    }
    
    @media screen and (max-width: 600px) {
        .register-box {
            margin-left: 0;
            margin-right: 0;
            width: 100%;
        }

        .register-input {
            width: 100%;
        }

        .register-btn {
            width: 100%;
        }
    }
</style>