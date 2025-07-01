<script setup>
import { Link, router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue'

const drawer = ref(false)
const page = usePage()

function logout() {
  router.post('/deconnexion');
}
</script>

<template>
    <v-app-bar
      flat
      color="white"
      class="header-bar w-100"
      height="90"
    >
      <div class="d-flex d-md-none align-center w-100">
        <v-app-bar-nav-icon
          class="ml-7"
          @click="drawer = !drawer"
        >
          <v-icon size="36" color="#c62e43">mdi-menu</v-icon>
        </v-app-bar-nav-icon>
        <v-spacer />
        <v-img
          src="/images/LogoFitChallenge.png"
          alt="Logo"
          height="60"
          contain
        />
      </div>

    <v-img
      src="/images/LogoFitChallenge.png"
      alt="Logo"
      height="60"
      class="ml-n15 mr-n15 d-none d-md-inline-block"
      contain
    />


    <v-row
      class="d-none d-md-flex nav-row-gap"
      align="center"
      justify="center"
    >
      <Link href="/" class="nav-link ml-n16">accueil</Link>
      <Link href="/Cataloguedefis" class="nav-link ml-8">défis</Link>
      <Link href="/programmes" class="nav-link ml-8">Programmes</Link>
      <Link href="/messagerie" class="nav-link ml-8">messagerie</Link>
      <Link href="/progression" class="nav-link ml-n8">
        <v-btn class="text-white mr-4 ml-15" style="background: #c62e43; text-transform: none;">progression</v-btn>
      </Link>
      <Link  class="nav-link ml-n8"
        v-if="page.props.auth?.user?.role === 'admin'"
        href="/admin"
      >
        <v-btn class="text-white mr-4 ml-15" style="background: #c62e43; text-transform: none;">
          Admin
        </v-btn>
      </Link>
      <Link href="/connexion"  class="nav-link ml-n8" v-if="!page.props.auth?.user" >
        <v-btn class="text-white mr-4 ml-15" style="background: #c62e43; text-transform: none;">
          Connexion
        </v-btn>
      </Link>
      <v-btn 
        v-if="page.props.auth?.user"
        icon
        style="background: #c62e43; color: #fff;"
        @click="logout"
        title="Déconnexion"
      >
        <v-icon>mdi-logout</v-icon>
      </v-btn>
    </v-row>
  </v-app-bar>


  <v-navigation-drawer
    v-model="drawer"
    temporary
    class="d-md-none"
  >
    <v-list nav>
      <v-list-item>
        <Link href="/" class="nav-link" @click="drawer = false">accueil</Link>
      </v-list-item>
      <v-list-item>
        <Link href="/Cataloguedefis" class="nav-link" @click="drawer = false">défis</Link>
      </v-list-item>
      <v-list-item>
        <Link href="/programmes" class="nav-link" @click="drawer = false">Programmes</Link>
      </v-list-item>
      <v-list-item>
        <Link href="/messagerie" class="nav-link" @click="drawer = false">messagerie</Link>
      </v-list-item>
      <v-list-item>
        <Link href="/progression" @click="drawer = false">
          <v-btn class="text-white" style="background: #c62e43; text-transform: none;">progression</v-btn>
        </Link>
      </v-list-item>
      <v-list-item v-if="page.props.auth?.user?.role === 'admin'">
        <Link href="/admin" @click="drawer = false">
          <v-btn class="text-white" style="background: #c62e43; text-transform: none;">Admin</v-btn>
        </Link>
      </v-list-item>
      <v-list-item v-if="!page.props.auth?.user">
        <Link href="/connexion" @click="drawer = false">
          <v-btn class="text-white" style="background: #c62e43; text-transform: none;">Connexion</v-btn>
        </Link>
      </v-list-item>
      <v-list-item v-if="page.props.auth?.user">
        <v-btn
          icon
          style="background: #c62e43; color: #fff;"
          @click="logout"
          title="Déconnexion"
        >
          <v-icon>mdi-logout</v-icon>
        </v-btn>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<style scoped>
.header-bar {
  font-family: 'Poppins', sans-serif;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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