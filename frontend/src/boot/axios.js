
import Vue from 'vue'
import axios from 'axios'
import { Notify } from 'quasar'
// import router from '../router'

export default ({ store, router }) => {
  const axiosInstance = axios.create({
    baseURL: 'http://127.0.0.1:8000/api/'
  })

  axiosInstance.interceptors.request.use((config) => {
    config.headers['Content-Type'] = 'application/json'
    config.headers.Accept = 'application/json'
    config.headers.Authorization = `Bearer ${store.getters.getToken}`
    // store.commit('abriConexao')
    return config
  }, (error) => {
    // store.commit('fecharConexao')
    return Promise.reject(error)
  })

  axiosInstance.interceptors.response.use(response => {
    // store.commit('fecharConexao')
    return response
  }, error => {
    var mensagemGeral = ''

    if (error.response.status === undefined) {
      Notify.create({
        type: 'negative',
        timeout: 3000,
        position: 'top',
        message: 'Problema de conexão com o servidor'
      })
    }
    switch (error.response.status) {
      case 401:
        Notify.create({
          type: 'negative',
          timeout: 3000,
          position: 'top',
          message: error.response.data.error
        })
        if (!error.response.request.responseURL.includes('api/logar')) { router.push('/login') }
        break

      case 403:
        Notify.create({
          type: 'negative',
          timeout: 3000,
          position: 'top',
          message: error.response.data.error
        })
        router.push('/login')
        break

      case 404:
        Notify.create({
          type: 'negative',
          timeout: 3000,
          position: 'top',
          message: 'Rota inexistente no servidor'
        })
        router.push('/')
        break

      case 406:
        Notify.create({
          type: 'negative',
          timeout: 3000,
          position: 'top',
          message: error.response.data.error
        })
        break

      case 422:
        if (error.response.data.message !== undefined) {
          mensagemGeral = error.response.data.message
        } else if (error.response.data.error !== undefined) {
          mensagemGeral = error.response.data.error
        } else {
          mensagemGeral = error.response.data
        }
        console.log(error.response.data)
        Notify.create({
          type: 'negative',
          timeout: 3000,
          position: 'top',
          message: mensagemGeral,
          html: true
        })
        break

      case 423:
        Notify.create({
          type: 'negative',
          timeout: 3000,
          position: 'top',
          message: error.response.data.message
        })
        break
      case 500:
        console.log('erro 500')
        Notify.create({
          type: 'negative',
          timeout: 3000,
          position: 'top',
          message: 'Erro no servidor de aplicação'
        })
        if (process.env.DEV === false) {
          router.push('/')
        }
        break
    }
    store.commit('fecharConexao')
    return Promise.reject(error)
  })

  Vue.prototype.$axios = axiosInstance
  store.$axios = axiosInstance
  return { axiosInstance }
}
