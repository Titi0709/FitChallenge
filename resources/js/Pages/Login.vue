<script setup>
import { ref, watch } from "vue";
import { useForm, usePage, Link } from "@inertiajs/vue3";

const form = useForm({
    email: "",
    mot_de_passe: "",
});



const snackbar = ref(false);
const snackbarColor = ref("success");
const snackbarText = ref("");


function submit() {
    form.post("/connexion", {
        onFinish: () => {

            snackbarText.value = "Identifiants invalides.";
            snackbarColor.value = "error";

            snackbar.value = true;
        },
    });
}

</script>

<template>
    <v-app>
        <v-container fluid class="pa-0 fill-height">
            <v-row no-gutters>
                <v-col cols="12" md="6" class="d-flex align-center justify-center">
                    <v-card cols="12" elevation="0" max-width="700" width="100%" class="mx-auto pa-8">
                        <v-col cols="auto">
                            <v-img src="/images/LogoFitChallenge.png" alt="Logo FitChallenge" width="90" height="90" />
                        </v-col>

                        <v-col cols="12">
                            <div class="text-h4 font-weight-bold mb-1">
                                Bienvenue !<br />Pret a devenir un champion ?
                            </div>
                            <div class="text-body-2 mb-6 text--right" style="color: #888">
                                T'as la motive ? On a le challenge !
                            </div>
                        </v-col>

                        <v-form @submit.prevent="submit">
                            <v-text-field v-model="form.email" label="Email" type="email" autocomplete="email" required
                                variant="outlined" density="comfortable" max-width="400" />
                            <v-text-field v-model="form.mot_de_passe" label="Mot de passe" type="password"
                                autocomplete="current-password" required variant="outlined" density="comfortable"
                                max-width="400" />
                            <v-row>
                                <v-col cols="8" class="d-flex justify-end mb-4 negative-mt forgot-password-col">
                                    <span class="text-body-2 forgot-password-mobile" style="color: #888; cursor: pointer">
                                        Mot de passe oublié ?
                                    </span>
                                </v-col>
                            </v-row>
                            <v-btn type="submit" class="custom-btn" style="
                                    background: #19506b;
                                    color: #fff;
                                    text-transform: none;
                                ">
                                Connexion
                            </v-btn>
                        </v-form>

                        <div class="mt-6 text-body-2" style="color: #888">
                            Première connection ?
                            <Link href="/inscription" style="
                                    color: #c62e43;
                                    font-weight: 500;
                                    margin-left: 4px;
                                    text-decoration: none;
                                ">
                            Inscription
                            </Link>
                        </div>
                    </v-card>
                </v-col>
                <v-col cols="12" md="6" class="d-none d-md-flex pa-0">
                    <v-img src="/images/LoginPhoto.png" alt="Login" cover height="100vh" />
                </v-col>
            </v-row>
            <v-snackbar v-model="snackbar" :color="snackbarColor" timeout="3000">
                {{ snackbarText }}
            </v-snackbar>
        </v-container>
    </v-app>
</template>

<style>
@import url("https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap");

body,
.v-application,
.v-application * {
    font-family: "Poppins", sans-serif;
}

.negative-mt {
    margin-top: -8px;
}

.custom-btn {
    margin-top: 10px;
    min-width: 120px;
    min-height: 45px;
    border-radius: 8px;
}

@media (max-width: 600px) {
  .forgot-password-mobile {
    margin-left: 5px;
    display: inline-block;
  }
  .forgot-password-col {
    justify-content: flex-start !important;
  }
}
</style>
