<template>
    <div>
        <div v-if="! this.cart.length">
            <h2>Nothing in the Cart</h2>
        </div>
        <div v-else class="box">

            <el-row class="table-header">
                <el-col :span="2">ID</el-col>
                <el-col :span="4">Title</el-col>
                <el-col :span="4">Price</el-col>
                <el-col :span="4">Seller</el-col>
                <el-col :span="5">View</el-col>
                <el-col :span="5">Remove</el-col>
            </el-row>

            <el-row class="table-row" v-for="(book, index) in cart" :key="book.id" :gutter="20">
                <el-col :span="2">
                    <strong>{{ book.id }}</strong>
                </el-col>
                <el-col :span="4">
                    {{ book.title }}
                </el-col>
                <el-col :span="4">
                    <i>{{ book.price }}</i> $
                </el-col>
                <el-col :span="4">
                    {{ book.user.name }}
                </el-col>
                <el-col :span="10">
                    <el-button type="primary" @click="viewBook(book.id)">View</el-button>
                    <el-button type="danger" @click="removeBook(index)">Remove</el-button>
                </el-col>
            </el-row>

            <el-row class="table-footer">
                <el-col :span="12">
                    <label>Total</label><br>
                    <i>{{ total }}</i> $
                </el-col>
                <el-col :span="12">
                    <el-button class="buy-btn" type="success" @click="buy">Buy</el-button>
                </el-col>
            </el-row>

        </div>
    </div>

</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        name: "Receipt",
        computed: {
            ...mapGetters({
                cart: 'getCart',
                authToken: 'getAuthToken'
            }),
            total () {
                return this.cart.reduce((val, book) => {
                    return val + book.price
                }, 0)
            }
        },
        methods: {
            buy () {
                if (! this.authToken) {
                    this.$notify.error({
                        title: 'Buy Error',
                        message: 'You need an account to buy books'
                    })
                    this.$router.push('login')
                }
            },
            viewBook (id) {
                this.$router.push({
                    name: 'book',
                    params: {
                        id: id
                    }
                })
            },
            removeBook (index) {
                this.$store.commit('removeFromCart', index)
            }
        }
    }
</script>

<style scoped>
    .buy-btn {
        width: 100%;
    }

    .box {
        background-color: white;
        width: 100%;
        display: flex;
        justify-content: center;
        flex-direction: column;
        text-align: center;
    }

    .table-header {
        border-bottom: #011e4f 1px solid;
        margin: 18px;
        padding-bottom: 18px;
    }

    .table-footer {
        border-top: #011e4f 1px solid;
        margin: 18px;
        padding-top: 18px;
    }

    .table-row {
        padding: 18px;
    }

    @media screen and (min-width: 600px) {
        .box {
            width: 500px;
        }
    }
</style>