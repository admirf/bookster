<template>
    <div class="book-details" v-if="book">
        <div v-show="book.media.length > 0">
            <el-carousel type="card" height="200px">
                <el-carousel-item v-for="media in book.media" :key="media.id">
                    <img :src="media.url" />
                </el-carousel-item>
            </el-carousel>
        </div>


        <br>
        <h3>{{ book.title }}</h3>
        <br>
        <em>{{ book.author }}</em>
        <br>
        <br>
        <router-link :to="`/user/${book.user.id}`">{{ book.user.name }}</router-link>
        <br>
        <br>
        <hr>

        <div class="cont">
            <div class="price">
                <strong>{{ book.price }} $</strong>
            </div>
            <div class="right-btn">
                <el-button type="primary" class="my-btn" @click="handleBuy">Buy</el-button>
            </div>
        </div>

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
    hr {
        margin-bottom: 0;
    }

    .price {
        color: green;
        display: flex;
        align-items: center;
        margin: 5px;
    }

    .right-btn {
        width: 100px;
        padding: 5px;
    }

    .cont {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    img {
        max-width: 100%;
    }

    .book-details {
        background-color: white;
        text-align: center;
    }

    .my-btn {
        width: 100%;
    }
</style>