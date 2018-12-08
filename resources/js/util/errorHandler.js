export default {
    handle (error, vueInstance) {
        if (error.response && error.response.status === 422) {
            let messages = error.response.data.errors
            for (let key in error.response.data.errors) {
                for (let i in messages[key]) {
                    setTimeout(() => {
                        vueInstance.$notify.error({
                            title: 'Error',
                            message: messages[key][i]
                        });
                    }, 100)
                }
            }
        }

        if (error.response && error.response.status === 404) {
            vueInstance.$router.push({
                name: 'not-found'
            })
        }

        if (error.response && error.response.status === 401) {
            vueInstance.$notify.error({
                title: 'Error',
                message: 'You have to login again'
            })
            vueInstance.$router.push({
                name: 'login'
            })
        }
    }
}