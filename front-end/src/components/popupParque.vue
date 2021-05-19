<template>
  <v-row justify="center">
    <v-dialog
      v-model="dialog"
      fullscreen
      hide-overlay
      transition="dialog-bottom-transition"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn icon v-bind="attrs" v-on="on">
          <v-icon>mdi-eye</v-icon>
        </v-btn>
      </template>
      <v-card>
        <v-toolbar dark color="primary">
          <v-btn icon dark @click="dialog = false">
            <v-icon>mdi-close</v-icon>
          </v-btn>
          <v-toolbar-title
            >{{ datasOfPark.nombre_es }}
            <v-switch
              v-model="updateMode"
              label=" Modo edicion "
              color="primary"
              value="true"
              hide-details
              v-if="edit"
            ></v-switch
          ></v-toolbar-title>
          <v-spacer></v-spacer>
          
        </v-toolbar>
        <v-container-fluid>
          <v-row>
            <v-col cols="11" md="8">
              <v-card class="my-4 mx-4">
                <v-card-text>
                  <v-list style="text-align: left">
                    <v-subheader>Datos del parque</v-subheader>
                    <v-list-item>
                      <v-list-item-icon>
                        <v-icon>mdi-eye</v-icon>
                      </v-list-item-icon>
                      <v-list-item-content>
                        <v-list-item-title
                          >Nombre :{{
                            datasOfPark.nombre_es
                          }}</v-list-item-title
                        >
                        <v-text-field
                          v-if="updateMode == 'true'"
                          v-model="datasOfPark.nombre_es"
                          @change="change"
                        ></v-text-field>
                      </v-list-item-content>
                    </v-list-item>

                    <v-list-item>
                      <v-list-item-icon>
                        <v-icon>mdi-eye</v-icon>
                      </v-list-item-icon>
                      <v-list-item-content>
                        <v-list-item-title
                          >Name :{{ datasOfPark.nombre_en }}</v-list-item-title
                        >
                        <v-text-field
                          v-if="updateMode == 'true'"
                          v-model="datasOfPark.nombre_en"
                        ></v-text-field>
                      </v-list-item-content>
                    </v-list-item>

                    <v-list-item>
                      <v-list-item-icon>
                        <v-icon>mdi-eye</v-icon>
                      </v-list-item-icon>
                      <v-list-item-content>
                        <v-list-item-title
                          >Administradora :{{
                            datasOfPark.adminParq
                          }}</v-list-item-title
                        >
                        <v-text-field
                          v-if="updateMode == 'true'"
                          v-model="datasOfPark.adminParq"
                        ></v-text-field>
                      </v-list-item-content>
                    </v-list-item>

                    <v-list-item>
                      <v-list-item-icon>
                        <v-icon>mdi-eye</v-icon>
                      </v-list-item-icon>
                      <v-list-item-content>
                        <v-list-item-title
                          >Propietario :
                          {{ datasOfPark.parqProp }}</v-list-item-title
                        >
                        <v-text-field
                          v-if="updateMode == 'true'"
                          v-model="datasOfPark.parqProp"
                        ></v-text-field>
                      </v-list-item-content>
                    </v-list-item>

                    <v-list-item>
                      <v-list-item-icon>
                        <v-icon>mdi-eye</v-icon>
                      </v-list-item-icon>
                      <v-list-item-content>
                        <v-list-item-title
                          >Región :{{ datasOfPark.region }}</v-list-item-title
                        >
                        <v-text-field
                          v-if="updateMode == 'true'"
                          v-model="datasOfPark.region"
                        ></v-text-field>
                      </v-list-item-content>
                    </v-list-item>

                    <v-list-item>
                      <v-list-item-icon>
                        <v-icon>mdi-eye</v-icon>
                      </v-list-item-icon>
                      <v-list-item-content>
                        <v-list-item-title
                          >Mercado :{{ datasOfPark.mercado }}</v-list-item-title
                        >
                        <v-text-field
                          v-if="updateMode == 'true'"
                          v-model="datasOfPark.mercado"
                        ></v-text-field>
                      </v-list-item-content>
                    </v-list-item>

                    <v-list-item>
                      <v-list-item-icon>
                        <v-icon>mdi-eye</v-icon>
                      </v-list-item-icon>
                      <v-list-item-content>
                        <v-list-item-title
                          >Tipo de industria :{{
                            datasOfPark.tipoDeIndustria
                          }}</v-list-item-title
                        >
                        <v-text-field
                          v-if="updateMode == 'true'"
                          v-model="datasOfPark.tipoDeIndustria"
                        ></v-text-field>
                      </v-list-item-content>
                    </v-list-item>
                  </v-list>
                </v-card-text>
              </v-card>
            </v-col>
            <v-col cols="12" md="4">
              <v-card class="my-4">
                <v-card-title>Superficie Total</v-card-title>
                <v-progress-circular
                  :rotate="360"
                  :size="200"
                  :width="15"
                  :value="totalArea"
                  color="teal"
                  class="my-5"
                >
                  {{ datasOfPark.superficieTotal }} km
                </v-progress-circular>
                <v-card-actions></v-card-actions>
              </v-card>
              <v-card class="my-4">
                <v-card-title>Superficie Urbana</v-card-title>
                <v-progress-circular
                  :rotate="360"
                  :size="200"
                  :width="15"
                  :value="supUrb"
                  color="purple"
                  class="my-5"
                >
                  {{ datasOfPark.superficieUrban }} KM
                </v-progress-circular>
                <v-card-actions></v-card-actions>
              </v-card>
              <v-card class="my-4">
                <v-card-title>Superficie ocupada</v-card-title>
                <v-progress-circular
                  :rotate="360"
                  :size="200"
                  :width="15"
                  :value="supOc"
                  color="red"
                  class="my-5"
                >
                  {{ datasOfPark.superficieOcup }} KM
                </v-progress-circular>
                <v-card-actions></v-card-actions>
              </v-card>
              <v-card class="my-4">
                <v-card-title>Superficie disponible</v-card-title>
                <v-progress-circular
                  :rotate="360"
                  :size="200"
                  :width="15"
                  :value="supDis[0]"
                  color="blue"
                  class="my-5"
                >
                  {{ supDis[1] }} KM
                </v-progress-circular>
                <v-card-actions></v-card-actions>
              </v-card>
            </v-col>
          </v-row>
        </v-container-fluid>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
export default {
  name: "popupParque",
  data() {
    return {
      dialog: false,
      updateMode: false,
    };
  },
  props: ["datasOfPark", "edit"],
  computed: {
    totalArea() {
      return 100;
    },
    supUrb() {
      let cien = parseInt(this.datasOfPark.superficieTotal);
      let urb = parseInt(this.datasOfPark.superficieUrban);
      return (urb * 100) / cien;
    },
    supOc() {
      let cien = parseInt(this.datasOfPark.superficieTotal);
      let urb = parseInt(this.datasOfPark.superficieOcup);
      return (urb * 100) / cien;
    },
    supDis() {
      let cien = parseInt(this.datasOfPark.superficieTotal);
      let ocupada =
        parseInt(this.datasOfPark.superficieOcup) +
        parseInt(this.datasOfPark.superficieUrban);
      let disp = cien - ocupada;
      console.log(disp);
      return [(disp * 100) / cien, disp];
    },
  },
  methods: {
    change() {
      console.log("++++++++++++++");
      console.log(this.datasOfPark);
    },
  },
};
</script>

<style scoped>
* {
  overflow-x: hidden;
  overflow-y: hidden;
}
</style>
