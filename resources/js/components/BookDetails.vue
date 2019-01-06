<template>
    <div class="book-details" v-if="book">
        <div v-show="book.media.length > 0">
            <el-carousel type="card" height="200px">
                <el-carousel-item v-for="media in book.media" :key="media.id">
                    <img :src="media.url" />
                </el-carousel-item>
            </el-carousel>
        </div>


        <div class="title">
            <h3>Book</h3>
        </div>
        <div class="row">
            <div>Book ID:</div>
            <div>{{ book.id }}</div>
        </div>
        <div class="row">
            <div>Title:</div>
            <div>{{ book.title }}</div>
        </div>
        <div class="row">
            <div>Author:</div>
            <div>{{ book.author}}</div>
        </div>
        <div class="row">
            <div>Posted by:</div>
            <div>
                <router-link :to="`/user/${book.user.id}`">{{ book.user.name }}</router-link>
            </div>
        </div>
        <div class="row">
            <div>Posted at:</div>
            <div>{{ book.created_at.date}}</div>
        </div>
        <div class="row">
            <div>Category:</div>
            <div>{{ book.category.name}}</div>
        </div>
        <div v-if="book.edition" class="row">
            <div>Edition:</div>
            <div>{{ book.edition}}</div>
        </div>
        <div v-if="book.num_of_pages" class="row">
            <div>Number of Pages:</div>
            <div>{{ book.num_of_pages}}</div>
        </div>
        <div v-if="book.isbn" class="row">
            <div>ISBN:</div>
            <div>{{ book.isbn}}</div>
        </div>
        <div class="row">
            <div>Language Code:</div>
            <div>{{ book.language}}</div>
        </div>

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
    .row {
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-between;
        padding-top: 18px;
        padding-bottom: 18px;
        border-bottom: #011e4f 1px solid;
    }

    .price {
        color: green;
        display: flex;
        align-items: center;
        margin: 5px;
    }

    .right-btn {
        width: 100px;
    }

    .cont {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        margin-top: 18px;
    }

    img {
        max-width: 100%;
    }

    .book-details {
        display: flex;
        flex-direction: column;
        background-color: white;
        padding: 18px;
    }

    .my-btn {
        width: 100%;
    }

    .title {
        text-align: center;
        border-bottom: #011e4f 1px solid;
    }
</style>