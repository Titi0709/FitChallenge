<template>
  <v-footer
    class="footer-bar pa-4"
    color="white"
    app
  >

    <div class="d-flex d-sm-none align-center justify-end w-100">
      <v-img
        src="/images/LogoFitChallenge.png"
        alt="Logo"
        height="48"
        class="mr-15 ml-n15"
        contain
      />
      <span class="footer-text-mobile mr-5">&copy; 2025 FitChallenge</span>
    </div>


    <v-img
      src="/images/LogoFitChallenge.png"
      alt="Logo"
      height="60"
      class="footer-logo d-none d-sm-inline-block"
      contain
    />
    <v-spacer class="d-none d-sm-inline-block"></v-spacer>
    <span class="footer-text d-none d-sm-inline-block mr-16">&copy; 2025 FitChallenge</span>
  </v-footer>
</template>

<style scoped>
.footer-bar {
  font-family: 'Poppins', sans-serif;
  box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
}
.footer-text,
.footer-text-mobile {
  font-family: 'Poppins', sans-serif;
  color: #000;
  font-size: 14px;
}
.footer-text-mobile {
  font-size: 13px;
  font-weight: 500;
}
.footer-logo {
  margin-left: -300px;
  margin-right: 16px;
}
</style>