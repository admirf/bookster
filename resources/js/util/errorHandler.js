export default {
    handle (error, vueInstance) {
        if (error.response) {
            switch (error.response.status) {
                case 422:
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
                    break

                case 404:
                    vueInstance.$router.push({
                        name: 'not-found'
                    })
                    break

                case 401:
                    vueInstance.$store.commit('setAuthToken', '');
                    vueInstance.$notify.error({
                        title: 'Error',
                        message: 'You have to login again'
                    });
                    vueInstance.$router.push({
                        name: 'login'
                    });
                    break

                case 403:
                    vueInstance.$notify.error({
                        title: 'Error',
                        message: 'You are not authorized for this action.'
                    })
                    vueInstance.$router.push('/')
                    break

                case 500:
                    vueInstance.$notify.error({
                        title: 'Error',
                        message: 'Server Error'
                    })
                    break

                default:
                    vueInstance.$notify.error({
                        title: 'Error',
                        message: 'Unknown Error'
                    });
                    break
            }
        }
    }
}