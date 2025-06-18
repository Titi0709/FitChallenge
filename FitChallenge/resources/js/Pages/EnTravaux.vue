<template>
  <div class="en-travaux-background">
    <div class="en-travaux-container">
      <v-icon size="120" color="#c62e43" class="mb-6">mdi-tools</v-icon>
      <h1 class="en-travaux-title">Site en travaux</h1>
      <p class="en-travaux-message">
        Cette page n'est pas encore disponible.<br>
        Nous travaillons dessus, merci de votre patience !
      </p>
    </div>
  </div>
</template>

<script setup>

</script>

<style scoped>
.en-travaux-background {
  min-height: 100vh;
  width: 100vw;
  background: linear-gradient(135deg, #fff 60%, #c62e43 100%);
  display: flex;
  align-items: center;
  justify-content: center;
}
.en-travaux-container {
  background: #fff;
  border-radius: 24px;
  box-shadow: 0 4px 24px 0 rgba(44,44,44,0.10);
  padding: 48px 32px;
  text-align: center;
  max-width: 420px;
}
.en-travaux-title {
  color: #c62e43;
  font-size: 2.5rem;
  font-weight: 800;
  font-family: 'Poppins', sans-serif;
  margin-bottom: 1.5rem;
}
.en-travaux-message {
  color: #c62e43;
  font-size: 1.2rem;
  font-family: 'Poppins', sans-serif;
}
</style>