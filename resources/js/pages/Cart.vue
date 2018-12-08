<template>
    <div class="box-container">
        <Receipt></Receipt>
    </div>
</template>

<script>
    import Receipt from '../components/Receipt'

    export default {
        name: "Basket",
        components: {
            Receipt
        }
    }
</script>

<style scoped>
    .box-container {
        display: flex;
        justify-content: center;
    }
</style>