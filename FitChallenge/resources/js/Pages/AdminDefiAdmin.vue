<script setup>
import { ref } from 'vue'

const props = defineProps({
  defi: Object,
  video: Object,
  error: String,
})

const showVideo = ref(false)
</script>

<template>
  <div class="background">
    <v-container class="ml-6">
      <v-row align="center" justify="start">
        <!-- Image carré -->
        <v-col cols="12" md="3" class="defi-sidebar">
          <v-img :src="`/storage/${props.defi.image}`" class="defi-sidebar-img mb-4" />
          <div class="defi-info">
            <div><span class="defi-info-label">Type d’exercice :</span> {{ props.defi.type_exercice }}</div>
            <div><span class="defi-info-label">Objectif :</span> {{ props.defi.objectif }}</div>
            <div><span class="defi-info-label">Date de Creation :</span> {{ props.defi.created_at.slice(0, 10) }}</div>
            <div><span class="defi-info-label">Durée :</span> {{ props.defi.duree }} min</div>
          </div>
        </v-col>

        <!-- Barre verticale -->
        <v-divider vertical class="mx-6" :thickness="3" color="#c62e43" />

        <!-- Infos défi -->
        <v-col>
          <h1 class="defi-title">{{ props.defi.titre }}</h1>
          <div class="defi-desc mb-4">{{ props.defi.description }}</div>
          <!-- Vidéo miniature -->
          <div v-if="props.video" class="defi-video-wrapper mt-6 mb-6" @click="showVideo = true">
            <div class="defi-video-thumb">
              <v-icon size="48" color="#c62e43" class="defi-video-play">mdi-play-circle-outline</v-icon>
            </div>
          </div>
          <div v-if="props.video" class="mt-2" style="color:#c62e43;font-weight:600;">
            {{ props.video.titre }}
          </div>
          <div v-else class="mt-6 mb-6" style="color:#c62e43;">Aucune vidéo disponible</div>
        </v-col>
        <v-btn color="#c62e43" style="color: #fff; text-transform: none;" @click="$inertia.visit('/admin/defi')">
          Retour
        </v-btn>
      </v-row>

      <!-- Modale vidéo -->
      <v-dialog v-model="showVideo" max-width="700">
        <v-card>
          <v-card-title v-if="props.video" style="color:#c62e43;">
            {{ props.video.titre }}
          </v-card-title>
          <video v-if="props.video" :src="`/storage/${props.video.url}`" controls autoplay
            style="width:100%;border-radius:12px;">
            Votre navigateur ne supporte pas la lecture vidéo.
          </video>
        </v-card>
      </v-dialog>
    </v-container>
  </div>
</template>

<style scoped>
.background {
  min-height: 80vh;
  width: 100vw;
  background-image: url('/images/Imadefond.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  overflow-x: hidden;
}

@media (max-width: 700px) {

  .ml-6,
  .mx-6 {
    margin-left: 0 !important;
    margin-right: 0 !important;
  }

  .defi-sidebar-img {
    width: 100% !important;
    max-width: 100vw;
    height: auto !important;
    min-width: 0 !important;
    min-height: 0 !important;
    display: block;
    margin: 0 auto 1rem auto;
  }

  .defi-video-wrapper {
    width: 100% !important;
    min-width: 0;
    max-width: 100vw;
  }

  .defi-sidebar {
    margin-bottom: 1rem;
  }

  .v-row {
    flex-direction: column !important;
    gap: 1rem;
  }

  .v-divider.mx-6 {
    display: none !important;
  }
}

.defi-img {
  width: 160px;
  height: 160px;
  min-width: 160px;
  min-height: 160px;
  max-width: 160px;
  max-height: 160px;
  object-fit: cover;
  border-radius: 16px;
  box-shadow: 0 4px 18px 0 rgba(44, 44, 44, 0.18);
}

.defi-title {
  color: #c62e43;
  font-size: 2rem;
  font-weight: 800;
  font-family: 'Poppins', sans-serif;
  margin-bottom: 1.2rem;
}

.defi-desc {
  color: #c62e43;
  font-size: 1.1rem;
  font-family: 'Poppins', sans-serif;
  margin-bottom: 1.5rem;
  max-width: 700px;
}

.defi-info {
  color: #c62e43;
  font-size: 1rem;
  font-family: 'Poppins', sans-serif;
  margin-bottom: 1.5rem;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.defi-info-label {
  font-weight: 700;
}

.defi-video-wrapper {
  width: 350px;
  height: 140px;
  background: #f5f5f5;
  border-radius: 12px;
  box-shadow: 0 4px 18px 0 rgba(44, 44, 44, 0.10);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  position: relative;
  transition: box-shadow 0.2s;
}

.defi-video-wrapper:hover {
  box-shadow: 0 8px 24px 0 rgba(198, 46, 67, 0.18);
}

.defi-video-thumb {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100%;
}

.defi-video-play {
  pointer-events: none;
}
</style>