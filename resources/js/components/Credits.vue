<template>
    <div class="box">
        <div class="title">
            <h3>Credits</h3>
        </div>
        <div class="row">
            <div>
                Your current balance:
            </div>
            <div v-show="balance">
                <strong>{{ balance }}</strong> $
            </div>
        </div>
        <div class="row">
            <el-input-number v-model="toBeAdded" type="number" placeholder="Balance..." />
            <el-button type="primary" @click="addCredits">Add to Balance</el-button>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import axios from 'axios'
    import ErrorHandler from '../util/errorHandler'

    export default {
        name: "Credits",
        data () {
            return {
                balance: 0,
                toBeAdded: 0,
            }
        },
        computed: {
            ...mapGetters({
                authToken: 'getAuthToken'
            })
        },
        created () {
            this.getBalance()
        },
        methods: {
            addCredits () {
                axios.post('/api/add-balance', {
                    to_be_added: this.toBeAdded
                }, {
                    headers: {
                        Authorization: `Bearer ${this.authToken}`
                    }
                }).then(response => {
                    this.balance = response.data.balance
                }).catch(error => {
                    ErrorHandler.handle(error, this)
                })
            },
            getBalance () {
                axios.get('/api/balance', {
                    headers: {
                        Authorization: `Bearer ${this.authToken}`
                    }
                }).then(response => {
                    this.balance = response.data.balance
                }).catch(error => {
                    ErrorHandler.handle(error, this)
                })
            }
        }
    }
</script>

<style scoped>
    .title {
        text-align: center;
        border-bottom: #011e4f 1px solid;
    }

    .box {
        width: 400px;
        display: flex;
        flex-direction: column;
        background-color: white;
        padding: 18px;
    }

    .row {
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-between;
        padding-top: 18px;
        padding-bottom: 18px;
        border-bottom: #011e4f 1px solid;
    }

    @media screen and (max-width: 600px) {
        .box {
            width: 100%;
        }
    }
</style>