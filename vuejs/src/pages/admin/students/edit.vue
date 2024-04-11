<script>
import { defineComponent, ref, reactive, toRefs } from "vue";
import { useRouter } from "vue-router";
import { useRoute } from "vue-router";
import { message } from "ant-design-vue";

export default defineComponent({
  setup() {
    const router = useRouter();
    const route = useRoute();
    const lophocs = ref([]);
    const khoahocs = ref([]);
    const students = reactive({
      name: "",
      email: "",
      phone: "",
      address: "",
      lophoc_id: [],
      khoahoc_id: [],
    });

    const errors = ref([]);

    const getStudentsEdit = () => {
      axios
        .get(`http://127.0.0.1:8000/api/students/${route.params.id}/edit`)      
        .then((response) => {
          students.name = response.data.sinhviens.name;
          students.email = response.data.sinhviens.email;
          students.phone = response.data.sinhviens.phone;
          students.address = response.data.sinhviens.address;
          students.lophoc_id = response.data.sinhviens.lophoc_id;
          students.khoahoc_id = response.data.sinhviens.khoahoc_id;

          lophocs.value = response.data.lophocs;
          khoahocs.value = response.data.khoahocs;
        })
        .catch((error) => {
          console.log(error);
        });
    };

    const filterOption = (input, option) => {
      return option.label.toLowerCase().indexOf(input.toLowerCase()) >= 0;
    };

    const updateStudents = () => {
      axios
        .put(`http://127.0.0.1:8000/api/students/${route.params.id}`, students)
        .then((response) => {
          if (response.status == 200) {
            message.success("Update    success!");
            router.push({ name: "admin-students" });
          }
        })
        .catch((error) => {
          errors.value = error.response.data.errors;
        });
    };

    getStudentsEdit();

    return {
      lophocs,
      khoahocs,
      ...toRefs(students),
      errors,
      filterOption,
      updateStudents,
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
    <form @submit.prevent="updateStudents()">
      <a-card title="Update Student">
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

          <div class="col text-start">
            <label for="">
              <span class="text-danger me-1">*</span>
              <span
                :class="{
                  'text-danger': errors.email,
                }"
                >Email:</span
              >
            </label>
            <a-input
              v-model:value="email"
              placeholder="Email"
              allow-clear
              :class="{
                'input-danger': errors.email,
              }"
            />
            <div class="w-100"></div>

            <span v-if="errors.email" class="text-danger">{{
              errors.email[0]
            }}</span>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col text-start">
            <label for="">
              <span class="text-danger me-1">*</span>
              <span
                :class="{
                  'text-danger': errors.phone,
                }"
                >Phone:</span
              >
            </label>
            <a-input
              v-model:value="phone"
              placeholder="Phone"
              allow-clear
              :class="{
                'input-danger': errors.phone,
              }"
            />
            <div class="w-100"></div>

            <span v-if="errors.phone" class="text-danger">{{
              errors.phone[0]
            }}</span>
          </div>

          <div class="col text-start">
            <label for="">
              <span class="text-danger me-1">*</span>
              <span
                :class="{
                  'text-danger': errors.address,
                }"
                >Address:</span
              >
            </label>
            <a-input
              v-model:value="address"
              placeholder="Address"
              allow-clear
              :class="{
                'input-danger': errors.address,
              }"
            />
            <div class="w-100"></div>

            <span v-if="errors.address" class="text-danger">{{
              errors.address[0]
            }}</span>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col text-start">
            <label for="">
              <span class="text-danger me-1">*</span>
              <span
                :class="{
                  'text-danger': errors.lophoc_id,
                }"
              >
                Class:</span
              >
            </label>
            <a-select
              v-model:value="lophoc_id"
              show-search
              placeholder="Class"
              style="width: 100%"
              :options="lophocs"
              :filter-option="filterOption"
              allow-clear
              :class="{
                'select-danger': errors.lophoc_id,
              }"
            ></a-select>
            <div class="w-100"></div>
            <span v-if="errors.lophoc_id" class="text-danger">{{
              errors.lophoc_id[0]
            }}</span>
          </div>

          <div class="col text-start">
            <label for="">
              <span class="text-danger me-1">*</span>
              <span
                :class="{
                  'text-danger': errors.khoahoc_id,
                }"
                >Course:</span
              >
            </label>
            <a-select
              v-model:value="khoahoc_id"
              show-search
              placeholder="Course"
              style="width: 100%"
              :options="khoahocs"
              :filter-option="filterOption"
              allow-clear
              :class="{
                'select-danger': errors.khoahoc_id,
              }"
            ></a-select>
            <div class="w-100"></div>
            <span v-if="errors.khoahoc_id" class="text-danger">{{
              errors.khoahoc_id[0]
            }}</span>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col">
            <a-button class="me-2">
              <router-link
                style="text-decoration: none"
                :to="{ name: 'admin-students' }"
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
