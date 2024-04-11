<script>
export default {
  data() {
    return {
      formData: {
        username: "",
        name: "",
        email: "",
        password: "",
      },
      errors: {},
    };
  },
  methods: {
    registerUser() {
      this.errors = {};
      // Tạo một đối tượng chứa dữ liệu đăng ký từ biểu mẫu
      const registrationData = {
        username: this.formData.username,
        name: this.formData.name,
        email: this.formData.email,
        password: this.formData.password,
      };

      axios
        .post("http://127.0.0.1:8000/api/register", registrationData)
        .then((response) => {
          const responseData = response.data;
          if (responseData.message === "Successfully registered") {
            this.$router.push("/login");
          }
        })
        .catch((error) => {
          if (error.response && error.response.status === 422) {
            this.errors = error.response.data.errors;
          } else {
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
        <h2 class="text-center text-uppercase text-success my-3">Register</h2>
        <form @submit.prevent="registerUser()">
          <div class="row">
            <div class="col-12">
              <label for="username">Username:</label>
              <input
                type="username"
                class="form-control"
                id="username"
                v-model="formData.username"
              />
              <span class="error text-danger" v-if="errors.username">{{
                errors.username[0]
              }}</span>
            </div>
            <div class="col-12 mt-3">
              <label for="name">Name:</label>
              <input
                type="name"
                class="form-control"
                id="name"
                v-model="formData.name"
              />
              <span class="error text-danger" v-if="errors.name">{{
                errors.name[0]
              }}</span>
            </div>
            <div class="col-12 mt-3">
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

            <div class="col-12 p-2 text-center">
              <button class="btn btn-primary" type="submit">Register</button>
            </div>

            <a
              href="/login"
              class="text-center p-2"
              style="text-decoration: none"
            >
              Have an account? Login</a
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
