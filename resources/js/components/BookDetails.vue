<template>
    <div class="book-details" v-if="book">
        <el-carousel type="card" height="200px">
            <el-carousel-item v-for="media in book.media" :key="media.id">
                <img :src="media.url" />
            </el-carousel-item>
        </el-carousel>

        <br>
        {{ book.title }}
        <br>
        {{ book.author }}
        <br>

        <br>

        <el-row :gutter="20">
            <el-col :span="18">
                <div class="left">
                    {{ book.price }} $
                </div>
            </el-col>
            <el-col :span="6">
                <el-button type="primary" class="my-btn" @click="handleBuy">Buy</el-button>
            </el-col>
        </el-row>

    </div>
</template>

<script>
    export default {
        name: "BookDetails",
        props: {
            book: {
                required: true
            }
        },
        methods: {
            handleBuy () {
                this.$store.dispatch('addToCart', this.book).then(() => {
                    this.$notify.success({
                        title: 'Success',
                        message: `Item ID: ${this.book.id} added to Cart.`,
                    })
                })
            }
        }
    }
</script>

<style scoped>
    img {
        max-width: 100%;
    }

    .book-details {
        background-color: white;
        text-align: center;
    }

    .left {
        text-align: left;
        padding-top: 7px;
        padding-left: 7px;
    }

    .my-btn {
        width: 100%;
    }
</style>