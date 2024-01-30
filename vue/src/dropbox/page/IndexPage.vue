<script>
import axios from "../../axios.js";
import store from "../../store.js";
import Cookies from "js-cookie";

export default {
    name: "IndexPage",
    methods: {
        async handleLogout() {
            try {
                await axios.post('/logout', {}, {
                    headers: {
                        Authorization: `bearer ${store.state.access_token}`,
                    }
                });
                Cookies.remove('access_token');
                this.$router.push('/login');
            } catch (e) {
                alert("Có lỗi xảy ra. Vui lòng thử lại!!!!!");
            }
        }
    }
}
</script>

<template>
    <h1>Index Page</h1>
    <form @submit.prevent="handleLogout()">
        <button type="submit" class="btn btn-primary">Logout</button>
    </form>
</template>

<style scoped>

</style>
