<template>
  <v-footer
    class="footer-bar pa-4"
    color="white"
    app
  >
    <!-- Logo à gauche -->
    <v-img
      src="/images/LogoFitChallenge.png"
      alt="Logo"
      height="60"
      class="ml-n8 mr-n15"
      contain
    />

    <v-spacer></v-spacer>
    <v-spacer></v-spacer>

    <v-row
      class="d-none d-sm-flex"
      align="center"
      justify="center"

    >
    <span class="footer-text mr-16">&copy; 2025 FitChallenge</span>
    </v-row>
  </v-footer>
</template>

<style scoped>
.footer-bar {
  font-family: 'Poppins', sans-serif;
  box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1); /* ombre subtile en haut du footer */
}

.footer-text {
  font-family: 'Poppins', sans-serif;
  color: #000;
  font-size: 14px;
}
</style>
 