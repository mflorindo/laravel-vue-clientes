<template>
  <q-page>
    <q-dialog v-model="__persistir" persistent>
      <q-card class="my-card" style="width:500px">
        <q-form @submit="onSubmit" class="q-gutter-md">
          <q-card-section horizontal class="q-pa-md">
            <span class="text-h4">Manutenção de Clientes</span>
          </q-card-section>
          <q-card-section>
            <div class="row">
              <div class=" col-12 col-md-12">
                <q-input
                  label="Nome do Cliente"
                  v-model="nome"
                  ref="nomeCliente"
                  lazy-rules
                  :rules="[v => !!v || 'O nome é obrigatório']"
                />
              </div>
              <div class="col-md-12 col-12">
                <q-select
                  name="cidade"
                  v-model="cidade"
                  :options="listaCidades"
                  label="Cidade"
                  @filter="filterFn"
                  dense
                  emit-value
                  map-options
                  option-label="nome"
                  option-value="codigo"
                  :rules="[val => !!val || 'Campo obrigatório']"
                  lazy-rules
                  use-input
                  input-debounce="0"
                >
                  <template v-slot:no-option>
                    <q-item>
                      <q-item-section class="text-grey">
                        Dados não localizados
                      </q-item-section>
                    </q-item>
                  </template>
                </q-select>
              </div>
            </div>
          </q-card-section>
          <hr />
          <q-card-section>
            <div class="q-pa-md q-gutter-sm">
              <q-btn color="primary" label="Salvar" type="submit" />
              <q-btn
                color="grey"
                label="Cancelar"
                @click="__persistir = false"
              />
            </div>
          </q-card-section>
        </q-form>
      </q-card>
    </q-dialog>
  </q-page>
</template>

<script>
export default {
  data () {
    return {
      nome: null,
      cidade: null,
      listaCidades: null
    }
  },
  props: {
    persistir: Boolean,
    codigo: Number
  },

  computed: {
    __persistir: {
      get () {
        return this.persistir
      },
      set (value) {
        this.$emit('update:persistir', value)
      }
    }
  },
  methods: {
    onSubmit () {
      this.salvar()
    },
    salvar () {
      console.log(this.codigo)
      if (this.codigo == null) {
        this.$axios
          .post('clientes', { nome: this.nome, id_cidade: this.cidade.id })
          .then(response => {
            this.$q.notify({
              type: 'positive',
              message: 'Cliente inserido com sucesso',
              position: 'top'
            })
            this.$emit('update')
          })
      } else {
        this.$axios
          .put(`clientes/${this.codigo}`, {
            nome: this.nome,
            id_cidade: this.cidade.id
          })
          .then(response => {
            this.$q.notify({
              type: 'positive',
              message: 'Cliente alterado com sucesso',
              position: 'top'
            })
            this.$emit('update')
          })
      }
    },
    filterFn (val, update) {
      if (val === '') {
        update(() => {
          this.options = this.listaCidades
        })
        return
      }

      update(() => {
        const needle = val.toLowerCase()
        this.$axios.post('cidades', { cidade: needle }).then(response => {
          this.listaCidades = response.data
        })
      })
    }
  },
  async mounted () {
    if (this.codigo !== null) {
      const response = await this.$axios.get(`/clientes/${this.codigo}`)
      this.nome = response.data.data.nome
      this.cidade = response.data.data.cidade
    }
  }
}
</script>
