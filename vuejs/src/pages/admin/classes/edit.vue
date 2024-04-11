<script>
import { defineComponent, ref, reactive, toRefs } from "vue";
import { useRouter } from "vue-router";
import { useRoute } from "vue-router";
import { message } from "ant-design-vue";

export default defineComponent({
  setup() {
    const router = useRouter();
    const route = useRoute();
    const classes = reactive({
      name: "",
    });

    const errors = ref([]);

    const getClassesEdit = () => {
      axios
        .get(`http://127.0.0.1:8000/api/classes/${route.params.id}/edit`)
        .then((response) => {
          classes.name = response.data.lophocs.name;
        })
        .catch((error) => {
          console.log(error);
        });
    };

    const updateClasses = () => {
      axios
        .put(`http://127.0.0.1:8000/api/classes/${route.params.id}`, classes)
        .then((response) => {
          if (response.status == 200) {
            message.success("Update success!");
            router.push({ name: "admin-classes" });
          }
        })
        .catch((error) => {
          errors.value = error.response.data.errors;
        });
    };

    getClassesEdit();

    return {
      ...toRefs(classes),
      errors,
      updateClasses,
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
    <form @submit.prevent="updateClasses()">
      <a-card title="Update Class">
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
                :to="{ name: 'admin-classes' }"
              >
                <span>Cancel</span>
              </router-link>
            </a-button>

            <a-button style="background-color: yellow" html-type="submit">
              <span>Update</span>
            </a-button>
          </div>
        </div>
      </a-card>
    </form>
  </div>
</template>
