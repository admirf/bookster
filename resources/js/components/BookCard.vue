<template>
    <div class="book" @click="openDetails">
        <img :src="book.thumbnail" :alt="book.title" />
        <hr>
        <span class="title">
            {{ book.title }}
        </span>
        <hr>
        <span class="author">
            <em>{{ book.author }}</em>
        </span>
        <hr>
        <el-button class="buy-btn" type="primary" @click="addToCart">Add</el-button>
        <div class="price">{{ book.price }} $</div>
    </div>
</template>

<script>
    export default {
        name: "BookCard",
        props: {
            book: {
                type: Object,
                required: true
            }
        },
        methods: {
            openDetails () {
                this.$router.push({
                    name: 'book',
                    params: {
                        id: this.book.id
                    }
                })
            },
            addToCart (e) {
                e.stopPropagation()
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
    .book {
        background-color: whitesmoke;
        text-align: center;
        padding-bottom: 44px;
        outline: whitesmoke 4px solid;
        transition: outline-color 0.4s;
    }

    .book:hover {
        cursor: pointer;
        outline: grey 4px solid;
    }

    .price {
        border-radius: 4px;
        float: right;
        background-color: #011e4f;
        color: white;
        width: 80px;
        height: 40px;
        line-height: 40px;
        font-size: larger;
        margin: 2px;
    }

    .title {
        font-size: large;
    }

    .buy-btn {
        float: left;
        width: 80px;
        margin: 2px;
    }

    hr {
        background-color: #011e4f;
        color: #011e4f;
        border: none;
        height: 1px;
    }

    img {
        display: block;
        max-height: 100%;
        max-width: 100%;
    }
</style>