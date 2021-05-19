<template>
  <v-navigation-drawer class="_cont_aside" dark permanent>
      <v-img
      class="_img_ampip"
        lazy-src="../assets/logo_ampip.svg"
        max-height="150"
        max-width="250"
        src="../assets/logo_ampip.svg"
        ></v-img>
    <v-list style="" v-if="user_type == 'Administrator'">
      <v-list-item
        v-for="item in itemsadmin"
        :key="item.title"
        link
        class="text-align: left;"
        @click="goto(item.title)"
      >
        <v-list-item-icon>
          <v-icon>{{ item.icon }}</v-icon>
        </v-list-item-icon>

        <v-list-item-content>
          <v-list-item-title>{{ item.title }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>

    <v-list style="" v-if="user_type == null">
      <p>Aun no se te asigna un rol</p>
    </v-list>

    <v-list style="" v-if="user_type != 'Administrator' && user_type != null">
      <v-list-item
        v-for="item in items"
        :key="item.title"
        link
        class="text-align: left;"
        @click="goto(item.title)"
      >
        <v-list-item-icon>
          <v-icon>{{ item.icon }}</v-icon>
        </v-list-item-icon>

        <v-list-item-content>
          <v-list-item-title>{{ item.title }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>

    <template v-slot:append>
      <div class="pa-2">
        <v-btn block @click="logout">
          Cerrar Sesión
        </v-btn>
      </div>
    </template>
  </v-navigation-drawer>
</template>
<script>
import VueCookies from "vue-cookies";
var CryptoJS = require("crypto-js");
export default {
  data() {
    return {
      items: [
        { title: "Perfil", icon: "mdi-account" },
        { title: "parques", icon: "mdi-bank" },
        { title: "Naves", icon: " mdi-factory" },
      ],
      itemsadmin:[
        { title: "Perfil", icon: "mdi-account" },
        { title: "Corporativos", icon: " mdi-factory" },
        { title:"Usuarios", icon:"mdi-account"},
        { title: "parques", icon: "mdi-bank" },
        { title: "Naves", icon: " mdi-factory" },
      ],
      name: "null",
      email: "",
      id: "",
      datas: "",
      adminDash: false,
    };
  },
  methods: {
    logout() {
      VueCookies.remove("user_type");
      VueCookies.remove("id");
      VueCookies.remove("name");
      VueCookies.remove("email");
      VueCookies.remove("key_corp");
      this.$router.push("/");
    },
    goto(go) {
      if (go === "Perfil") {
        this.$router.push("/");
      } else {
        this.$router.push(go);
      }
    },
  },
  beforeMount() {
    this.id = CryptoJS.AES.decrypt(VueCookies.get("id"), "ampip");
    this.name = CryptoJS.AES.decrypt(VueCookies.get("name"), "ampip");
    this.email = CryptoJS.AES.decrypt(VueCookies.get("email"), "ampip");

    this.id = this.id.toString(CryptoJS.enc.Utf8);
    this.email = this.email.toString(CryptoJS.enc.Utf8);
    this.name = this.name.toString(CryptoJS.enc.Utf8);
  },
  props:['user_type'],
};
</script>
<style lang=""></style>
