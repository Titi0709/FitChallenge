<script setup>
import { usePage } from '@inertiajs/vue3'
import { Link } from "@inertiajs/vue3";
import { ref, watch } from 'vue'


const page = usePage()
const showSnackbar = ref(!!page.props.flash?.success)
const showSnackbarMessage = ref(!!page.props.flash?.message)
const snackbar = ref(page.props.flash?.success || '')
const snackbarMessage = ref(page.props.flash?.message || '')

const props = defineProps({
  defis: Array,
  programmes: Array,
  challenges: Array,
   user: Object,
});

watch(
  () => page.props.flash?.success,
  (val) => {
    if (val) {
      snackbarMessage.value = val
      showSnackbar.value = true
    }
  }
)
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
         Bienvenue, {{ props.user?.prenom ?? 'Champion' }}
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



 <!-- Derniers défis (Carrousel) -->
    <section class="mb-10">
      <h2 class="accueil-section-title text-center mb-4 custom-h2">Les défis !</h2>
      <Link href="/Cataloguedefis" class="voir-plus-btn-page">
      Voir plus
      <v-icon size="18" class="ml-1">mdi-arrow-right</v-icon>
    </Link>
      <div v-if="defis.length" class="carousel-wrapper">
      <v-carousel
        hide-delimiter-background
        height="300"
        show-arrows
        cycle
      >
        <v-carousel-item
          v-for="defi in defis"
          :key="defi.id_defi"
        >
          <v-img :src="`/storage/${defi.image}`" height="300px" cover>
            <div class="carousel-caption">
              <div class="carousel-title">{{ defi.titre }}</div>
              <Link :href="`/defi/${defi.id_defi}`" class="voir-plus-btn">
              Voir le défi
              <v-icon size="18" class="ml-1">mdi-arrow-right</v-icon>
            </Link>
            </div>
          </v-img>
        </v-carousel-item>
      </v-carousel>
      </div>
      <div v-else class="aucun-message">Aucun défi n'est présent.</div>
    </section>

    <!-- Derniers programmes (Carrousel) -->
    <section class="mb-10">
      <h2 class="accueil-section-title text-center mb-4 custom-h2" >Les programmes !</h2>
      <Link href="/programmes" class="voir-plus-btn-page">
      Voir plus
      <v-icon size="18" class="ml-1">mdi-arrow-right</v-icon>
    </Link>
      <div v-if="programmes.length" class="carousel-wrapper">
      <v-carousel
        hide-delimiter-background
        height="300"
        show-arrows
        cycle
      >
        <v-carousel-item
          v-for="programme in programmes"
          :key="programme.id_programme"
        >
          <v-img :src="programme.image" height="300px" cover>
            <div class="carousel-caption">
              <div class="carousel-title">{{ programme.titre }}</div>
              <Link :href="`/programmes/${programme.id_programme}`" class="voir-plus-btn">
              Voir le programme
              <v-icon size="18" class="ml-1">mdi-arrow-right</v-icon>
            </Link>
            </div>
          </v-img>
        </v-carousel-item>
      </v-carousel>
      </div>
      <div v-else class="aucun-message">Aucun programme n'est présent.</div>
      
    </section>

    <!-- Derniers challenges (Carrousel) -->
    <section>
      <h2 class="accueil-section-title text-center mb-4 custom-h2">Mes Challenges !</h2>
      <Link href="/progression" class="voir-plus-btn-page">
      Voir plus
      <v-icon size="18" class="ml-1">mdi-arrow-right</v-icon>
    </Link>
       <div v-if="challenges.length" class="carousel-wrapper">
      <v-carousel
        hide-delimiter-background
        height="300"
        show-arrows
        cycle
      >
        <v-carousel-item
          v-for="challenge in challenges"
          :key="challenge.id_participation"
        >
          <v-img :src="`/storage/${challenge.defi?.image}`" height="300px" cover>
            <div class="carousel-caption">
              <div class="carousel-title">{{ challenge.defi?.titre }}</div>
              <Link href="/progression" class="voir-plus-btn">
              Voir le challenge
              <v-icon size="18" class="ml-1">mdi-arrow-right</v-icon>
            </Link>
            </div>
          </v-img>
        </v-carousel-item>
      </v-carousel>
      </div>
      <div v-else class="aucun-message">Aucun challenge n'est présent.</div>
    </section>
<v-snackbar v-model="showSnackbar" color="success" timeout="4000" location="top">
  {{ snackbar }}
</v-snackbar>

<v-snackbar v-model="showSnackbarMessage" color="orange-darken-2" timeout="4000" location="top">
  {{ snackbarMessage }}
</v-snackbar>
  </v-container>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap');

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
  margin-left: 300px;
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


.carousel-caption {
  position: absolute;
  bottom: 100px;
  width: 100%;
  text-align: center;

  color: #C62E43;

}

.carousel-title {
  font-size: 2.0rem;
  font-weight: 800;
  color: #C62E43;
  font-family: 'Poppins', sans-serif;
  text-align: center;
  margin-bottom: 0.3em;
  background: none;
  box-shadow: none;
  padding: 0;
}

.carousel-desc {
  font-size: 1.1rem;
  font-weight: 500;
}

.aucun-message {
  text-align: center;
  color: #C62E43;
  font-family: 'Poppins', sans-serif;
  font-size: 1.2rem;
  margin-bottom: 2rem;
}

.carousel-wrapper {
  max-width: 1000px;
  margin: 0 auto 2rem auto;
  box-shadow: 0 8px 32px 0 rgba(44, 44, 44, 0.40), 0 1.5px 3px 0 rgba(198, 46, 67, 0.15);


}

.custom-h2 {
  color: #C62E43 !important;
  font-size: 1.5rem !important;
  font-weight: 800;
  text-align: center;
  margin-bottom: 1.5rem;
  font-family: 'Poppins', sans-serif;
}

.voir-plus-btn {
  gap: 0.4em;
  color: #C62E43;
  font-weight: 700;
  font-family: 'Poppins', sans-serif;
  text-decoration: none;

}

.voir-plus-btn-page {
    display: flex;
  justify-content: center;
  align-items: center;
  gap: 0.4em;
  color: #C62E43;
  font-weight: 700;
  font-family: 'Poppins', sans-serif;
  text-decoration: none;
  margin-left: 900px;

}

</style>
