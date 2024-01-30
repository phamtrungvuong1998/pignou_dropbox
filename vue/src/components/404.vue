<script>
import FooterComp from "./auth/FooterComp.vue";
import HeaderComp from "./auth/HeaderComp.vue";

export default {
    name: "404",
    components: {HeaderComp, FooterComp}
}
</script>

<template>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center align-items-center h-100">
                <div class="card-wrapper">
                    <HeaderComp></HeaderComp>
                    <div class="card fat">
                        <div class="card-body">
                            <form method="POST" @submit.prevent="resendEmailVerify()">
                                <h1 align="center">404</h1>
                                <router-link to="/">
                                    <button class="btn btn-primary" style="width: 100%; cursor: pointer;">Về trang chủ</button>
                                </router-link>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
