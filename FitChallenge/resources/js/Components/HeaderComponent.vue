<script setup>
import { Link,router,usePage } from '@inertiajs/vue3';



const page = usePage()

function logout() {
  router.post('/logout');
}
</script>

<template>
  <v-app-bar
    flat
    color="white"
    class="header-bar"
     height="90"
  >
    <!-- Logo à gauche -->
    <v-img
      src="/images/LogoFitChallenge.png"
      alt="Logo"
      height="60"
      class="ml-n15 mr-n15"
      contain
    />

 
    <v-row
      class="d-none d-sm-flex nav-row-gap"
      align="center"
      justify="center"
    >
      <Link href="/"  class="nav-link ml-n16">accueil</Link>
      <Link href="/Cataloguedefis" class="nav-link ml-16">défis</Link>
      <Link href="/programmes" class="nav-link ml-16">Programmes</Link>
      <Link href="/messagerie" class="nav-link ml-16">messagerie</Link>
      <Link href="/progression">
        <v-btn class="text-white mr-4 ml-15" style="background: #c62e43; text-transform: none;">progression</v-btn>
      </Link>
      <Link
        v-if="page.props.auth?.user?.role === 'admin'"
        href="/admin"
      >
        <v-btn class="text-white mr-4 ml-15" style="background: #c62e43; text-transform: none;">
          Admin
        </v-btn>
      </Link>
      <Link href="/login" v-if="!page.props.auth?.user">
        <v-btn class="text-white mr-4 ml-15" style="background: #c62e43; text-transform: none;">
          Connexion
        </v-btn>
      </Link>
      <v-btn
        v-if="page.props.auth?.user"
        icon
        class="ml-4"
        style="background: #c62e43; color: #fff;"
        @click="logout"
        title="Déconnexion"
      >
        <v-icon>mdi-logout</v-icon>
      </v-btn>
    </v-row>


>

  </v-app-bar>
</template>

<style scoped>
.header-bar {
  font-family: 'Poppins', sans-serif;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* ombre subtile */
}

.nav-link {
  color: black;
  font-family: 'Poppins', sans-serif;
  text-transform: lowercase;
  text-decoration: none;
}

.nav-row-gap {
  gap: 64px;
  transition: gap 0.2s;
}

@media (max-width: 1300px) {
  .nav-row-gap {
    gap: 20px;
  }

}
@media (max-width: 1200px) {
  .nav-row-gap {
    gap: 0px;
  }

}


</style>
