<template>
  <q-page>
    <div class="row q-col-glutter-sm">
      <div class="col-md-3 col-sm-12 col-xs-12">
        <q-item>
          <q-item-section
            avatar
            middle
            style="background-color:rgb(62, 81, 181)"
            class="q-pa-md"
          >
            <q-icon name="supervisor_account" color="white" size="50px" />
          </q-item-section>
          <q-item-section top style="background-color:#5064B5">
            <q-item-label
              class="q-mt-md q-ml-md  text-weight-medium text-white text-uppercase"
            >
              <span class="cursor-pointer">Clientes</span>
            </q-item-label>
            <q-item-label
              class="q-mt-md q-ml-md text-weight-bolder text-white"
              style="margin-top:15px;"
            >
              <span class="cursor-pointer" style="font-size:30px">{{
                numeroClientes
              }}</span>
            </q-item-label>
          </q-item-section>
        </q-item>
      </div>

      <div class="col-md-3 col-sm-12 col-xs-12">
        <q-item>
          <q-item-section
            avatar
            middle
            style="background-color:#F34636"
            class="q-pa-md"
          >
            <q-icon name="location_on" color="white" size="50px" />
          </q-item-section>
          <q-item-section top style="background-color:#F37169">
            <q-item-label
              class="q-mt-md q-ml-md  text-weight-medium text-white text-uppercase"
            >
              <span class="cursor-pointer">Cidades</span>
            </q-item-label>
            <q-item-label
              class="q-mt-md q-ml-md text-weight-bolder text-white"
              style="margin-top:15px;"
            >
              <span class="cursor-pointer" style="font-size:30px">{{
                numeroCidades
              }}</span>
            </q-item-label>
          </q-item-section>
        </q-item>
      </div>

      <div class="col-md-3 col-sm-12 col-xs-12">
        <q-item>
          <q-item-section
            avatar
            middle
            style="background-color:#EA4B64 "
            class="q-pa-md"
          >
            <q-icon name="assignment" color="white" size="50px" />
          </q-item-section>
          <q-item-section top style="background-color:#EA6A7F">
            <q-item-label
              class="q-mt-md q-ml-md  text-weight-medium text-white text-uppercase"
            >
              <span class="cursor-pointer">Solicitações de Cadastros</span>
            </q-item-label>
            <q-item-label
              class="q-mt-md q-ml-md text-weight-bolder text-white"
              style="margin-top:15px;"
            >
              <span class="cursor-pointer" style="font-size:30px">1.300</span>
            </q-item-label>
          </q-item-section>
        </q-item>
      </div>

      <div class="col-md-3 col-sm-12 col-xs-12">
        <q-item>
          <q-item-section
            avatar
            middle
            style="background-color:#9F52B1"
            class="q-pa-md"
          >
            <q-icon name="send" color="white" size="50px" />
          </q-item-section>
          <q-item-section top style="background-color:#A270B1 ">
            <q-item-label
              class="q-mt-md q-ml-md  text-weight-medium text-white text-uppercase"
            >
              <span class="cursor-pointer">Email Disparados</span>
            </q-item-label>
            <q-item-label
              class="q-mt-md q-ml-md text-weight-bolder text-white"
              style="margin-top:15px;"
            >
              <span class="cursor-pointer" style="font-size:30px">3.400</span>
            </q-item-label>
          </q-item-section>
        </q-item>
      </div>
    </div>

    <div class="row q-col-glutter-sm">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <q-item>
          <q-item-section>
            <q-card class="my-card" style="width:100%;background:#1976D2">
              <q-card-section>
                <div class="text-h6 text-white">Lista de Tarefas</div>
                <div class="text-subtitle2 text-white">01/02/2021</div>
              </q-card-section>

              <q-card-section>
                <q-card class="my-card" style="width:100%">
                  <q-card-section>
                    <div class="row">
                      <div class="col-10" text-center>
                        <q-icon name="report_problem" size="40px" color="red" />
                        Entrar em contato com Carlos para resolver problemas de
                        email
                      </div>
                      <div class="col-2">
                        <q-checkbox left-label label="" />
                      </div>
                    </div>
                  </q-card-section>

                  <q-card-section>
                    <div class="row">
                      <div class="col-10" text-center>
                        <q-icon
                          name="report_problem"
                          size="40px"
                          color="green"
                          v-model="checkbox1"
                        />
                        Cliente solicita reenvio da mercadoria com urgência
                      </div>
                      <div class="col-2">
                        <q-checkbox left-label label="" v-model="checkbox2" />
                      </div>
                    </div>
                  </q-card-section>
                </q-card>
              </q-card-section>
            </q-card>
          </q-item-section>
        </q-item>
      </div>
    </div>
  </q-page>
</template>

<script>
export default {
  name: 'PageIndex',
  data () {
    return {
      numeroClientes: 0,
      numeroCidades: 0,
      date: '2021-02-01',
      checkbox1: 0,
      checkbox2: true
    }
  },
  mounted () {
    this.$axios.get('dashboard').then(response => {
      this.numeroClientes = response.data.clientes
      this.numeroCidades = response.data.cidades
    })
  }
}
</script>
