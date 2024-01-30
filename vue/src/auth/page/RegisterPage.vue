<script>
import axios from "../../axios.js";
import HeaderComp from "../../components/auth/HeaderComp.vue";
import FooterComp from "../../components/auth/FooterComp.vue";
export default {
    name: "RegisterPage",
    components: {
        HeaderComp,
        FooterComp,
    },
    data() {
        return {
            dataRegister: {
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
            },
            dataError: {
                error: {
                    name: null,
                    email: null,
                    password: null,
                }
            }
        }
    },
    methods: {
        async handleRegister() {
            try {
                let data = await axios.post('/register', this.dataRegister);
                this.dataError.error = {
                    name: null,
                    email: null,
                    password: null,
                };
                let response = data.data;
                this.$store.commit("setAccessToken", response.access_token);
                this.$router.push('/send-verify-email');
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
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <HeaderComp></HeaderComp>
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title" align="center">Register</h4>
                            <form method="POST" @submit.prevent="handleRegister()">

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="name" type="text" class="form-control" name="name" v-model="dataRegister.name" autofocus>
                                    <span style="color: red;" v-if="dataError.error.name">{{ dataError.error.name[0] }}</span>
                                </div>

                                <div class="form-group">
                                    <label for="email">E-Mail Address</label>
                                    <input id="email" type="text" class="form-control" name="email" v-model="dataRegister.email">
                                    <span style="color: red;" v-if="dataError.error.email">{{ dataError.error.email[0] }}</span>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" v-model="dataRegister.password" data-eye>
                                    <span style="color: red;" v-if="dataError.error.password">{{ dataError.error.password[0] }}</span>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password Confirmation</label>
                                    <input type="password" class="form-control" name="password" v-model="dataRegister.password_confirmation">
                                </div>

                                <div class="form-group no-margin">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Register
                                    </button>
                                </div>
                                <div class="margin-top20 text-center">
                                    Already have an account? <router-link to="/login">Login</router-link>
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
