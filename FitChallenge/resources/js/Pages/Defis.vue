<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  defis: Array,
});
</script>

<template>
    <div class="defis-background">
  <v-container fluid class="pa-0 defis-poppins">
    <!-- Titre principal et bouton -->
    <div class="d-flex align-center  mb-8 mt-8">
      <h1
        class="defis-title ml-16"
      >
        Les Derniers Défis Sortis !
      </h1>
      <Link href="/PageDefis">
        <v-btn class="text-white ml-10" style="background: #c62e43; text-transform: none; ">
          Créer un Défi !
        </v-btn>
      </Link>
    </div>

    <!-- Liste des défis -->
    <v-row>
      <v-col
        v-for="defi in props.defis"
        :key="defi.id_defi"
        cols="12"
        class="mb-6"
      >
        <v-card class="d-flex flex-row align-center pa-4 defis-card">
          <v-img
            :src="defi.image"
            alt="Image défi"
            width="120"
            height="120"
            class="mr-6"
            style="border-radius: 12px;"
            cover
          />
          <div class="flex-grow-1">
            <div class="defis-card-title">
              {{ defi.titre }}
            </div>
            <div class="mt-2 defis-card-desc">
              {{ defi.description }}
            </div>
            <Link :href="`/defis/${defi.id_defi}`">
              <v-btn class="mt-4" style="background: #c62e43; color: #fff; text-transform: none;">
                Voir plus
              </v-btn>
            </Link>
          </div>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
  </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap');

.defis-background {
  min-height: 80vh;
  width: 100vw;
  background-image: url('/images/Imadefond.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}


.defis-poppins {
  font-family: 'Poppins', sans-serif;
}

.defis-title {
  font-family: 'Poppins', sans-serif;
  font-weight: 800;
  font-size: 3rem;
  color: #c62e43;
  margin-left: 32px;
  letter-spacing: 1px;
}

.defis-card-title {
  font-family: 'Poppins', sans-serif;
  font-weight: 700;
  font-size: 1.35rem;
  color: #c62e43;
}

.defis-card-desc {
  font-family: 'Poppins', sans-serif;
  color: #7a7a7a;
}

.defis-card {
  box-shadow: 0 2px 8px rgba(0,0,0,0.07);
}
</style>