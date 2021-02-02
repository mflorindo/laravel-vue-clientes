export default {
  state: {
    executeAxios: false
  },
  mutations: {

    abrirConexao (state) {
      state.executeAxios = true
    },
    fecharConexao (state) {
      state.executeAxios = false
    }

  },
  actions: {
    logout (context) {
      context.commit('logout')
    }

  },
  getters: {
    isExecuteAxios: state => {
      return state.executeAxios
    }
  }
}
