<script>
import TheHeader from "../components/TheHeader.vue";
import TheMenu from "../components/TheMenu.vue";
import TheFooter from "../components/TheFooter.vue";
export default {
  components: {
    TheHeader,
    TheMenu,
    TheFooter,
  },
};
</script>

<template>
  <TheHeader />

  <div class="container-fluid">
    <TheMenu />
    <router-view></router-view>
  </div>
  <TheFooter />
</template>
