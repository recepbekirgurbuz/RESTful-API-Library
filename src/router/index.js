// router/index.js

import Vue from 'vue';
import VueRouter from 'vue-router';
import DashboardLayout from "@/layout/dashboard/DashboardLayout.vue";
import NotFound from "@/pages/NotFoundPage.vue";

const Dashboard = () => import("@/pages/Dashboard.vue");
const Books = () => import("@/pages/Books.vue");
const Users = () => import("@/pages/Users.vue");
const Icons = () => import("@/pages/Icons.vue");
const BookList = () => import("@/pages/BookList.vue");
const UserList = () => import("@/pages/UserList.vue");

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    component: DashboardLayout,
    redirect: "/dashboard",
    children: [
      { path: "dashboard", name: "dashboard", component: Dashboard },
      { path: "books", name: "books", component: Books },
      { path: "users", name: "users", component: Users },

      { path: "book/:id", name: "Books", component: BookList },
      { path: "user/:id", name: "Users", component: UserList },
      { path: "delivery/:id", name: "icons", component: Icons },

    ]
  },
  { path: "*", component: NotFound },
];

const router = new VueRouter({
  routes,
  mode: 'history', // Bu satır eklenmiştir
});

export default router;
