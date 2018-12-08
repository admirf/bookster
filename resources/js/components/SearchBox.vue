<template>
    <div @keyup.enter="setQuery">
        <el-row :gutter="20">
            <el-col :xs="24" :span="18">
                <el-input class="my-input" v-model="input" placeholder="Search..." clearable></el-input>
            </el-col>
            <el-col :xs="24" :span="6">
                <el-button type="primary" class="my-btn" @click="setQuery">Search</el-button>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        name: "SearchBox",
        data () {
            return {
                input: ''
            }
        },
        computed: {
            ...mapGetters({
                query: 'getQuery'
            })
        },
        created () {
            this.input = this.query
        },
        methods: {
            setQuery () {
                this.$store.commit('setQuery', this.input)
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