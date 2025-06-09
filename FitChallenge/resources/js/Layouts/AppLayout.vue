<template>
  <v-app>
    <HeaderComponent />
    <v-main>
      <slot />
    </v-main>
    <FooterComponent />
  </v-app>
</template>

<script setup>
import HeaderComponent from '../Components/HeaderComponent.vue'
import FooterComponent from '../Components/FooterComponent.vue'
</script>
