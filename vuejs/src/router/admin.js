const admin = [
  {
    path: "/admin",
    name: "admin",
    component: () => import("../layouts/admin.vue"),
    children: [
      //Quản lý classes
      {
        path: "classes",
        name: "admin-classes",
        component: () => import("../pages/admin/classes/index.vue"),
      },
      {
        path: "classes/create",
        name: "admin-classes-create",
        component: () => import("../pages/admin/classes/create.vue"),
      },
      {
        path: "classes/:id/edit",
        name: "admin-classes-edit",
        component: () => import("../pages/admin/classes/edit.vue"),
      },
      //Quản lý courses
      {
        path: "courses",
        name: "admin-courses",
        component: () => import("../pages/admin/courses/index.vue"),
      },
      {
        path: "courses/create",
        name: "admin-courses-create",
        component: () => import("../pages/admin/courses/create.vue"),
      },
      {
        path: "courses/:id/edit",
        name: "admin-courses-edit",
        component: () => import("../pages/admin/courses/edit.vue"),
      },
      //Quản lý students
      {
        path: "students",
        name: "admin-students",
        component: () => import("../pages/admin/students/index.vue"),
      },

      {
        path: "students/create",
        name: "admin-students-create",
        component: () => import("../pages/admin/students/create.vue"),
      },

      {
        path: "students/:id/edit",
        name: "admin-students-edit",
        component: () => import("../pages/admin/students/edit.vue"),
      },
    ],
  },
];

export default admin;
