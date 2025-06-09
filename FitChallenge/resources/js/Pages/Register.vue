<script setup>
import { ref, watch } from "vue";
import { useForm, usePage, Link } from "@inertiajs/vue3";

const form = useForm({
    nom: "",
    prenom: "",
    email: "",
    mot_de_passe: "",
    mot_de_passe_confirmation: "",
});

const snackbar = ref(false);
const snackbarColor = ref("success");
const snackbarText = ref("");

function submit() {
    form.post("/register", {
        onFinish: () => {
            snackbarText.value = "Erreur lors de l'inscription.";
            snackbarColor.value = "error";
            snackbar.value = true;
        },
    });
}
</script>

<template>
    <v-app>
        <v-main>
            <v-container fluid class="pa-0 fill-height">
                <v-row no-gutters class="fill-height " >
                    <v-col 
                        cols="12"
                        md="6"
                        class="d-flex align-center justify-center"
                    >
                        <v-card
                            elevation="0"
                            max-width="700"
                            width="100%"
                            class="mx-auto pa-8 mt-n9"
                        >
                            <v-col cols="auto" class="mb-4">
                                <v-img
                                    src="/images/LogoFitChallenge.png"
                                    alt="Logo FitChallenge"
                                    width="90"
                                    height="90"
                                />
                            </v-col>

                            <v-col cols="12">
                                <div
                                    class="text-h4 font-weight-bold mb-1"
                                    style="line-height: 1.1"
                                >
                                    Bienvenue dans la team FitChallenge !
                                </div>
                                <div class="text-body-2 mb-6" style="color: #888">
                                    T'as la motive ? On a le challenge !
                                </div>
                            </v-col>

                            <v-form @submit.prevent="submit">
                                <v-text-field
                                    v-model="form.nom"
                                    label="Nom"
                                    :error-messages="form.errors.nom"
                                    variant="outlined"
                                    density="comfortable"
                                    required
                                    max-width="400"
                                />
                                <v-text-field
                                    v-model="form.prenom"
                                    label="Prénom"
                                    :error-messages="form.errors.prenom"
                                    variant="outlined"
                                    density="comfortable"
                                    required
                                    max-width="400"
                                />
                                <v-text-field
                                    v-model="form.email"
                                    label="Email"
                                    type="email"
                                    :error-messages="form.errors.email"
                                    variant="outlined"
                                    density="comfortable"
                                    required
                                    max-width="400"
                                />
                                <v-text-field
                                    v-model="form.mot_de_passe"
                                    label="Mot de passe"
                                    type="password"
                                    :error-messages="form.errors.mot_de_passe"
                                    variant="outlined"
                                    density="comfortable"
                                    required
                                    max-width="400"
                                />
                                <v-text-field
                                    v-model="form.mot_de_passe_confirmation"
                                    label="Confirmation Mot de passe"
                                    type="password"
                                    :error-messages="form.errors.mot_de_passe_confirmation"
                                    variant="outlined"
                                    density="comfortable"
                                    required
                                    max-width="400"
                                />
                                <v-btn
                                    type="submit"
                                    class="custom-btn"
                                    style="background: #19506b; color: #fff; text-transform: none;"
                                    block
                                >
                                    Inscription
                                </v-btn>
                            </v-form>

                            <div class="mt-4 text-body-2" style="color: #888">
                                Déjà un compte ?
                                <Link href="/login" method="get">
                                    <v-btn
                                        variant="text"
                                        style="color: #c62e43; font-weight: 500; margin-left: 4px; text-transform: none;"
                                    >
                                        Connexion
                                    </v-btn>
                                </Link>
                            </div>
                        </v-card>
                    </v-col>
                    <v-col cols="12" md="6" class="d-none d-md-flex pa-0">
                        <v-img
                            src="/images/RegisterPhoto.png"
                            alt="Register"
                            cover
                            height="100vh"
                        />
                    </v-col>
                </v-row>
                <v-snackbar
                    v-model="snackbar"
                    :color="snackbarColor"
                    timeout="3000"
                >
                    {{ snackbarText }}
                </v-snackbar>
            </v-container>
        </v-main>
    </v-app>
</template>

<style>
@import url("https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap");



body,
.v-application,
.v-application * {
    font-family: "Poppins", sans-serif;
     
}

.custom-btn {
    margin-top: 10px;
    min-width: 120px;
    min-height: 45px;
    border-radius: 8px;
}
</style>
