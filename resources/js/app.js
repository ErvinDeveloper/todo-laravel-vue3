import { createApp } from "vue"
import store from "@/src/store";
import App from './src/App.vue'
import router from "@/src/router/router";

createApp(App).use(router).use(store).mount('#app')
