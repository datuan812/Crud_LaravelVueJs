<template>
  <div class="container-fluid">
    <div class="row" style="background-color: aqua; padding: 1rem">
      <div class="hstack gap-3">
        <div class="p-2">Crud Laravel Vuejs</div>
        <div class="vr"></div>
        <div class="p-2 ms-auto">
          <button class="btn btn-danger" @click="logoutUser">Logout</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { message } from "ant-design-vue";
export default {
  methods: {
    logoutUser() {
      message.success("Logout success!");
      localStorage.removeItem("access_token");
      this.$router.push("/login");
    },
  },
};
</script>
