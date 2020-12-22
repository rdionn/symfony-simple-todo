module.exports = [
  {
    path: '/',
    component: () => import('./index.vue')
  },
  {
    path: '/create-todo',
    component: () => import('./createTodo.vue')
  }
]
