<template>
    <div class="outer">
        <BookDetails :book="book"></BookDetails>
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
    .outer {
        padding-left: 20%;
        padding-right: 20%;
    }

    @media only screen and (max-width: 786px) {
        .outer {
            padding: 0;
        }
    }
</style>