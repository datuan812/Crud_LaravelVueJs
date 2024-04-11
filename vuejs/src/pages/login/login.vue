<script>
import { message } from "ant-design-vue";
export default {
  data() {
    return {
      formData: {
        email: "",
        password: "",
      },
      errors: {},
    };
  },
  methods: {
    loginUser() {
      const loginData = {
        email: this.formData.email,
        password: this.formData.password,
      };

      axios
        .post("http://127.0.0.1:8000/api/login", loginData)
        .then((response) => {
          // Xử lý phản hồi từ máy chủ sau khi đăng nhập thành công
          const responseData = response.data;

          // Lưu token truy cập vào localStorage hoặc Vuex (đối tượng state quản lý trạng thái ứng dụng)
          const accessToken = responseData.access_token;

          // Lưu token truy cập để sử dụng cho các yêu cầu xác thực sau này
          localStorage.setItem("access_token", accessToken);

          message.success("Login success!");
          // Chuyển hướng hoặc thực hiện các hành động khác sau khi đăng nhập thành công
          this.$router.push("/admin");
        })
        .catch((error) => {
          if (error.response && error.response.status === 422) {
            this.errors = error.response.data.errors;
          } else {
            message.error("Login fail!");
            console.error(error);
          }
        });
    },
  },
};
</script>

<template>
  <div class="container">
    <div class="row p-5">
      <div class="col-4"></div>
      <div class="col-4 khung">
        <h2 class="text-center text-uppercase text-success my-3">Login</h2>
        <form @submit.prevent="loginUser()">
          <div class="row">
            <div class="col-12">
              <label for="email">Email:</label>
              <input
                type="email"
                class="form-control"
                id="email"
                v-model="formData.email"
              />
              <span class="error text-danger" v-if="errors.email">{{
                errors.email[0]
              }}</span>
            </div>
            <div class="col-12 mt-3">
              <label for="password">Password:</label>
              <input
                type="password"
                class="form-control"
                id="password"
                v-model="formData.password"
              />
              <span class="error text-danger" v-if="errors.password">{{
                errors.password[0]
              }}</span>
            </div>

            <div class="col mt-3 hstack gap-3">
              <div class="p-2">
                <input
                  class="form-check-input"
                  type="checkbox"
                  aria-label="..."
                />
                <span> Remember</span>
              </div>
              <div class="p-2 ms-auto">
                <a href="#" style="text-decoration: none; color: darkslategray"
                  >Forgot Password</a
                >
              </div>
            </div>
            <div class="col-12 p-2 text-center">
              <button class="btn btn-primary" type="submit">Login</button>
            </div>
            <a
              href="/register"
              class="text-center p-2"
              style="text-decoration: none"
              >Don't have an account? Sign up</a
            >
          </div>
        </form>
      </div>
      <div class="col-4"></div>
    </div>
  </div>
</template>

<style>
.khung {
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
}
</style>
