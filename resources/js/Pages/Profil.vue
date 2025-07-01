<script setup>
import { ref, watch } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'

const page = usePage()
const user = page.props.auth?.user || {}

const dialog = ref(false)
const showSnackbar = ref(false)
const snackbar = ref('')

const form = useForm({
  old_password: '',
  new_password: '',
  new_password_confirmation: '',
})

function submit() {
  form.put('/profil/mot-de-passe', {
    onSuccess: () => {
      dialog.value = false
      snackbar.value = 'Mot de passe modifié avec succès !'
      showSnackbar.value = true
      form.reset()
    },
    onError: () => {
      snackbar.value = 'Erreur lors de la modification du mot de passe.'
      showSnackbar.value = true
    }
  })
}

watch(
  () => page.props.flash?.success,
  (val) => {
    if (val) {
      snackbar.value = val
      showSnackbar.value = true
    }
  }
)
</script>


<template>
  <div class="background">
    <v-container>
      <h1 class="profil-title">Info Personnel</h1>
      <v-row justify="start">
        <v-col cols="12" md="8" lg="7">
          <v-text-field label="Nom" :model-value="user.nom" variant="outlined" disabled class="mb-4" />
          <v-text-field label="Prénom" :model-value="user.prenom" variant="outlined" disabled class="mb-4" />
          <v-text-field label="Email" :model-value="user.email" variant="outlined" disabled class="mb-8" />
          <v-row align="center" class="mb-8">
            <v-col cols="10" class="pa-0">
              <v-text-field label="Mot de passe" :model-value="'********'" type="password" variant="outlined" disabled
                class="ml-2" />
            </v-col>
            <v-col cols="2" class="pa-0 d-flex align-center">
              <v-btn color="#c62e43" class=" mb-4" @click="dialog = true">
                Modifier
              </v-btn>
            </v-col>
          </v-row>
                      <v-divider class="my-6"></v-divider>
<v-card-text class="text-caption" style="color: #888;">
  Pour toute demande de modification ou suppression de vos données personnelles, contactez 
  <a href="mailto:thibault.lefay.pro@gmail.com" style="color:#c62e43;">thibault.lefay.pro@gmail.com</a>
</v-card-text>
        </v-col>
      </v-row>


      <v-dialog v-model="dialog" max-width="400">
        <v-card>
          <v-card-title>Changer mon mot de passe</v-card-title>
          <v-card-text>
            <v-form @submit.prevent="submit">
              <v-text-field v-model="form.old_password" label="Ancien mot de passe" type="password" variant="outlined"
                required class="mb-4" :error-messages="form.errors.old_password" />
              <v-text-field v-model="form.new_password" label="Nouveau mot de passe" type="password" variant="outlined"
                required class="mb-4" :error-messages="form.errors.new_password" />
              <v-text-field v-model="form.new_password_confirmation" label="Confirmer le nouveau mot de passe"
                type="password" variant="outlined" required class="mb-4"
                :error-messages="form.errors.new_password_confirmation" />
              <v-card-actions>
                <v-btn color="success" type="submit">Valider</v-btn>
                <v-btn color="grey" @click="dialog = false">Annuler</v-btn>
              </v-card-actions>
            </v-form>
          </v-card-text>
          
        </v-card>
      </v-dialog>


      <v-snackbar v-model="showSnackbar" color="success" timeout="4000" location="top">
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
}

.profil-title {
  color: #c62e43;
  font-size: 2rem;
  font-weight: 800;
  font-family: 'Poppins', sans-serif;
  margin-bottom: 2rem;
  margin-left: 1rem;
}
</style>