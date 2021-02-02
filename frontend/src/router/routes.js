const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/Index.vue'), meta: { requiresAuth: true } },
      { path: '/clientes', component: () => import('pages/ClienteConsulta.vue'), meta: { requiresAuth: true } }
    ]
  },

  {
    path: '/login',
    name: 'login',
    component: () => import('layouts/LoginLayout.vue'),
    children: [{ path: '', component: () => import('pages/Login.vue') }]
  },
  // Always leave this as last one,
  // but you can also remove it
  {
    path: '*',
    component: () => import('pages/Error404.vue')
  }
]

export default routes
