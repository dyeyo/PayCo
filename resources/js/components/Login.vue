<template>
  <v-app id="inspire">
    <v-content>
      <v-container
        class="fill-height"
        fluid
      >
        <v-row
          align="center"
          justify="center"
        >
          <v-col
            cols="12"
            sm="8"
            md="4"
          >
            <v-card class="elevation-12">
              <v-toolbar
                color="primary"
                dark
                flat
              >
                <v-toolbar-title>Login form</v-toolbar-title>
                <v-spacer />
               
              </v-toolbar>
              <v-card-text>
                <v-form>
                  <v-text-field
                    label="Login"
                    name="login"
                    prepend-icon="person"
                    type="text"
                    v-model="loginDetails.email"
                    :rules="[() => loginDetails.email || 'This field is required']"
                    autofocus
                  />

                  <v-text-field
                    id="password"
                    label="Password"
                    name="password"
                    prepend-icon="lock"
                    type="password"
                    v-model="loginDetails.password"
                  />
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer />
                <v-btn color="primary" @click="loginPost">Login</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>

  import axios from 'axios';

  export default {
    props: {
      source: String,
    },
    data: () =>({
      
      //return {
        loginDetails: {
            email: '',
            password: '',
            remember: true,
        },
        errorsEmail: false,
        errorsPassword: false,
        emailError: null,
        passwordError: null

      //} 
    }),
    methods:{

      // Metodo Login
      loginPost(){

        let url = '/login';

        axios.post(url, this.loginDetails)
        .then( (response) => {

          window.location.href="/home";

        })
        .catch( (error) => {
          
          let errors = error.response;
          console.log(errors)

          if(errors.statusText === 'Unprocessable Entity' || error.status === 422){

            if(errors.data){

              if(errors.data.email){
                this.errorsEmail = true;
                this.emailError = _.isArray(errors.data.email) ? errors.data.email[0] : errors.data.email;
              }

              if(errors.data.password){
                this.errorsPassword = true;
                this.passwordError = _.isArray(errors.data.password) ? errors.data.password[0] : errors.data.password;
              }

            }

          }

        })


      },
      // Fin Login

    },
    mounted() {
        console.log('')
    }



  }
</script>