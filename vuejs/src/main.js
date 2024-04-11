import { createApp } from "vue";
// import './style.css'
import router from "./router/index.js";
import Antd from "ant-design-vue";
import App from "./App.vue";
import "ant-design-vue/dist/reset.css";
import axios from "axios";
window.axios = axios;

import "bootstrap/dist/css/bootstrap-grid.min.css";
import "bootstrap/dist/css/bootstrap-utilities.min.css";
import "bootstrap/dist/css/bootstrap.min.css";
import "./static/fontawesome/css/all.min.css";
const app = createApp(App);

app.use(router);
app.use(Antd);
app.mount("#app");
