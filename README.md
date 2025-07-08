## Script de déploiement automatique (deploy.sh)

Ce script fait :
-  Envoi du projet sur la VM via `rsync`
-  Création du `.env` distant si absent
-  Installation des dépendances PHP + NPM
-  Migrations + optimisations Laravel
-  Redémarrage d’Apache si nécessaire

> Le script utilise une clé SSH définie dans GitHub Actions (ou localement)  
> Il peut être lancé automatiquement via GitHub Actions (`deploy.yml`)
