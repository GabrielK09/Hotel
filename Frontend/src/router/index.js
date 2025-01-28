import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import("@/views/Dashboard/HomeView.vue"),
    },
    {
      path: "/login",
      name: "login",
      component: () => import("@/views/Auth/LoginView.vue"),
    },
    {
      path: "/register",
      name: "register",
      component: () => import("@/views/Auth/RegisterView.vue"),
    },
    {
      path: "/settings",
      name: "settings",
      component: () => import("@/views/Dashboard/SettingsView.vue"),
    },
    {
      path: '/consumers',
      name: 'consumers',
      component: () => import('../views/Dashboard/ConsumersView.vue'),
    },
    {
      path: '/consumer/form',
      name: 'consumer-form',
      component: () => import('../views/Components/ConsumerForm.vue'),
    },
    {
      path: '/Nfce',
      name: 'nfce',
      component: () => import('../views/Dashboard/NFCeView.vue'),
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('../views/Dashboard/AboutView.vue'),
    },
  ],
})

export default router
