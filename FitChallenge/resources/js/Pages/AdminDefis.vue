<script setup>
import { ref, computed, watch } from 'vue'
import { router, usePage } from '@inertiajs/vue3'

const props = defineProps({
  defis: Array,
})

const pageDefis = ref(1)
const perPageDefis = 3
const paginatedDefis = computed(() => props.defis.slice(0, pageDefis.value * perPageDefis))
const hasMoreDefis = computed(() => pageDefis.value * perPageDefis < props.defis.length)
function nextPageDefis() { pageDefis.value++ }

const showSnackbar = ref(false)
const snackbar = ref('')

const confirmDialog = ref(false)
const dialogAction = ref('')
const selectedId = ref(null)

const page = usePage()
watch(
  () => page.props.flash?.success,
  (val) => {
    if (val) {
      snackbar.value = val
      showSnackbar.value = true
    }
  }
)

function openDialog(id, action) {
  selectedId.value = id
  dialogAction.value = action
  confirmDialog.value = true
}

function handleConfirm() {
  if (dialogAction.value === 'supprimer') {
    router.delete(`/admin/defi/${selectedId.value}`, {
      onSuccess: () => {
        snackbar.value = 'Défi supprimé avec succès !'
        showSnackbar.value = true
      }
    })
  } else if (dialogAction.value === 'valider') {
    router.put(`/admin/defi/${selectedId.value}/valider`, {}, {
      onSuccess: () => {
        snackbar.value = 'Défi validé avec succès !'
        showSnackbar.value = true
      }
    })
  }
  confirmDialog.value = false
}
</script>

<template>
  <div class="background">
    <v-container>
      <h1 class="progression-title">Gerer Défis</h1>
      <div v-if="paginatedDefis.length">
        <div
          v-for="d in paginatedDefis"
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
              <v-btn color="#c62e43" class="voir-plus-btn" @click="$inertia.visit(`/admin/defisadmin/${d.id_defi}`)">Voir plus</v-btn>
              <v-btn color="error" @click="openDialog(d.id_defi, 'supprimer')">Supprimer</v-btn>
              <v-btn color="success" v-if="d.statut !== 'validé'" @click="openDialog(d.id_defi, 'valider')">Valider</v-btn>
            </div>
          </div>
        </div>
        <div v-if="hasMoreDefis" class="d-flex justify-center mt-4">
          <v-btn @click="nextPageDefis" style="background: #c62e43; color: #fff; text-transform: none;">
            Voir plus de défis
          </v-btn>
        </div>
      </div>
      <div v-else>Aucun défi à gérer.</div>

      <!-- Dialog de confirmation -->
      <v-dialog v-model="confirmDialog" persistent max-width="400">
        <v-card>
          <v-card-title>
            {{
              dialogAction === 'supprimer'
                ? 'Supprimer ce défi ?'
                : 'Valider ce défi ?'
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
  </div>
</template>

<style scoped>
.background {
  min-height: 100vh;
  width: 100vw;
  background-image: url('/images/ImadefondAdmin.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}
.progression-title {
  font-size: 2.5rem;
  color: #c62e43;
  font-weight: 800;
  text-align: center;
  margin: 2rem 0;
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