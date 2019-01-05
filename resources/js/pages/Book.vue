<template>
    <div class="outer">
        <BookDetails class="details" :book="book"></BookDetails>
    </div>
</template>

<script>
    import axios from 'axios'
    import BookDetails from '../components/BookDetails'
    import ErrorHandler from '../util/errorHandler'

    export default {
        name: "Book",
        components: {
            BookDetails
        },
        data () {
            return {
                book: null
            }
        },
        created () {
            axios.get(`/api/books/${this.$route.params.id}`).then(response => {
                this.book = response.data.data
            }).catch(error => {
                ErrorHandler.handle(error, this)
            })
        }
    }
</script>

<style scoped>
    .details {
        width: 400px;
    }
    .outer {
        display: flex;
        justify-content: center;
    }
</style>