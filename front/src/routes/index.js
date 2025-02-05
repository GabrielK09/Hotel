import HomeView from '@/views/HomeView.vue';
import HotelCreate from '@/views/hotel/HotelCreate.vue';
import RoomsView from '@/views/rooms/RoomsView.vue';
import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: "/",
    component: HomeView
  },
  {
    path: "/rooms",
    component: RoomsView
  },
  {
    path: "/hotel/create",
    component: HotelCreate
  }
  
]

const router = createRouter({
  history: createWebHistory(),
  routes

})

export default router;