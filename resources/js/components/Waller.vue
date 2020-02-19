<template>
  <v-app id="app">
    <v-data-table
            :headers="headers"
            :items="waller"
            :items-per-page="5"
            :search="search"
            sort-by="name"
            class="elevation-1">
      <template v-slot:top>
        <v-toolbar flat color="white">
          <v-toolbar-title>
            <v-text-field
                    v-model="search"
                    append-icon="search"
                    label="Busqueda"
                    single-line
                    hide-details>
            </v-text-field>
          </v-toolbar-title>
          <v-divider
                  class="mx-4"
                  inset
                  vertical>
          </v-divider>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="500px">
            <template v-slot:activator="{ on }">
              <v-btn color="primary" dark class="mb-2" v-on="on">Recargar Billetera</v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="headline" v-text="formTitle"></span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12">
                      <v-text-field v-model="editedItem.docuement"
                                  :rules="[rules.required]"
                                  label="Numero de Documento"></v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-text-field v-model="editedItem.name"
                                  :rules="[rules.required, rules.min]"
                                  label="Nombre Completo"></v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-text-field v-model="editedItem.dinner"
                                  :rules="[rules.required]"
                                  label="Dinero/Cantidad"></v-text-field>
                    </v-col>
                    <v-col class="d-flex" cols="12">
                      <v-select
                        v-model="editedItem.id_cliente"
                        :items="clientes"
                        item-text="docuement"
                        item-value="id"
                        label="Seleccionar Usurio"></v-select>
                      </v-col>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close">Cancelar</v-btn>
                <v-btn color="blue darken-1" text @click="save">Guardar</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:item.action="{ item }">

        <v-icon
                small
                class="mr-2"
                @click="editItem(item)">
          add
        </v-icon>
        <v-icon
                small
                @click="deleteItem(item)">
          delete
        </v-icon>
      </template>
    </v-data-table>
  </v-app>
</template>

<script>
    import axios from 'axios';
    export default {
        data: () => ({
            dialog: false,
            search: '',
            headers: [
                {text: 'Nombre (Username)', value: 'name',},
                { text: 'N° de Documento', value: 'docuement' },
                { text: 'Valor', value: 'dinner' },
                { text: 'Acciones', value: 'action' },
            ],
            waller: [],
            editedIndex: -1,
            editedItem: {
                dinner:''
            },
            defaultItem: {
              name: '',
              docuement: '',
              id_cliente: '',
              dinner:''
            },
            clientes:[],
            rules: {
                required: value => !!value || 'Este Campo es requerido..',
            },
        }),

        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'Recargar Billetera' : 'Recargar Billetera'
            },
        },

        watch: {
            dialog (val) {
                val || this.close()
            },
        },

        created () {
            this.initialize();
            this.getClientes();
        },

        methods: {
            initialize ()  {
                let url = '/api/billetera';
                axios.get(url)
                    .then( (response) => {
                        let res = response.data;
                        console.log(res);
                        this.waller = res.dinner;
                    })
                    .catch( (error) => {
                        console.log(error);
                    })
            },
            save () {
                let id = this.editedItem.id;
                let url =  '/api/billetera/update/'+id;
                let route = '/api/billetera/register';
                if (this.editedIndex > -1) {
                    axios.put(url, {
                      'dinner': this.editedItem.dinner
                    })
                    .then( (response) => {
                        Object.assign(this.desserts[this.editedIndex], this.editedItem);
                        swal({
                            icon: 'success',
                            title: "¡¡Felicidades!!",
                            text: "Has recargado tu billetera con exito",
                            type: "success",
                        });
                        this.close()
                    })
                    .catch( (error) => {
                        console.log(error);
                        swal({
                            icon: 'error',
                            title: "Ocurrio un error",
                            text: "Lo sentimos algo salio mal, volvamos a intentarlo!",
                            type: "danger",
                        });
                        this.close()
                    })
                }else {
                    axios.post(route, {
                        'docuement': this.editedItem.docuement,
                        'name': this.editedItem.name,
                        'id_cliente': this.editedItem.id_cliente,
                        'dinner': this.editedItem.dinner
                    })
                        .then((response) => {
                            this.initialize();
                            swal({
                                icon: 'success',
                                title: "¡¡Felicidades!!",
                                text: "Has recargado tu billetera con exito",
                                type: "success",
                            });
                            this.close()
                        })
                        .catch((error) => {
                            swal({
                                icon: 'error',
                                title: "Ocurrio un error",
                                text: "Lo sentimos algo salio mal, volvamos a intentarlo!",
                                type: "danger",
                            });
                            this.close()
                        })
                }

            },

            getClientes(){
                let urls = '/api/getClientes';
                axios.get(urls).then( (response) => {
                    console.log(response.data.waller);
                    this.clientes=response.data.waller;
                })
                .catch( (error) => {
                    this.close()
                })
            },
            editItem (item){
                this.editedIndex = this.waller.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },

            deleteItem (item){
                const index = this.waller.indexOf(item)
                let conf = confirm('Desea eliminar este elemento?');
                let id = item.id;
                let url = '/api/billetera/delete/'+id;

                if(conf){
                    axios.delete(url)
                        .then( (response) => {
                            this.waller.splice(index, 1)
                        })
                        .catch( (error) => {
                            console.error(error);
                        })
                }
            },

            close () {
                this.dialog = false
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                }, 300)
            },


        },
    }
</script>