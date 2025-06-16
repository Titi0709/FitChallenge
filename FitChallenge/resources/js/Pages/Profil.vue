<script setup>
import { ref } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()
const utilisateur = page.props.utilisateur

const nom = ref(utilisateur?.nom || '')
const prenom = ref(utilisateur?.prenom || '')
const email = ref(utilisateur?.email || '')
const password = ref('')
</script>

<template>
  <div class="profil-container">
    <h1 class="profil-title">Info Personnel</h1>
    <form class="profil-form">
      <input class="profil-input" type="text" v-model="nom" placeholder="Nom" disabled />
      <input class="profil-input" type="text" v-model="prenom" placeholder="Prenom" disabled />
      <input class="profil-input" type="email" v-model="email" placeholder="email" disabled />
      <div class="profil-row">
        <input class="profil-input" type="password" v-model="password" placeholder="Mot de passe" disabled />
        <button class="profil-btn" type="button" disabled>Modifier</button>
      </div>
    </form>
  </div>
</template>

<style scoped>
.profil-container {
  width: 100vw;
  min-height: 100vh;
  background: #fff;
  position: relative;
  padding-top: 40px;
}
.profil-title {
  text-align: center;
  color: #c62e43;
  font-size: 3rem;
  font-weight: 700;
  margin-bottom: 2rem;
  font-family: 'Poppins', sans-serif;
}
.profil-form {
  max-width: 400px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  gap: 20px;
}
.profil-input {
  padding: 12px;
  border-radius: 6px;
  border: none;
  box-shadow: 0 2px 6px #0001;
  font-size: 1rem;
  font-family: 'Poppins', sans-serif;
}
.profil-row {
  display: flex;
  gap: 10px;
  align-items: center;
}
.profil-btn {
  background: #c62e43;
  color: #fff;
  border: none;
  border-radius: 4px;
  padding: 10px 22px;
  font-size: 1rem;
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  cursor: not-allowed;
  box-shadow: 0 2px 6px #0001;
}
</style>