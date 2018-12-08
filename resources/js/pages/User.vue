<template>
    <div class="top-level">
        <UserDetails :user="user"></UserDetails>
    </div>
</template>

<script>
    import axios from 'axios'
    import UserDetails from '../components/UserDetails'
    import ErrorHandler from '../util/errorHandler'

    export default {
        name: "User",
        components: {
            UserDetails
        },
        data () {
            return {
                user: null
            }
        },
        created () {
            axios.get(`/api/users/${this.$route.params.id}`).then(response => {
                this.user = response.data.data
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