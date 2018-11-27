<template>
    <div class="book" @click="openDetails">
        <img :src="book.thumbnail"/>
        {{ book.title }}
        <br>
        {{ book.author }}
        <br>
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
            }
        }
    }
</script>

<style scoped>
    .book {
        background-color: whitesmoke;
        text-align: center;
        border-radius: 2px;
        padding-bottom: 18px;
    }

    .book:hover {
        cursor: pointer;
    }

    .price {
        float: right;
        background-color: #1b4b72;
        color: white;
        width: 80px;
        margin-bottom: 10px;
    }

    img {
        display: block;
        max-height: 100%;
        max-width: 100%;
    }
</style>