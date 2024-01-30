import {createRouter, createWebHistory} from "vue-router";
import store from "./store.js";


const urlCantLogins = ['login', 'register', 'forgot-password', 'reset-password'];
const urlCantEmailVerify = ['send-verify-email', 'verify-email'];

const checkLogin = async (to, from, next) => {
    await store.dispatch("checkAccesstoken");
    let isLogin = store.state.isLogin;
    let emailVerify = store.state.emailVerify;
    if (!isLogin) {
        if (urlCantLogins.includes(to.name)) {
            next();
        } else {
            next('/login');
        }
    } else {
        if (!emailVerify) {
            if (!urlCantEmailVerify.includes(to.name)) {
                next('/send-verify-email');
            } else {
                next();
            }
        } else {
            if (urlCantLogins.includes(to.name) || urlCantEmailVerify.includes(to.name)) {
                next('/');
            } else {
                next();
            }
        }
    }
}

const routes = [
    {
        path: '/login',
        component: () => import('./auth/page/LoginPage.vue'),
        name: 'login',
        beforeEnter: checkLogin,
    },
    {
        path: '/register',
        component: () => import('./auth/page/RegisterPage.vue'),
        name: 'register',
        beforeEnter: checkLogin,
    },
    {
        path: '/forgot-password',
        component: () => import('./auth/page/ForgotPasswordPage.vue'),
        name: 'forgot-password',
        beforeEnter: checkLogin,
    },
    {
        path: '/reset-password',
        component: () => import('./auth/page/ResetPasswordPage.vue'),
        name: 'reset-password',
        beforeEnter: checkLogin,
    },
    {
        path: '/send-verify-email',
        component: () => import('./auth/page/SendVerifyEmailPage.vue'),
        name: 'send-verify-email',
        beforeEnter: checkLogin,
    },
    {
        path: '/verify-email/:id/:hash',
        component: () => import('./auth/page/VerifyEmailPage.vue'),
        name: 'verify-email',
        beforeEnter: checkLogin,
    },
    {
        path: '/',
        component: () => import('./dropbox/page/IndexPage.vue'),
        beforeEnter: checkLogin,
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: () => import('./components/404.vue'),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
