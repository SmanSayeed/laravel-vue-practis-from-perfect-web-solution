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
                color="error"
                dark
                flat
              >
                <v-toolbar-title>Login form</v-toolbar-title>
                <v-spacer />
                
              </v-toolbar>
              <v-card-text>
                  <v-progress-linear
                    :active="loading"
                    :indeterminate="loading"
                    absolute
                    top
                    color="white accent-4"
                  ></v-progress-linear>
                <v-form

                  ref="form"
                  v-model="valid"
                
                 
                
                >
                  <v-text-field
                  
                    name="login"
                    v-model="email"
                    :rules="emailRules"
                    label="E-mail"
                    required
                    prepend-icon="mdi-account-circle-outline"
                    type="email"
                  />

                  <v-text-field
                    id="password"
                    label="Password"
                    name="password"
                    v-model="password"
                    prepend-icon="mdi-account-lock-outline"
                    type="password"
                     :rules="passwordRules"
                     required
                  />
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer />
                <v-btn color="error" @click="login"
                     :disabled="!valid"
                >Login</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>


                      <v-snackbar
                          v-model="snackbar"
                        >
                          {{ text }}
                          <v-btn
                            color="pink"
                            text
                            @click="snackbar = false"
                          >
                            Close
                          </v-btn>
                     </v-snackbar>


        </v-row>
      </v-container>
    </v-content>
  </v-app>

</template>
<script>
export default{}
</script>


<script>
  export default{
    data(){
      return {
        
        valid: true,
        emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
         passwordRules: [
        v => !!v || 'Password is required',
      
      ],

        email:'',
        password:'',
        loading:false,
        snackbar:false,
        text:''

      }
    },
    created(){
      this.$vuetify.theme.dark = true;
    }, 
    methods:{
      login: function(){



                // Add a request interceptor
        axios.interceptors.request.use((config) => {

           this.loading = true;
            return config;

          },  (error) => {
            this.loading = false;
            return Promise.reject(error);
          });

        // Add a response interceptor
        axios.interceptors.response.use((response) => {
           this.loading = false;
            return response;
          },  (error) => {
           this.loading = false
            return Promise.reject(error);
          });
          axios.post('api/login',
              {
                'email':this.email,
                'password':this.password
              })
          .then(res=>{

              //console.dir(res)
              //console.log(res.data.token)

              localStorage.setItem('token',res.data.token);
              localStorage.setItem('loggedIn',true);
              
              
              this.$router.push('/admin')
                .then(res=> console.log("logged in Successfully"))
                .catch( err => console.log(err))


          }).catch(err => {

              this.text = err.response.data.status;
              this.snackbar  = true;

          })

      }
    }
    
  }
</script>

<style scoped></style>
