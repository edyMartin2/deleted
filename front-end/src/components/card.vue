<template>
  <v-card class="mx-auto" max-width="100%">
    <v-card-text>
      <div>{{ name }}</div>
      <p class="display-1 text--primary">
        {{ propsData.id_park }}
      </p>
      <h3 v-if="propsData.name">{{ propsData.name }}</h3>
    </v-card-text>
    <v-card-actions>
      <v-btn
        text
        color="teal accent-4"
        @click="reveal = true"
        v-if="activeView"
      >
        <v-icon>mdi-eye</v-icon>
      </v-btn>
      <v-btn text color="red" @click="reveal = true" v-if="del">

        <v-icon @click="deleteNave(propsData.id)"> mdi-delete</v-icon>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>
<script>
import Swal from "sweetalert2";
import axios from "axios";
export default {
  data: () => ({
    reveal: false,
  }),
  props: ["propsData", "activeView", "name", "del"],
  methods: {
    deleteNave(id) {
      var data = new URLSearchParams();
      data.append("type", "i");
      data.append("table", "n");
      data.append("id", id);
      axios
        .post(`${this.$store.state.url}/activeinactive`, data)
        .then((res) => {
          Swal.fire({
            icon: "success",
            title: "Listo",
            text: res.data.message,
            backdrop: `
                  rgba(0,0,0,.01)
                  url("/images/nyan-cat.gif")
                  left top
                  no-repeat
                `,
          });
        })
        .catch((e) => console.log(e));
    },
  },
};
</script>
<style>
.v-card--reveal {
  bottom: 0;
  opacity: 1 !important;
  position: absolute;
  width: 100%;
}
</style>
