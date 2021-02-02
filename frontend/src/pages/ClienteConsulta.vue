<template>
  <q-page class="q-pa-md">
    <div class="row">
      <div class="col-12 col-md-12">
        <q-card style="width:100%">
          <q-card-section horizontal class="q-pa-md">
            <span class="text-h4">Consulta de Clientes</span>
            <q-space />
            <q-btn
              color="primary"
              @click="persistirFormularioEdicao = true"
              label="Novo Cliente"
              no-caps
            />
          </q-card-section>
          <q-card-section>
            <q-input filled bottom-slots label="Filtrar" v-model="textoFiltro">
            </q-input>
          </q-card-section>

          <q-card-section>
            <div>
              <q-table
                :data="data"
                :columns="columns"
                row-key="name"
                :filter="filtro"
              >
                <template v-slot:body-cell-cidade="props">
                  <q-td :props="props">
                    {{ props.row.cidade.nome }}
                  </q-td>
                </template>

                <template v-slot:body-cell-acoes="props">
                  <q-td :props="props">
                    <q-btn
                      dense
                      round
                      flat
                      color="green"
                      @click="editRow(props)"
                      icon="edit"
                    ></q-btn>
                    <q-btn
                      dense
                      round
                      flat
                      color="red"
                      @click="deleteRow(props)"
                      icon="delete"
                    ></q-btn>
                  </q-td>
                </template>
              </q-table>
            </div>
          </q-card-section>
        </q-card>
      </div>
    </div>

    <cliente-manutencao
      v-if="persistirFormularioEdicao"
      :persistir.sync="persistirFormularioEdicao"
      :codigo="codigo"
      @update="consultar"
    />
  </q-page>
</template>
<script>
import ClienteManutencao from 'pages/ClienteManutencao.vue'

export default {
  components: {
    ClienteManutencao
  },
  data () {
    return {
      columns: [
        {
          name: 'nome',
          label: 'Nome',
          field: 'nome',
          sortable: true,
          align: 'left'
        },
        {
          name: 'cidade',
          label: 'Cidade',
          field: "cidade['nome']",
          sortable: true,
          align: 'left'
        },
        { name: 'acoes', label: 'Ações', field: 'acoes', align: 'right' }
      ],
      data: [],
      persistirFormularioEdicao: false,
      codigo: null,
      textoFiltro: ''
    }
  },
  methods: {
    abrirFormulario () {
      this.$store.state.dialogoCliente = true
    },
    consultar () {
      this.$axios.get('clientes').then(response => {
        this.data = response.data
        console.log(response.data)
      })
      // aproveitar o mesmo método e reforçar o fechamento do dialog
      this.persistirFormularioEdicao = false
    },
    deleteRow (props) {
      this.$q
        .dialog({
          title: 'Confirmação',
          message: 'Deseja excluir o registro: ' + props.row.nome,
          cancel: true,
          persistent: true
        })
        .onOk(() => {
          this.$axios.delete('/clientes/' + props.row.id).then(reponse => {
            this.consultar()
            this.$q.notify({
              message: 'Cliente excluído com sucesso',
              caption: props.row.razao_social_nome,
              type: 'positive',
              position: 'top'
            })
          })
        })
        .onCancel(() => {})
    },
    editRow (props) {
      this.codigo = null
      this.codigo = props.row.id
      this.persistirFormularioEdicao = true
    },
    executarFiltragem () {

    }
  },
  computed: {
    formulario () {
      return this.$store.state.dialogoCliente
    },
    filtro: function () {
      return this.textoFiltro
    }
  },
  mounted () {
    this.consultar()
  }
}
</script>
