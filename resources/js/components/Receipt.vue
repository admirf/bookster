<template>
    <div>
        <div v-if="! this.cart.length">
            <h2>Nothing in the Cart</h2>
        </div>
        <div v-else class="box">

        </div>
    </div>

</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        name: "Receipt",
        computed: {
            ...mapGetters({
                cart: 'getCart',
            })
        }
    }
</script>

<style scoped>
    .box {
        background-color: white;
        height: 600px;
        width: 100%;
    }

    @media screen and (min-width: 600px) {
        .box {
            width: 500px;
        }
    }
</style>