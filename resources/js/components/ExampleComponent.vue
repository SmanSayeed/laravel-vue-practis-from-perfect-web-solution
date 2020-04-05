<template>

<div>
  <v-container>
    <v-alert type="info">I am Saad</v-alert>
    <v-btn link to="/foo">Load foo</v-btn>
    <v-btn link to="/bar">Load bar</v-btn>
     <v-btn link to="/user/saad">Load user</v-btn>
    
  </v-container>

    <v-content>
        <router-view></router-view>
    </v-content>

</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
