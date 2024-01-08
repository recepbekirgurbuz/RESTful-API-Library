// router/index.js

import Vue from 'vue';
import VueRouter from 'vue-router';
import DashboardLayout from "@/layout/dashboard/DashboardLayout.vue";
import NotFound from "@/pages/NotFoundPage.vue";

const Dashboard = () => import("@/pages/Dashboard.vue");
const Profile = () => import("@/pages/Profile.vue");
const Notifications = () => import("@/pages/Notifications.vue");
const Icons = () => import("@/pages/Icons.vue");
const Typography = () => import("@/pages/Typography.vue");
const TableList = () => import("@/pages/TableList.vue");

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    component: DashboardLayout,
    redirect: "/dashboard",
    children: [
      { path: "dashboard", name: "dashboard", component: Dashboard },
      { path: "profile", name: "profile", component: Profile },
      { path: "notifications", name: "notifications", component: Notifications },
      { path: "icons", name: "icons", component: Icons },
      { path: "table-list", name: "table-list", component: TableList }
    ]
  },
  { path: "*", component: NotFound },
];

const router = new VueRouter({
  routes,
  mode: 'history', // Bu satır eklenmiştir
});

export default router;
