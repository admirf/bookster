<template>
    <div class="reports">
        <div style="text-align: center">
            <h3>Reports</h3>
        </div>

        <div class="report align-vertical" v-for="(report, index) in reports" :key="report.id" :class="color(index)">
            <div class="report-left">
                <div><strong>ID:</strong> <em>{{ report.id }}</em></div>
                <div>{{ report.user.name }}</div>
            </div>
            <div class="report-right">
                <el-button type="primary" @click="goToReport(report.id)"><i class="el-icon-view"></i></el-button>
                <el-button type="danger" @click="deleteReport(report.id, index)">Delete</el-button>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import ErrorHandler from '../util/errorHandler'
    import { mapGetters } from 'vuex'

    export default {
        name: "AdminCategories",
        data () {
            return {
                reports: [],
            }
        },
        computed: {
            ...mapGetters({
                authToken: 'getAuthToken'
            })
        },
        created () {
            axios.get('/api/reports', {
                headers: {
                    Authorization: `Bearer ${this.authToken}`
                }
            }).then(response => {
                this.reports = response.data.data
            }).catch(error => {
                ErrorHandler.handle(error, this)
            })
        },
        methods: {
            goToReport (id) {
                this.$router.push({
                    name: 'report',
                    params: {
                        id: id
                    }
                })
            },
            deleteReport (id, index) {
                axios.delete(`/api/reports/${id}`, {
                    headers: {
                        Authorization: `Bearer ${this.authToken}`
                    }
                }).then(response => {
                    this.reports.splice(index, 1)
                    this.$notify.success('Report deleted.')
                }).catch(error => {
                    ErrorHandler.handle(error, this)
                })
            },
            color (index) {
                return index % 2 === 1 ? 'background': ''
            }
        }
    }
</script>

<style scoped>
    .align-vertical {
        line-height: 40px;
    }

    .report {
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-between;
        padding-bottom: 9px;
        padding-top: 9px;
        border-top: #011e4f 1px solid;
    }

    .report-left {
        width: 100%;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: space-evenly;
    }

    .report-right {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: flex-end;
        padding-right: 9px;
    }

    .background {
        background-color: whitesmoke;
    }

    .reports {
        width: 600px;
        background-color: white;
        padding: 18px;
    }

    @media screen and (max-width: 700px) {
        .reports {
            width: 100%;
        }
    }
</style>