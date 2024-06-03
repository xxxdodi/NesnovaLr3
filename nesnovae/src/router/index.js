import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/subjects',
    name: 'Subjects',
    component: () => import('@/views/SubjectsPage.vue')
  },
  {
    path: '/teachers',
    name: 'Teachers',
    component: () => import('@/views/TeachersPage.vue'),
  },
  {
    path: '/teachers/1',
    name: 'SubjectsFiltred',
    component: () => import('@/views/SubjectsFiltredPage.vue')
  },
  {
    path: '/subject-edit/:id?',
    name: 'SubjectEdit',
    props: (route) => {
      return {
        id: route.params.id,
      }
    },
    component: () => import('@/views/SubjectEdit.vue'),
  },
  {
    path: '/teachers/1-edit/:id?',
    name: 'SubjectFiltredEdit',
    props: (route) => {
      return {
        id: route.params.id,
      }
    },
    component: () => import('@/views/SubjectFiltredEdit.vue'),
  },
  {
    path: '/teacher-edit/:id?',
    name: 'TeacherEdit',
    props: (route) => {
      return {
        id: route.params.id,
      }
    },
    component: () => import('@/views/TeacherEdit.vue'),
  },
  {
    path: '/:catchAll(.*)',
    name: 'NotFound',
    component: () => import('@/views/SubjectsPage.vue'),
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
