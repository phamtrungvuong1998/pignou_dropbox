<script>
import axios from "../../axios.js";
import FooterComp from "../../components/auth/FooterComp.vue";
import HeaderComp from "../../components/auth/HeaderComp.vue";

export default {
    name: "VerifyEmailPage",
    components: {HeaderComp, FooterComp},
    data() {
        return {
            dataVerify: {
                id: null,
                hash: null,
            },
            message: null,
            count: 3,
        }
    },
    async created() {
        let id = this.$route.params.id;
        let hash = this.$route.params.hash;
        try {
            await axios.get(`/verify-email/${id}/${hash}`);
            this.message =  `Xác thực email thành công. Vui lòng đợi trong ${this.count} giây để quay lại trang chủ`;
            setInterval(() => {
                this.count--;
                this.message =  `Xác thực email thành công. Vui lòng đợi trong ${this.count} giây để quay lại trang chủ`;
            }, 1000);
            setTimeout(() => {
                this.$router.push('/');
            }, 3000);
        } catch (e) {
            this.message = "Đường link không tồn tại";
        }
    }
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
                            <form>
                                <div class="form-group">
                                    <div class="form-text text-muted" align="center">
                                        {{ message }}
                                    </div>
                                </div>
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
