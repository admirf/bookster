export default {
    handle (error, vueInstance) {
        if (error.response && error.response.status === 422) {
            let messages = error.response.data.errors
            for (let key in error.response.data.errors) {
                for (let i in messages[key]) {
                    vueInstance.$notify.error({
                        title: 'Error',
                        message: messages[key][i],
                    });
                }
            }
        }

        if (error.response && error.response.status === 404) {
            vueInstance.$router.push({
                name: 'not-found'
            })
        }
    }
}