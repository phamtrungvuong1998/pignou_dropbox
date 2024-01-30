<script>
import HeaderComp from "../../components/auth/HeaderComp.vue";
import FooterComp from "../../components/auth/FooterComp.vue";
import axios from "../../axios.js";
export default {
    name: "ForgotPasswordPage",
    components: {
        HeaderComp,
        FooterComp,
    },
    data() {
        return {
            dataHandle: {
                email: null,
            },
            dataError: {
                error: {
                    email: null,
                }
            }
        }
    },
    methods: {
        async handleForgotPassword() {
            try {
                let handle = await axios.post('/forgot-password', this.dataHandle);
                this.dataError = {
                    error: {
                        email: null,
                    }
                };
            } catch (e) {
                this.dataError = e.response.data;
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
                            <h4 class="card-title">Forgot Password</h4>
                            <form method="POST" @submit.prevent="handleForgotPassword()">

                                <div class="form-group">
                                    <label for="email">E-Mail Address</label>
                                    <input id="email" class="form-control" name="email" v-model="dataHandle.email" autofocus>
                                    <span style="color: red;" v-if="dataError.error.email">{{ dataError.error.email[0] }}</span>
                                    <div class="form-text text-muted">
                                        By clicking "Reset Password" we will send a password reset link
                                    </div>
                                </div>

                                <div class="form-group no-margin">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Reset Password
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
