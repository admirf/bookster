<template>
    <div class="report-container">
        <div class="form-box">
            <h3>Fill in a Report</h3>
            <el-input v-model="form.title" placeholder="Title"></el-input>
            <br><br>
            <el-input v-model="form.content" type="textarea" :rows="4"></el-input>
            <br><br>
            <div class="btn-container">
                <el-button type="primary" @click="submit">Submit</el-button>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import { mapGetters } from 'vuex'
    import ErrorHandler from '../util/errorHandler'

    export default {
        name: "Report",
        computed: {
            ...mapGetters({
                authToken: 'getAuthToken'
            })
        },
        data () {
            return {
                form: {}
            }
        },
        methods: {
            submit () {
                axios.post('/api/reports', this.form, {
                    headers: {
                        Authorization: `Bearer ${this.authToken}`
                    }
                }).then(response => {
                    this.$notify.success(`Report with ID: ${response.data.data.id} submitted.`)
                }).catch(error => {
                    ErrorHandler.handle(error, this)
                })
            }
        }
    }
</script>

<style scoped>
    .report-container {
        display: flex;
        justify-content: center;
    }

    .btn-container {
        display: flex;
        justify-content: flex-end;
    }

    .form-box {
        padding: 10px;
        text-align: center;
        width: 400px;
        background-color: white;
    }
</style>