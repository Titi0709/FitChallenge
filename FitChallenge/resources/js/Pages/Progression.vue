<script setup>
import { ref } from 'vue'
import { router,usePage } from '@inertiajs/vue3'

const props = defineProps({
  participations: Array,
  mesDefis: Array,
})

const page = usePage()
const showSnackbar = ref(!!page.props.flash?.success)
const snackbar = ref(page.props.flash?.success || '')

const confirmDialog = ref(false)
const dialogAction = ref('')
const selectedId = ref(null)
const selectedType = ref('') // 'participation' ou 'defi'

function openDialog(id, action, type) {
  selectedId.value = id
  dialogAction.value = action
  selectedType.value = type
  confirmDialog.value = true
}

function handleConfirm() {
  if (dialogAction.value === 'supprimer' && selectedType.value === 'defi') {
    router.delete(`/defi/${selectedId.value}`)
  } else if (dialogAction.value === 'valider') {
    router.put(`/participation-defi/${selectedId.value}`, { statut: 'validé' })
  } else if (dialogAction.value === 'abandonner' && selectedType.value === 'participation') {
    router.delete(`/participation-defi/${selectedId.value}`)
  }
  confirmDialog.value = false
}
</script>

<template>
  <v-container>
    <!-- Titre et bouton profil -->
    <div class="d-flex align-center justify-center mb-8 mt-8" style="position: relative;">
      <h1 class="progression-title">Progression</h1>
      <v-btn
        class="profil-btn"
        color="#c62e43"
        dark
        @click="$inertia.visit('/profil')"
      >
        Profil
      </v-btn>
    </div>

    <!-- Ma progression -->
    <h2 class="section-title">Ma progression :</h2>
    <div v-if="props.participations.length">
      <div
        v-for="p in props.participations"
        :key="p.id_participation"
        class="progression-row"
      >
        <v-img
          :src="`/storage/${p.defi.image}`"
          class="progression-img"
        />
        <div class="progression-content">
          <div class="progression-defi-title">{{ p.defi.titre }}</div>
          <div class="progression-defi-desc">{{ p.defi.description }}</div>
          <div class="progression-btns">
            <v-btn color="success" @click="openDialog(p.id_participation, 'valider', 'participation')">VALIDÉ</v-btn>
            <v-btn color="error" @click="openDialog(p.id_participation, 'abandonner', 'participation')">ABANDONNER</v-btn>
            <v-btn color="#c62e43" class="voir-plus-btn" @click="$inertia.visit(`/defi/${p.defi.id_defi}`)">Voir plus</v-btn>
          </div>
        </div>
      </div>
    </div>
    <div v-else>Aucune progression en cours.</div>

    <!-- Mes défis -->
    <h2 class="section-title">Mes Défis :</h2>
    <div v-if="props.mesDefis.length">
      <div
        v-for="d in props.mesDefis"
        :key="d.id_defi"
        class="progression-row"
      >
        <v-img
          :src="`/storage/${d.image}`"
          class="progression-img"
        />
        <div class="progression-content">
          <div class="progression-defi-title">{{ d.titre }}</div>
          <div class="progression-defi-desc">{{ d.description }}</div>
          <div class="progression-btns">
            <v-btn color="#c62e43" class="voir-plus-btn" @click="$inertia.visit(`/defi/${d.id_defi}`)">Voir plus</v-btn>
            <v-btn color="error" @click="openDialog(d.id_defi, 'supprimer', 'defi')">Supprimer</v-btn>
          </div>
        </div>
      </div>
    </div>
    <div v-else>Tu n'as pas encore créé de défi.</div>

    <!-- Dialog de confirmation -->
    <v-dialog v-model="confirmDialog" persistent max-width="400">
      <v-card>
        <v-card-title>
          {{
            dialogAction === 'supprimer'
              ? 'Supprimer cet élément ?'
              : dialogAction === 'valider'
              ? 'Valider ce défi ?'
              : 'Abandonner ce défi ?'
          }}
        </v-card-title>
        <v-card-actions>
          <v-btn color="success" @click="handleConfirm">Oui</v-btn>
          <v-btn color="grey" @click="confirmDialog = false">Non</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-snackbar v-model="showSnackbar" color="success" timeout="4000" location="top">
  {{ snackbar }}
</v-snackbar>
  </v-container>
</template>

<style scoped>
.progression-title {
  font-size: 2.5rem;
  color: #c62e43;
  font-weight: 800;
  text-align: center;
  margin: 2rem 0;
  font-family: 'Poppins', sans-serif;
}
.profil-btn {
  position: absolute;
  right: 0;
  top: 0;
  font-family: 'Poppins', sans-serif;
  font-weight: 700;
  text-transform: none;
}
.section-title {
  color: #c62e43;
  font-size: 1.3rem;
  font-weight: 700;
  margin-top: 2rem;
  font-family: 'Poppins', sans-serif;
}
.progression-row {
  display: flex;
  align-items: center;
  margin-bottom: 2rem;
  gap: 2rem;
}
.progression-img {
  max-width: 180px;
  max-height: 300px;
  object-fit: cover;
  border-radius: 12px;
  box-shadow: 0 4px 18px 0 rgba(44,44,44,0.18);
  background: transparent;
}
.progression-content {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}
.progression-defi-title {
  font-weight: 700;
  color: #c62e43;
  font-size: 1.2rem;
  font-family: 'Poppins', sans-serif;
}
.progression-defi-desc {
  color: #c62e43;
  font-family: 'Poppins', sans-serif;
  margin-bottom: 0.5rem;
}
.progression-btns {
  display: flex;
  gap: 1rem;
  margin-top: 0.5rem;
}
.voir-plus-btn {
  color: #fff !important;
  background: #c62e43 !important;
  font-family: 'Poppins', sans-serif;
  font-weight: 700;
  text-transform: none;
}
</style>