<script>
import HeaderComp from "../../components/auth/HeaderComp.vue";
import FooterComp from "../../components/auth/FooterComp.vue";
export default {
    name: "ResetPasswordPage",
    components: {
        HeaderComp,
        FooterComp,
    },
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
                            <h4 class="card-title">Reset Password</h4>
                            <form method="POST">

                                <div class="form-group">
                                    <label for="new-password">New Password</label>
                                    <input id="new-password" type="password" class="form-control" name="password" required autofocus data-eye>
                                    <div class="form-text text-muted">
                                        Make sure your password is strong and easy to remember
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
