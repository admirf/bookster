<template>
    <div>
        <el-container class="container">
            <el-header class="header">
                <Navbar></Navbar>
            </el-header>
            <el-main>
                <transition name="fade" mode="out-in">
                    <router-view></router-view>
                </transition>
            </el-main>
            <el-footer class="footer">
                <Footer></Footer>
            </el-footer>
        </el-container>
    </div>
</template>

<script>
    import Navbar from '../components/Navbar'
    import Footer from '../components/Footer'

    export default {
        name: "app",
        components: {
            Navbar,
            Footer
        }
    }
</script>

<style scoped>
    .header {
        padding: 0;
    }

    .footer {
        background-color: white;
        padding-left: 0;
        padding-right: 0;
    }

    .container {
        height: 100vh;
    }

    .fade-enter-active,
    .fade-leave-active {
        transition-duration: 0.3s;
        transition-property: opacity;
        transition-timing-function: ease;
    }

    .fade-enter,
    .fade-leave-active {
        opacity: 0
    }
</style>