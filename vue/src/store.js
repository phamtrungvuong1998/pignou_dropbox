import {createStore} from "vuex";
import Cookies from "js-cookie";
import axios from "./axios.js";

const store = createStore({
    state () {
        return {
            token: null,
            access_token: Cookies.get("access_token"),
            isLogin: false,
            emailVerify: false,
        }
    },
    mutations: {
        setAccessToken (state, accessToken) {
            state.access_token = accessToken;
            Cookies.set("access_token", accessToken);
        }
    },
    actions: {
        async checkAccesstoken({commit}) {
            try {
                let handle = await axios.post('/user', {}, {
                    headers: {
                        Authorization: `bearer ${this.state.access_token}`,
                    }
                });
                let response = handle.data.data;
                if (!response.email_verified_at) {
                    this.state.emailVerify = false;
                } else {
                    this.state.emailVerify = true;
                }

                this.state.isLogin = true;
            } catch (e) {
                this.state.isLogin = false;
                this.state.emailVerify = false;
            }
        }
    }
});

export default store;
