<script setup>
import { ref, computed } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  defis: Array,
})

const page = ref(1)
const perPage = 3

const paginatedDefis = computed(() => {
  return props.defis.slice(0, page.value * perPage)
})

const hasMore = computed(() => {
  return page.value * perPage < props.defis.length
})

function nextPage() {
  page.value++
}
</script>

<template>
  <div class="defis-background">
    <v-container fluid class="pa-0 defis-poppins">

      <div class="d-flex align-center mb-8 mt-8">
        <h1 class="defis-title ml-16">
          Les Derniers Défis Sortis !
        </h1>
        <Link href="/creation-defi">
          <v-btn class="text-white ml-10" style="background: #c62e43; text-transform: none;">
            Créer un Défi !
          </v-btn>
        </Link>
      </div>

      <v-row>
        <template v-for="(defi, i) in paginatedDefis" :key="defi.id_defi">
          <v-col cols="12" class="mb-0">
            <v-card class="d-flex flex-row align-center pa-4 defis-card" flat>
              <div class="defis-img-container mr-6">
              <v-img
                :src="`/storage/${defi.image}`"
                alt="Image défi"
                class="mr-6 defis-img-shadow"
                style="border-radius: 12px; object-fit: cover;"
                cover
              />
              </div>
              <div class="flex-grow-1">
                <div class="defis-card-title">
                  {{ defi.titre }}
                </div>
                <div class="mt-2 defis-card-desc">
                  {{ defi.description }}
                </div>
                <Link :href="`/defi/${defi.id_defi}`">
                  <v-btn class="mt-4" style="background: #c62e43; color: #fff; text-transform: none;">
                    Voir plus
                  </v-btn>
                </Link>
              </div>
            </v-card>
          </v-col>

          <v-divider v-if="i < paginatedDefis.length - 1" class="my-6" />
        </template>
      </v-row>

      <div v-if="hasMore" class="d-flex justify-center mt-8">
        <v-btn @click="nextPage" style="background: #c62e43; color: #fff; text-transform: none;">
          Voir plus de défis
        </v-btn>
      </div>
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
  overflow-x: hidden; 
}

body {
  overflow-x: hidden;
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
  color: #c62e43;
}

.defis-card {
  box-shadow: none;
  background: transparent;
}

.defis-img-container {
  margin-left: 30px;
  min-width: 140px;
  min-height: 140px;
  border-radius: 12px;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #fff;
}
.defis-img-shadow {
  width: 100%;
  height: 100%;
  object-fit: cover;

  box-shadow: 0 4px 18px 0 rgba(44,44,44,0.18), 0 1.5px 3px 0 rgba(198,46,67,0.12);
}

@media (max-width: 600px) {
  .d-flex.align-center.mb-8.mt-8 {
    flex-direction: column !important;
    align-items: flex-start !important;
    gap: 1rem;
  }
  .defis-title {
    margin-left: 0 !important;
    text-align: left;
    font-size: 2rem;
  }
  .ml-10 {
    margin-left: 0 !important;
  }
}
</style>