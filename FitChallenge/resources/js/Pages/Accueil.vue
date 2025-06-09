<script setup>
import { Link, usePage } from '@inertiajs/vue3';

const props = defineProps({
  defis: Array,
  programmes: Array,
  challenges: Array,
});



const user = usePage().props.auth?.user;
const userPrenom = user ? user.prenom : 'Champion';
</script>

<template>
  <v-container fluid class="pa-0">
    <!-- Hero Banner -->
    <div class="hero-banner mb-8">
      <v-img
        src="/images/Imadefond.jpg"
        cover
        height="400px"
        class="hero-image"
      />

      <div class="hero-text d-flex flex-column justify-center align-center text-center px-4">
        <h1 class="hero-title">
          Bienvenue, {{ userPrenom }}
        </h1>
        <p class="hero-subtitle">
          Prêt à relever un nouveau défi sportif aujourd'hui ?
        </p>
      </div>
    </div>

    <!-- Titre "Dernière sortie" -->
    <div class="section-title-container">
      <h2 class="section-title">Dernière sortie</h2>
      <div class="red-underline"></div>
    </div>



    <!-- Derniers défis -->
    <section class="mb-10">
      <h2 class="text-h5 font-weight-bold mb-4">Derniers défis</h2>
      <v-slide-group>
        <v-slide-item
          v-for="defi in defis"
          :key="defi.id_defi"
        >
          <v-card class="ma-2" max-width="300">
            <v-img :src="defi.image" height="150px" cover />
            <v-card-title>{{ defi.titre }}</v-card-title>
            <v-card-subtitle>{{ defi.type_exercice }}</v-card-subtitle>
          </v-card>
        </v-slide-item>
      </v-slide-group>
    </section>

    <!-- Derniers programmes -->
    <section class="mb-10">
      <h2 class="text-h5 font-weight-bold mb-4">Nouveaux programmes</h2>
      <v-row>
        <v-col
          v-for="programme in programmes"
          :key="programme.id_programme"
          cols="12"
          sm="6"
          md="4"
        >
          <v-card>
            <v-img :src="programme.image" height="160px" cover />
            <v-card-title>{{ programme.titre }}</v-card-title>
            <v-card-subtitle>{{ programme.type_exercice }}</v-card-subtitle>
          </v-card>
        </v-col>
      </v-row>
    </section>

    <!-- Derniers challenges rejoints -->
    <section>
      <h2 class="text-h5 font-weight-bold mb-4">Challenges récents</h2>
      <v-list>
        <v-list-item
          v-for="challenge in challenges"
          :key="challenge.id_participation"
        >
          <v-list-item-title>
            Participation au défi : {{ challenge.defi?.titre }}
          </v-list-item-title>
          <v-list-item-subtitle>{{ challenge.date_debut }}</v-list-item-subtitle>
        </v-list-item>
      </v-list>
    </section>
  </v-container>
</template>

<style scoped>
.hero-banner {
  position: relative;
  height: 400px;
  font-family: 'Poppins', sans-serif;
}

.hero-image {
  position: absolute;
  width: 100%;
  height: 100%;
  opacity: 0.8;
  z-index: 0;
}

.hero-text {
  position: relative;
  z-index: 1;
  height: 100%;
  font-family: 'Poppins', sans-serif;
}

.hero-title {
  font-size: 3rem;
  font-weight: 900; /* Extra bold */
  
  color: #C62E43;
}

.hero-subtitle {
  font-size: 2rem;
  margin-left: 150px;
  color: #8e2b39;
}

.section-title-container {
  text-align: center;
  margin-top: 24px;
  font-family: 'Poppins', sans-serif;
}

.section-title {
  color: #C62E43;
  font-weight: 900;
  font-size: 1.25rem;
  margin-bottom: 6px;
}

.red-underline {
  height: 1px;
  width: 2000px;
  background-color: #C62E43;
  margin-top: 24px;
  margin-bottom: 24px;
}

</style>
