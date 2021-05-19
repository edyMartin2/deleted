<template>
  <div>
    <v-app-bar
        color="deep-purple accent-4"
        dense
        dark
        height="100vh"
        width="100%"
    >

      <v-toolbar-title></v-toolbar-title>


      <template>
        <v-container>

          <v-row justify="end" align="end">
           <v-col cols="3" class="my-3">
             <v-text-field
                 label="Buscar"

                 filled
                 rounded
                 dense
             ></v-text-field>
           </v-col>
         </v-row>

        </v-container>
      </template>
      <v-menu style="margin-top: 0">
        <template v-slot:activator="{ on, attrs }">
          <v-btn
              icon
              v-bind="attrs"
              v-on="on"
          >
            <v-icon>mdi-dots-vertical</v-icon>
          </v-btn>
        </template>

        <v-list>
          <v-list-item
              v-for="n in actions"
              :key="n"
              @click="() => {}"
          >
            <v-list-item-title>{{ n }}</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>

    </v-app-bar>
  </div>
</template>
<script>
export default {
name: "menuBar",
  props:['actions']
}
</script>

<style scoped>

</style>