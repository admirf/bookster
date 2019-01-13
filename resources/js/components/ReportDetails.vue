<template>
    <div class="box" v-if="report">
        <div class="title">
            <h3>Report</h3>
        </div>
        <div class="row">
            <div>Report ID:</div>
            <div>{{ report.id }}</div>
        </div>
        <div class="row">
            <div>Title:</div>
            <div>{{ report.title }}</div>
        </div>
        <div class="row">
            <div style="text-align: center">{{ report.content }}</div>
        </div>
        <div class="row">
            <div>Reported by:</div>
            <router-link :to="`/user/${report.user.id}`">{{ report.user.name }}</router-link>
        </div>
        <div class="row">
            <div>Posted at:</div>
            <div>{{ report.created_at.date}}</div>
        </div>

        <div class="cont">
            <div v-if="authToken && admin" class="horizontal-spacer"></div>
            <div v-if="authToken && admin" class="right-btn">
                <el-button type="danger" class="my-btn" @click="deleteReport(report.id)">Delete</el-button>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import { mapGetters } from 'vuex'
    import ErrorHandler from '../util/errorHandler'

    export default {
        name: "ReportDetails",
        props: {
            report: {
                required: true
            }
        },
        computed: {
            ...mapGetters({
                authToken: 'getAuthToken',
                admin: 'getAdmin'
            })
        },
        methods: {
            deleteReport (id) {
                axios.delete(`/api/reports/${id}`, {
                    headers: {
                        Authorization: `Bearer ${this.authToken}`
                    }
                }).then(response => {
                    this.$notify.success('Successfully deleted report.')
                    this.$router.go(-1)
                }).catch(error => {
                    ErrorHandler.handle(error, this)
                })
            },
            color (index) {
                return index % 2 === 1 ? 'background': ''
            },
        }
    }
</script>

<style scoped>
    .title {
        text-align: center;
        border-bottom: #011e4f 1px solid;
    }

    .background {
        background-color: whitesmoke;
    }

    .right-btn {
        width: 100px;
    }

    .my-btn {
        width: 100%;
    }

    .cont {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        margin-top: 18px;
    }

    .row {
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-between;
        padding-top: 18px;
        padding-bottom: 18px;
        border-bottom: #011e4f 1px solid;
    }

    .box {
        width: 400px;
        display: flex;
        flex-direction: column;
        background-color: white;
        padding: 18px;
    }

    @media screen and (max-width: 600px) {
        .box {
            width: 100%;
        }
    }
</style>