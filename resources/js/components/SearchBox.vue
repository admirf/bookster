<template>
    <div @keyup.enter="setQuery">
        <el-input v-model="query" placeholder="Search..." clearable></el-input>
    </div>
</template>

<script>
    export default {
        name: "SearchBox",
        data () {
            return {
                query: ""
            }
        },
        methods: {
            setQuery () {
                this.$store.commit('setQuery', this.query)
            }
        }
    }
</script>

<style scoped>

</style>