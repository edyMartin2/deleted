<template>
  <v-card
    class="mx-auto"
    max-width="100%"
  >
    <v-card-text>
      <div>{{name}}</div>
      <p class="display-1 text--primary">
      {{propsData.id_park}}
      </p>
      <p v-if="propsData.name">{{propsData.name}}</p>
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
      <v-btn
          text
          color="red"
          @click="reveal = true"
          v-if="del"
      >
        <v-icon> mdi-delete</v-icon>
      </v-btn>
    </v-card-actions>

  </v-card>
</template>
<script>
  export default {
    data: () => ({
      reveal: false,
    }),
    props:['propsData','activeView', 'name','del']
  }
</script>
<style>
.v-card--reveal {
  bottom: 0;
  opacity: 1 !important;
  position: absolute;
  width: 100%;
}
</style>