export default {
  state: {
    isAuthenticated: false,
    token: null
  },
  mutations: {
    registrarToken (state, dados) {
      state.token = dados.token
      state.isAuthenticated = true
    },
    logout (state) {
      state.isAuthenticated = false
      state.token = null
    },
    token (state, valor) {
      state.token = valor
    },
    abreConexao (state, value) {
      state.executeAxios = value
    },
    zerarAcesso (state) {
      state.isAuthenticated = false
      state.token = null
    }

  },
  actions: {
    logout (context) {
      context.commit('logout')
    }

  },
  getters: {
    isAuthenticated: state => {
      return state.isAuthenticated
    },
    isTokenExist: state => {
      return (state.token !== null)
    },
    getToken: state => {
      return state.token
    }
  }
}
