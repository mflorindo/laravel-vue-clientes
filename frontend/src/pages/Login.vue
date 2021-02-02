<template>
  <q-page
    class="window-height window-width row justify-center items-center fundo-tela"
  >
    <div class="column">
      <q-form @submit="onSubmit" class="q-gutter-md">
        <div class="row">
          <q-card square bordered class="q-pa-lg shadow-1">
            <q-card-section>
              <div class="row  justify-center q-pb-md">
                <q-img src="~assets/logo.png" width="50%" class="text-center" />
              </div>
              <q-form class="q-gutter-md">
                <q-input
                  square
                  filled
                  clearable
                  v-model="email"
                  type="email"
                  label="Email"
                  lazy-rules
                  :rules="[
                    v => !!v || 'O email é obrigatório',
                    v => /.+@.+\..+/.test(v) || 'Email inválido'
                  ]"
                />
                <q-input
                  square
                  filled
                  clearable
                  v-model="password"
                  type="password"
                  label="Senha"
                  lazy-rules
                  :rules="[v => !!v || 'A senha é obrigatório']"
                />
              </q-form>
            </q-card-section>
            <q-card-actions class="q-px-md">
              <q-btn
                unelevated
                color="blue"
                size="lg"
                class="full-width"
                type="submit"
                label="Login "
                :loading="enviando"
              />
            </q-card-actions>
          </q-card>
        </div>
      </q-form>
    </div>
  </q-page>
</template>

<script>
export default {
  name: 'Login',
  data () {
    return {
      email: '',
      password: '',
      token: this.$store.getters.obterToken,
      enviando: false,
      persistirFormularioNovaSenha: false
    }
  },

  methods: {
    onSubmit () {
      this.logar()
    },
    async logar () {
      try {
        this.enviando = true
        const response = await this.$axios.post('auth/login', {
          email: this.email,
          password: this.password
        })

        const dados = []

        dados.token = response.data.access_token
        this.$store.commit('registrarToken', dados)
        this.$router.push('/')
        this.enviando = false
      } catch (error) {
        this.enviando = false
      }
    },
    novaSenha () {
      this.persistirFormularioNovaSenha = true
    }
  },
  mounted () {
    this.$store.commit('zerarAcesso')
  }
}
</script>

<style>
.q-card {
  width: 360px;
}

.fundo-tela {
  background: url("~assets/fundo.jpg");
  background-size: cover;
}
</style>
