<template>
    <div class="transactions">
        <div style="text-align: center">
            <h3>Your Transactions</h3>
        </div>
        <div class="transaction align-vertical" v-for="(transaction, index) in transactions" :key="transaction.id" :class="color(index)">
            <div><strong>ID:</strong> <em>{{ transaction.id }}</em></div>
            <div>Credits: {{ transaction.credits }}</div>
            <div>Completed: <span :class="colorBoolean(transaction.completed)">{{ transaction.completed }}</span></div>
            <div>
                <el-button type="primary" @click="goToTransaction(transaction.id)"><i class="el-icon-view"></i></el-button>
                <el-button type="success" @click="complete(transaction.id, index)" :disabled="transaction.completed">Complete</el-button>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import ErrorHandler from '../util/errorHandler'
    import { mapGetters } from 'vuex'

    export default {
        name: "MyTransactions",
        data () {
            return {
                transactions: []
            }
        },
        computed: {
            ...mapGetters({
                authToken: 'getAuthToken'
            })
        },
        created () {
            axios.get('/api/transactions', {
                headers: {
                    Authorization: `Bearer ${this.authToken}`
                }
            }).then(response => {
                this.transactions = response.data.data
            }).catch(error => {
                ErrorHandler.handle(error, this)
            })
        },
        methods: {
            complete (id, index) {
                axios.get(`/api/transactions/${id}/complete`, {
                    headers: {
                        Authorization: `Bearer ${this.authToken}`
                    }
                }).then(response => {
                    this.$notify.success({
                        title: 'Success',
                        message: `Transaction ID: ${id} completed successfully.`
                    })
                    this.$set(this.transactions, index, response.data.data)
                }).catch(error => {
                    ErrorHandler.handle(error)
                })
            },
            goToTransaction (id) {
                this.$router.push({
                    name: 'transaction',
                    params: {
                        id: id
                    }
                })
            },
            color (index) {
                return index % 2 === 1 ? 'background': ''
            },
            colorBoolean (b) {
                return b ? 'color-true': 'color-false'
            }
        }
    }
</script>

<style scoped>
    .color-true {
        color: #1d643b;
    }

    .color-false {
        color: maroon;
    }

    .align-vertical {
        line-height: 40px;
    }

    .transaction {
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

    .transactions {
        width: 500px;
        background-color: white;
        padding: 18px;
    }

    @media screen and (max-width: 600px) {
        .transactions {
            width: 100%;
        }
    }
</style>