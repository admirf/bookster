<template>
    <div class="top-level">
        <ReportDetails :report="report"></ReportDetails>
    </div>
</template>

<script>
    import axios from 'axios'
    import { mapGetters } from 'vuex'
    import ReportDetails from '../components/ReportDetails'
    import ErrorHandler from '../util/errorHandler'

    export default {
        name: "Report",
        components: {
            ReportDetails
        },
        data () {
            return {
                report: null
            }
        },
        computed: {
            ...mapGetters({
                authToken: 'getAuthToken'
            })
        },
        created () {
            axios.get(`/api/reports/${this.$route.params.id}`, {
                headers: {
                    Authorization: `Bearer ${this.authToken}`
                }
            }).then(response => {
                this.report = response.data.data
            }).catch(error => {
                ErrorHandler.handle(error, this)
            })
        }
    }
</script>

<style scoped>
    .top-level {
        display: flex;
        justify-content: center;
    }
</style>