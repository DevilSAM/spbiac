import {createRouter, createWebHistory, RouteRecordRaw} from "vue-router";

const routes: Array<RouteRecordRaw> = [
  {
    name: 'HomePage',
    path: '/',
    component: () => import('@/views/HomePage.vue')
  },
  {
    name: 'CatsPage',
    path: '/cats',
    component: () => import('@/views/CatsPage.vue')
  },
  {
    name: 'BreedsPage',
    path: '/breeds',
    component: () => import('@/views/BreedsPage.vue')
  },
  {
    name: 'EditCatPage',
    path: '/editCat/:id',
    component: () => import('@/views/EditCatPage.vue')
  },
  {
    name: 'EditBreedPage',
    path: '/editBreed/:id',
    component: () => import('@/views/EditBreedPage.vue')
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router
