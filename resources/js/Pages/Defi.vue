<script setup>
import { ref, watch } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  defi: Object,
  video: Object,
  error: String, 
})

const showSnackbarMessage = ref(!!props.error)
const snackbar = ref(props.error || '')
const showVideo = ref(false)

function rejoindreDefi() {
  router.post(`/defi/${props.defi.id_defi}/participer`, { id_defi: props.defi.id_defi })
}

watch(
  () => props.error,
  (val) => {
    if (val) {
      snackbar.value = val
      showSnackbarMessage.value = true
    }
  }
)
</script>

<template>
  <div class="background">
    <v-container class="ml-6">
      <v-row align="start" justify="start">
        <!-- Image et infos toujours à gauche -->
        <v-col cols="12" md="3" class="defi-sidebar">
          <v-img
            :src="`/storage/${props.defi.image}`"
            class="defi-sidebar-img mb-4"
          />
          <div class="defi-info">
            <div><span class="defi-info-label">Type d’exercice :</span> {{ props.defi.type_exercice }}</div>
            <div><span class="defi-info-label">Objectif :</span> {{ props.defi.objectif }}</div>
            <div><span class="defi-info-label">Date de Creation :</span> {{ props.defi.created_at.slice(0, 10) }}</div>
            <div><span class="defi-info-label">Durée :</span> {{ props.defi.duree }} min</div>
          </div>
        </v-col>

        <!-- Barre verticale visible uniquement sur desktop -->
        <v-divider
          vertical
          class="mx-6 d-none d-md-block"
          :thickness="3"
          color="#c62e43"
        />

        <!-- Contenu principal -->
        <v-col>
          <h1 class="defi-title">{{ props.defi.titre }}</h1>
          <div class="defi-desc mb-4">{{ props.defi.description }}</div>  

          <div
            v-if="props.video"
            class="defi-video-wrapper mt-6 mb-6"
            @click="showVideo = true"
          >
            <div class="defi-video-thumb">
              <v-icon size="48" color="#c62e43" class="defi-video-play">mdi-play-circle-outline</v-icon>
            </div>
          </div>
          <div v-if="props.video" class="mt-2" style="color:#c62e43;font-weight:600;">
            {{ props.video.titre }}
          </div>
          <div v-else class="mt-6 mb-6" style="color:#c62e43;">Aucune vidéo disponible</div>

          <v-btn class="defi-btn" color="#c62e43" dark @click="rejoindreDefi">
            Rejoindre le Défi !
          </v-btn>
        </v-col>
      </v-row>

      <v-dialog v-model="showVideo" max-width="700">
        <v-card>
          <v-card-title v-if="props.video" style="color:#c62e43;">
            {{ props.video.titre }}
          </v-card-title>
          <video
            v-if="props.video"
            :src="`/storage/${props.video.url}`"
            controls
            autoplay
            style="width:100%;border-radius:12px;"
          >
            Votre navigateur ne supporte pas la lecture vidéo.
          </video>
        </v-card>
      </v-dialog>
      <v-snackbar v-model="showSnackbarMessage" color="orange-darken-2" timeout="4000" >
        {{ snackbar }}
      </v-snackbar>
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

.v-container,
.v-row,
.v-col {
  box-sizing: border-box;
}

@media (max-width: 600px) {
  .ml-6, .mx-6 {
    margin-left: 0 ;
    margin-right: 0 ;
  }
  .defi-video-wrapper {
    width: 100%;
    min-width: 0;
    max-width: 100vw;
  }
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
  box-shadow: 0 4px 18px 0 rgba(44,44,44,0.10);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  position: relative;
  transition: box-shadow 0.2s;
}
.defi-video-wrapper:hover {
  box-shadow: 0 8px 24px 0 rgba(198,46,67,0.18);
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
.defi-btn {
  margin: 2rem 0 0 0;
  background: #c62e43 ;
  color: #fff ;
  font-family: 'Poppins', sans-serif;
  font-weight: 700;
  text-transform: none;
  border-radius: 6px;
  box-shadow: 0 2px 8px 0 rgba(44,44,44,0.10);
}

.defi-sidebar-img {
  width: 100%;
  max-width: 260px;
  height: auto;
  box-shadow: 0 4px 18px 0 rgba(44,44,44,0.18);
  object-fit: cover;
  display: block;
  margin-left: 0;
  margin-right: 0;
  border-radius: 16px;
}

@media (max-width: 900px) {
  .defi-sidebar-img {
    max-width: 160px;
    width: 100%;
    height: auto;
    margin-left: 0;
    margin-right: 1rem;
    display: block;
  }
}
@media (max-width: 600px) {
  .defi-sidebar-img {
    max-width: 250px;
    width: 100%;
    height: auto;
    margin-left: 0;
    margin-right: 1rem;
    display: block;
  }
}
</style>