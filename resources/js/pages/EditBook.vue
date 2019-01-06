<template>
    <div class="cb-container">
        <div v-if="book">
            <BookForm mode="edit" :book="book" />
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import BookForm from '../components/BookForm'
    import ErrorHandler from '../util/errorHandler'

    export default {
        name: "EditBook",
        components: {
            BookForm
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
    .cb-container {
        display: flex;
        justify-content: center;
    }
</style>