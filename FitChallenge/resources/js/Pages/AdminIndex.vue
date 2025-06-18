<script setup>

</script>

<template>
  <div class="admin-background">
    <v-container class="d-flex flex-column align-center">
      <h1 class="admin-title">Gerer compte</h1>
      <v-row class="admin-cards-row" justify="center">
        <v-col cols="12" md="4">
          <v-card class="admin-card" @click="$inertia.visit('/admin/defi')">
            <div class="admin-card-text">Gerer defi</div>
          </v-card>
        </v-col>
        <v-col cols="12" md="4">
          <v-card class="admin-card" @click="$inertia.visit('/admin/programme')">
            <div class="admin-card-text">Gerer programme</div>
          </v-card>
        </v-col>
        <v-col cols="12" md="4">
          <v-card class="admin-card" @click="$inertia.visit('/admin/coach')">
            <div class="admin-card-text">Gerer compte coach</div>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<style>
.admin-background {
  min-height: 100vh;
  width: 100vw;
  background-image: url('/images/ImadefondAdmin.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}
.admin-title {
  color: #c62e43;
  font-size: 2.5rem;
  font-weight: 800;
  font-family: 'Poppins', sans-serif;
  margin-bottom: 2rem;
  margin-top: 2rem;
  text-align: center;
}
.admin-cards-row {
  margin-top: 2rem;
}
.admin-card {
  background: #fff;
  border-radius: 16px;
  min-height: 120px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 18px 0 rgba(44,44,44,0.10);
  cursor: pointer;
  transition: box-shadow 0.2s;
}
.admin-card:hover {
  box-shadow: 0 8px 24px 0 rgba(198,46,67,0.18);
}
.admin-card-text {
  color: #c62e43;
  font-size: 1.2rem;
  font-weight: 700;
  font-family: 'Poppins', sans-serif;
  text-align: center;
}
</style>