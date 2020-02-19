<template>
    <v-app>
        <div>
            <v-app-bar app class="primary">
                <v-app-bar-nav-icon @click="drawer = !drawer "></v-app-bar-nav-icon>

                <v-toolbar-title >Page title</v-toolbar-title>

                <v-spacer></v-spacer>
                <v-btn small class="ma-2" color="success">Ingresar</v-btn>
                <v-btn small class="ma-2" color="error">Salir</v-btn>
            </v-app-bar>

            <v-navigation-drawer
                v-model="drawer"
                absolute
                temporary
                app
                >
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

                    <v-list-item
                    v-for="item in items"
                    :key="item.title"
                    link
                    >
                    <v-list-item-icon>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item-content>
                    </v-list-item>
                </v-list>
            </v-navigation-drawer>

            <v-content>
                <home-component></home-component>
            </v-content>

        </div>
    </v-app>
</template>


<script>
import HomeComponent from './Home.vue';

  export default {
    data () {
      return {
        drawer: null,
        items: [
          { title: 'Home', icon: 'dashboard' },
          { title: 'About', icon: 'question_answer' },
        ],
      }
    },
    components: {
            HomeComponent
        },
  };
</script>