<script>
import HeaderComp from "../../components/auth/HeaderComp.vue";
import FooterComp from "../../components/auth/FooterComp.vue";
import axios from "../../axios.js";
export default {
    name: "LoginPage",
    components: {
        HeaderComp,
        FooterComp,
    },
    data() {
        return {
            dataLogin: {
                _token: this.$store.state.token,
                email: null,
                password: null,
            },
            dataError: {
                errors: {
                    email: null,
                    password: null,
                }
            },
        };
    },
    methods: {
        async handleLogin() {
            this.dataError.errors = {
                email: null,
                password: null,
            };
            try {
                let data = await axios.post('/login', this.dataLogin);
                let response = data.data;
                this.$store.commit("setAccessToken", response.access_token);
                this.$router.push('/');
            } catch (e) {
                this.dataError = e.response.data;
                if (typeof this.dataError.errors === "string") {
                    alert("Tài khoản hoặc mật khẩu không chính xác");
                }
            }
        }
    }
}
</script>

<template>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <HeaderComp></HeaderComp>
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title" align="center">Login</h4>
                            <form method="POST" @submit.prevent="handleLogin()">

                                <div class="form-group">
                                    <label for="email">E-Mail Address</label>
                                    <input id="email" class="form-control" name="email" value="" v-model="dataLogin.email" autofocus>
                                    <span style="color: red" v-if="dataError.errors.email">{{ dataError.errors.email[0] }}</span>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password
                                        <router-link to="/forgot-password" class="float-right">Forgot Password?</router-link>
                                    </label>
                                    <input id="password" type="password" class="form-control" v-model="dataLogin.password" name="password" data-eye>
                                    <span style="color: red" v-if="dataError.errors.password">{{ dataError.errors.password[0] }}</span>
                                </div>

                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>

                                <div class="form-group no-margin">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Login
                                    </button>
                                </div>
                                <div class="margin-top20 text-center">
                                    Don't have an account? <router-link to="/register">Create One</router-link>
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
