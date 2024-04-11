<script setup>
import { ref } from "vue";
import { message } from "ant-design-vue";

const students = ref([]);

const searchTerm = ref("");

const columns = [
  {
    title: "No",
    key: "index",
  },
  {
    title: "Name",
    dataIndex: "name",
    key: "name",
  },
  {
    title: "Email",
    dataIndex: "email",
    key: "email",
  },
  {
    title: "Phone",
    dataIndex: "phone",
    key: "phone",
  },
  {
    title: "Address",
    dataIndex: "address",
    key: "address",
  },
  {
    title: "Class",
    dataIndex: "class",
    key: "class",
  },
  {
    title: "Course",
    dataIndex: "course",
    key: "course",
  },
  {
    title: "Action",
    key: "action",
  },
];

const getStudents = () => {
  axios
    .get("http://127.0.0.1:8000/api/students")
    .then(function (response) {
      students.value = response.data;
    })
    .catch(function (error) {
      console.log(error);
    });
};

const searchClasses = () => {
  if (searchTerm.value) {
    axios
      .get(`http://127.0.0.1:8000/api/students/search?name=${searchTerm.value}`)
      .then((response) => {
        students.value = response.data;
      })
      .catch((error) => {
        console.error(error);
      });
  } else {
    getStudents();
  }
};

const deleteStudent = (id) => {
  if (confirm("Are you sure you want to delete this student?")) {
    axios
      .delete(`http://127.0.0.1:8000/api/students/${id}`)
      .then(function (response) {
        if (response.status == 200) {
          message.success("Delete success!");
        }
        getStudents();
      })
      .catch(function (error) {
        console.log(error);
      });
  }
};
getStudents();
</script>

<template>
  <div class="container">
    <div class="card card-body hstack gap-3 mb-3">
      <div class="p-2">
        <a href="/admin/students/create" class="btn btn-primary">
          <i class="fa-solid fa-plus"></i>
        </a>
      </div>
      <div class="p-2 ms-auto">
        <input
          class="form-control"
          v-model="searchTerm"
          @input="searchClasses"
          placeholder="Enter student name"
        />
      </div>
    </div>
    <a-card title="Student">
      <div class="row">
        <div class="col-12">
          <a-table :dataSource="students" :columns="columns">
            <template #bodyCell="{ column, index, record }">
              <template v-if="column.key === 'index'">
                <span>{{ index + 1 }}</span>
              </template>

              <template v-if="column.key === 'action'">
                <router-link
                  :to="{
                    name: 'admin-students-edit',
                    params: { id: record.id },
                  }"
                >
                  <a-button style="background-color: yellow">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a-button>
                </router-link>
              </template>
              <template v-if="column.key === 'action'">
                <a-button
                  type="primary"
                  danger
                  class="ms-2"
                  @click="deleteStudent(record.id)"
                >
                  <i class="fa-solid fa-trash"></i>
                </a-button>
              </template>
            </template>
          </a-table>
        </div>
      </div>
    </a-card>
  </div>
</template>
