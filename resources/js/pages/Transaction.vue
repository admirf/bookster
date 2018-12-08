<template>
    <div class="top-level">
        <TransactionDetails :transaction="transaction"></TransactionDetails>
    </div>
</template>

<script>
    import axios from 'axios'
    import { mapGetters } from 'vuex'
    import TransactionDetails from '../components/TransactionDetails'
    import ErrorHandler from '../util/errorHandler'

    export default {
        name: "Transaction",
        components: {
            TransactionDetails
        },
        data () {
            return {
                transaction: null
            }
        },
        computed: {
            ...mapGetters({
                authToken: 'getAuthToken'
            })
        },
        created () {
            axios.get(`/api/transactions/${this.$route.params.id}`, {
                headers: {
                    Authorization: `Bearer ${this.authToken}`
                }
            }).then(response => {
                this.transaction = response.data.data
            }).catch(error => {
                ErrorHandler.handle(error, this)
            })
        }
    }
</script>

<style scoped>
    .top-level {
        display: flex;
        justify-content: center;
    }
</style>