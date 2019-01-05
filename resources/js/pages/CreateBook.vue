<template>
    <div class="cb-container">
        <BookForm mode="create" />
    </div>
</template>

<script>
    import BookForm from '../components/BookForm'

    export default {
        name: "CreateBook",
        components: {
            BookForm
        }
    }
</script>

<style scoped>
    .cb-container {
        display: flex;
        justify-content: center;
    }
</style>