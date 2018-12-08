<template>
    <div class="box" v-if="transaction">
        <div class="title">
            <h3>Transaction</h3>
        </div>
        <div class="row">
            <div>Transaction ID:</div>
            <div>{{ transaction.id }}</div>
        </div>
        <div class="row">
            <div>Completed:</div>
            <div>{{ transaction.completed }}</div>
        </div>
        <div class="row">
            <div>Credits:</div>
            <div><strong>{{ transaction.credits }}</strong> $</div>
        </div>
        <div class="row">
            <div>Completed At:</div>
            <div>{{ transaction.completed_at.date}}</div>
        </div>
        <div class="title">
            <h4>Books</h4>
        </div>
        <div v-for="(book, index) in transaction.books" :key="book.id" class="row" :class="color(index)">
            <div>Book ID: <a :href="`/book/${book.id}`"><strong>{{ book.id }}</strong></a></div>
            <div>Seller: <a :href="`/user/${book.user.id}`">{{ book.user.name }}</a></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "TransactionDetails",
        props: {
            transaction: {
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

    .box {
        width: 400px;
        display: flex;
        flex-direction: column;
        background-color: white;
        padding: 18px;
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

    @media screen and (max-width: 600px) {
        .box {
            width: 100%;
        }
    }
</style>