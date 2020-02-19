<template>
    <v-app>
        <v-navigation-drawer v-model="drawer" permanent :mini-variant.sync="mini" app>
            <v-list-item>
                <v-list-item-avatar>
                <v-img src="https://randomuser.me/api/portraits/men/78.jpg"></v-img>
                </v-list-item-avatar>
                <v-list-item-content>
                <v-list-item-title>John Leider</v-list-item-title>
                </v-list-item-content>
            </v-list-item>

            <v-divider></v-divider>

            <v-list dense>
                <v-list-item link >
                    <v-list-item-icon>
                        <v-icon>ballot</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            <router-link :to="{name: 'tables'}" v-text="table"></router-link>
                        </v-list-item-title>
                    </v-list-item-content>

                </v-list-item>
                
                <v-list-item link router>
                    <v-list-item-icon>
                        <v-icon>gamepad</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            <router-link :to="{name: 'billetera'}" v-text="billetera"></router-link>
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar app class="primary">
            <v-app-bar-nav-icon class="white--text" @click="mini = !mini"></v-app-bar-nav-icon>
            <v-toolbar-title>
                <router-link class="white--text" :to="{name: 'dashboard'}" v-text="dashboard"></router-link>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-menu bottom left>
                <template v-slot:activator="{ on }">
                <v-btn
                    dark
                    icon
                    v-on="on">
                    <v-icon>mdi-dots-vertical</v-icon>
                </v-btn>
                </template>
                <v-list>
                    <v-list-item >
                        <v-list-item-title><v-icon left>person</v-icon>Perfil</v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="logout()">
                        <v-list-item-title><v-icon left>exit_to_app</v-icon>Salir</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
        </v-app-bar>

        <v-content>
            <v-container fluid>
                <router-view></router-view>
            </v-container>
        </v-content>

        <v-footer
            color="primary"
            padless>
            <v-row
            justify="center"
            no-gutters>
            <v-btn
                v-for="link in links"
                :key="link"
                color="white"
                text
                rounded
                class="my-2">
                {{ link }}
            </v-btn>
            <v-col
                class="primary lighten-2 py-4 text-center white--text"
                cols="12">
                {{ new Date().getFullYear() }} — <strong>Vuetify</strong>
            </v-col>
            </v-row>
        </v-footer>
    </v-app>
</template>


<script>

  import axios from 'axios';

  export default {
    data: () => ({
        table: 'Table',
        billetera: 'Billetera',
        dashboard: 'Dashboard',
        drawer: null,
        mini: false
    }),

    methods:{

        logout (){
            let url = '/logout';
            axios.post(url)
            .then( (response) => {
                window.location.href="/";
                // location.reload();
            })
            .catch( (error) => {
                console.log(error);
            })
        },
    },
  
  };
</script>