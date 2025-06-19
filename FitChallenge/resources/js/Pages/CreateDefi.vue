<script setup>
import { ref } from "vue";
import { useForm } from '@inertiajs/vue3'


const form = useForm({
  titre: '',
  description: '',
  objectif: '',
  type_exercice: '',
  duree: '',
  image: null,
  video: null,
})

function resetForm() {

  form.reset()
  form.clearErrors()
  form.image = null
  form.video = null
}

function submit() {
  form.post('/defis-creation', {

    forceFormData: true,
    onSuccess: () => {
      resetForm()
    },
  })
}
</script>

<template>
  <div class="page-defis-background">
    <v-container fluid class="pa-0 defis-poppins">
      <v-row>
        <v-col cols="12" md="7">
          <h1 class="page-defis-title mb-8 mt-8 text-center">Creation de défi !</h1>
          <div class="d-flex flex-column align-center justify-center">
            <v-form @submit.prevent="submit">
              <v-text-field v-model="form.titre" label="Titre du défi" variant="outlined" class="mb-4 champ-defi"
                :error-messages="form.errors.titre" />
              <v-textarea v-model="form.description" label="Description du défi" variant="outlined"
                class="mb-4 champ-defi" :error-messages="form.errors.description" />
              <v-text-field v-model="form.objectif" label="objectif" variant="outlined" class="mb-4 champ-defi"
                :error-messages="form.errors.objectif" />
              <v-text-field v-model="form.type_exercice" label="type_exercice" variant="outlined"
                class="mb-4 champ-defi" :error-messages="form.errors.type_exercice" />
              <v-text-field v-model="form.duree" label="durée (min)" variant="outlined" class="mb-4 champ-defi"
                type="number" :error-messages="form.errors.duree" />

              <div class="d-flex mb-6">
                <v-btn class="mr-4 text-white bouton-defi" style="background: #c62e43; text-transform: none;"
                  @click.prevent="$refs.imageInput.click()">
                  Joindre Image
                </v-btn>
                <input ref="imageInput" type="file" accept="image/*" class="d-none"
                  @change="e => form.image = e.target.files[0]" />

                <v-btn class="text-white bouton-defi" style="background: #c62e43; text-transform: none;"
                  @click.prevent="$refs.videoInput.click()">
                  Joindre Vidéo
                </v-btn>
                <input ref="videoInput" type="file" accept="video/*" class="d-none"
                  @change="e => form.video = e.target.files[0]" />
              </div>
              <div v-if="form.image" class="mt-2" style="color:#c62e43;font-weight:600;">
                Image sélectionnée : {{ form.image.name }}
              </div>
              <div v-if="form.video" class="mb-6" style="color:#c62e43;font-weight:600;">
                Vidéo sélectionnée : {{ form.video.name }}
              </div>

              <v-btn class="text-white bouton-defi "
                style="background: #c62e43; text-transform: none; font-size: 1.1rem;" type="submit">
                Créer le Défi !
              </v-btn>
            </v-form>
          </div>
        </v-col>
        <v-col cols="12" md="5">
          <div class="page-defis-warning pa-6 mt-12">
            <div class="font-weight-bold mb-2" style="color: #c62e43;">
              &#9888; Message de prévention
            </div>
            <div class="mb-2">
              Attention : la création d’un défi engage votre responsabilité.
            </div>
            <div class="mb-2">
              Veillez à proposer des exercices adaptés, correctement expliqués, sans mise en danger pour les
              participants.
            </div>
            <div class="mb-2" style="color: #c62e43;">
              &#10060; Pas d’exercices extrêmes ou dangereux.<br>
              &#9989; Privilégiez la progression, la sécurité et la pédagogie.
            </div>
            <div style="color: #c62e43;">
              &#9888; Toute vidéo ou défi inapproprié pourra être supprimé par l’équipe de modération.
            </div>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>


</template>

<style scoped>
@import url('https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap');

.page-defis-background {
  min-height: 70vh;
  width: 100%;
  background-image: url('/images/Imadefond.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  overflow-x: hidden;
}

body {
  overflow-x: hidden;
}

.defis-poppins {
  font-family: 'Poppins', sans-serif;
}

.page-defis-title {
  font-family: 'Poppins', sans-serif;
  font-weight: 800;
  font-size: 2.7rem;
  color: #c62e43;
  margin-left: 0.5rem;
  letter-spacing: 1px;
}

.page-defis-warning {
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
  font-family: 'Poppins', sans-serif;
  font-size: 1rem;
}

@media (max-width: 600px) {
  .d-flex.mb-6 {
    flex-direction: column !important;
    gap: 1rem;
    align-items: stretch !important;
  }
}

.champ-defi {
  width: 100%;
  min-width: 0;
  max-width: 100%;
}

@media (min-width: 900px) {
  .champ-defi {
    min-width: 700px;
    width: 700px;
    max-width: 100%;
  }
}

.bouton-defi {
  width: auto;
  max-width: 250px;
}

@media (max-width: 600px) {
  .bouton-defi {
    width: 100%;
    max-width: 100%;
  }
}
</style>