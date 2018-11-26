<template>
    <div @keyup.enter="setQuery">
        <el-row :gutter="20">
            <el-col :xs="24" :span="18">
                <el-input class="my-input" v-model="query" placeholder="Search..." clearable></el-input>
            </el-col>
            <el-col :xs="24" :span="6">
                <el-button type="primary" class="my-btn" @click="setQuery">Search</el-button>
            </el-col>
        </el-row>
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
    .my-btn {
        width: 100%;
    }

    .my-input {
        margin-bottom: 15px;
    }
</style>