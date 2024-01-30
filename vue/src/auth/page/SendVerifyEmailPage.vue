<script>
import axios from "../../axios.js";
import FooterComp from "../../components/auth/FooterComp.vue";
import HeaderComp from "../../components/auth/HeaderComp.vue";

export default {
    name: "SendVerifyEmailPage",
    components: {HeaderComp, FooterComp},
    methods: {
        async resendEmailVerify() {
            let accessToken = this.$store.state.access_token;
            try {
                await axios.post('/email/verification-notification', {}, {
                    headers: {
                        Authorization: `bearer ${accessToken}`
                    }
                });
                alert("Email đã được gửi lại!!!!");
            } catch (e) {
                alert("Có lỗi xảy ra vui lòng thử lại!!!!");
            }
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
                            <form method="POST" @submit.prevent="resendEmailVerify()">
                                <div class="form-group">
                                    <div class="form-text text-muted">
                                        <p>Một email xác thực tài khoản đã gửi đển email của bạn.</p>
                                        <p>Nếu chưa nhận được email hãy bấm nút dưới.</p>
                                    </div>
                                </div>

                                <div class="form-group no-margin">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Resend Email
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <FooterComp></FooterComp>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
