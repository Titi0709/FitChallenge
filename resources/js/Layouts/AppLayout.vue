<template>
  <v-app>
    <HeaderComponent :auth="auth"/>
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
