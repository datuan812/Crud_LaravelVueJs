<script>
import { defineComponent, ref, reactive, toRefs } from "vue";
import { useRouter } from "vue-router";
import { message } from "ant-design-vue";

export default defineComponent({
  setup() {
    const router = useRouter();
    const courses = reactive({
      name: "",
    });

    const errors = ref([]);

    const createCourses = () => {
      axios
        .post("http://127.0.0.1:8000/api/courses", courses)
        .then((response) => {
          if (response.status == 200) {
            message.success("Create success!");
            router.push({ name: "admin-courses" });
          }
        })
        .catch((error) => {
          errors.value = error.response.data.errors;
        });
    };

    return {
      ...toRefs(courses),
      errors,
      createCourses,
    };
  },
});
</script>
<style>
.select-danger {
  border: 1px solid red;
  border-radius: 7px;
}

.input-danger {
  border-color: red;
  border-radius: 7px;
}
</style>

<template>
  <div class="container">
    <form @submit.prevent="createCourses()">
      <a-card title="Create Course">
        <div class="row">
          <div class="col text-start">
            <label for="">
              <span class="text-danger me-1">*</span>
              <span
                :class="{
                  'text-danger': errors.name,
                }"
                >Name:
              </span>
            </label>
            <a-input
              v-model:value="name"
              placeholder="Name"
              allow-clear
              :class="{
                'input-danger': errors.name,
              }"
            />
            <div class="w-100"></div>

            <span v-if="errors.name" class="text-danger">{{
              errors.name[0]
            }}</span>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col">
            <a-button class="me-2">
              <router-link
                style="text-decoration: none"
                :to="{ name: 'admin-courses' }"
              >
                <span>Cancel</span>
              </router-link>
            </a-button>

            <a-button type="primary" html-type="submit">
              <span>Submit</span>
            </a-button>
          </div>
        </div>
      </a-card>
    </form>
  </div>
</template>
