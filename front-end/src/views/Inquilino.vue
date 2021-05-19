<template>
  <v-container-fluid>
    <v-row>
      <v-col cols="2">
        <v-app>
          <!--Dashboard admin y no admin logica dentro de ese componente-->
          <dashboard :user_type="userType"/>
        </v-app>
      </v-col>
      <v-col cols="10">
        <v-cotainer>
          <v-row>
            <v-col v-for="i in 10" :key="i" cols="3" class="my-3 px-3">
              <v-card class="mx-auto" max-width="100%">
                <v-card-text>
                  <p>{{ i }}</p>
                  <p>{{ i }}</p>
                </v-card-text>
                <v-card-actions>
                  <v-btn icon color="blue" @click="add(i.id)">
                    <v-icon>
                      mdi-thumb-up-outline
                    </v-icon>
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-col>
          </v-row>
        </v-cotainer>
      </v-col>
    </v-row>
  </v-container-fluid>
</template>

<script>
import VueCookies from "vue-cookies";
import dashboard from "../components/sideBar";
var CryptoJS = require("crypto-js");
export default {
  name: "Inquilino",
  data(){
    return{
      userType:null
    }
  },
  beforeMount() {
    var type = CryptoJS.AES.decrypt(VueCookies.get("user_type"), "ampip");
    this.userType = type.toString(CryptoJS.enc.Utf8);
  },
  components:{
    dashboard
  }
}
</script>

<style scoped>

</style>