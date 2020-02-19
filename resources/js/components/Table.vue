<template>
  <v-app id="app">
    <v-data-table
        :headers="headers"
        :items="desserts"
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
            <v-btn color="primary" dark class="mb-2" v-on="on">Nuevo Cliente</v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline" v-text="formTitle"></span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12">
                    <v-text-field v-model="editedItem.docuement" label="Numero de Documento"></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field v-model="editedItem.name" label="Nombre Completo"></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field v-model="editedItem.email" label="Email"></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field v-model="editedItem.phone" label="Celular/Telefono"></v-text-field>
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
      edit
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
        {
          text: 'Nombre (Username)',
          align: 'left',
          sortable: false,
          value: 'name',
        },
        { text: 'N° de Documento', value: 'docuement' },
        { text: 'Email', value: 'email' },
        { text: 'Celular', value: 'phone'},
        { text: 'Acciones', value: 'action' },
      ],
      desserts: [],
      editedIndex: -1,
      editedItem: {
        name: '',
        email: '',
        docuement: '',
        phone: ''
      },
      defaultItem: {
        name: '',
        email: '',
        docuement: '',
        phone: ''
      },
      mensaje:false
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Nuevo Cliente' : 'Editar Cliente'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
    },

    created () {
      this.initialize()
    },

    methods: {
      initialize ()  {
        let url = '/api/client';
        axios.get(url)
        .then( (response) => {
          let answer = response.data;
          console.log(answer);
          this.desserts = answer.clients;
        })
        .catch( (error) => {
          console.log(error);
        })
      },
      save () {
        let id = this.editedItem.id;
        let url =  '/api/client/update/'+id;
        let route = '/api/client/register';

        if (this.editedIndex > -1) {
          axios.put(url, {
            'docuement': this.editedItem.docuement,
            'name': this.editedItem.name,
            'email': this.editedItem.email,
            'phone': this.editedItem.phone,
          })
            .then( (response) => {
                Object.assign(this.desserts[this.editedIndex], this.editedItem)
                this.close()
            })
            .catch( (error) => {
                this.close()
            })
        }else {
          axios.post(route, {
            'docuement': this.editedItem.docuement,
            'name': this.editedItem.name,
            'email': this.editedItem.email,
            'phone': this.editedItem.phone,
          })
          .then( (response) => {
              this.initialize();
              this.close()
          })
          .catch( (error) => {
              this.close()
          })
        }
      },

      editItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        const index = this.desserts.indexOf(item)
        let conf = confirm('Desea eliminar este elemento?');
        let id = item.id;
        let url = '/api/client/delete/'+id;

        if(conf){
          axios.delete(url)
          .then( (response) => {
            this.desserts.splice(index, 1)
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