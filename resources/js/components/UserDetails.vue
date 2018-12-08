<template>
    <div class="box" v-if="user">
        <div class="title">
            <h3>User</h3>
        </div>
        <div class="row">
            <div>User ID:</div>
            <div>{{ user.id }}</div>
        </div>
        <div class="row">
            <div>Name:</div>
            <div>{{ user.name }}</div>
        </div>
        <div class="row">
            <div>User Since:</div>
            <div>{{ user.created_at.date}}</div>
        </div>
        <div class="title">
            <h4>Books</h4>
        </div>
        <div v-for="(book, index) in user.books" :key="book.id" class="row" :class="color(index)">
            <div>Book ID: <a :href="`/book/${book.id}`"><strong>{{ book.id }}</strong></a></div>
            <div>{{ book.title}} {{ book.price }} $</div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserDetails",
        props: {
            user: {
                required: true
            }
        },
        methods: {
            color (index) {
                return index % 2 === 1 ? 'background': ''
            },
        }
    }
</script>

<style scoped>
    .title {
        text-align: center;
        border-bottom: #011e4f 1px solid;
    }

    .background {
        background-color: whitesmoke;
    }

    .row {
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-between;
        padding-top: 18px;
        padding-bottom: 18px;
        border-bottom: #011e4f 1px solid;
    }

    .box {
        width: 400px;
        display: flex;
        flex-direction: column;
        background-color: white;
        padding: 18px;
    }

    @media screen and (max-width: 600px) {
        .box {
            width: 100%;
        }
    }
</style>