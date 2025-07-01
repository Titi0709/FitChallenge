#!/bin/bash

# Variables
USER=azureuser              
HOST=98.66.215.189           
DEST=/var/www/fitchallenge   
KEY=id_rsa

echo "🚀 Début du déploiement sur Azure ($HOST)..."

# Transfert du projet
rsync -avz -e "ssh -i $KEY -o StrictHostKeyChecking=no" \
  --exclude=node_modules --exclude=vendor --exclude=$KEY \
  . $USER@$HOST:$DEST

# Commandes à exécuter sur la VM distante
ssh -i $KEY -o StrictHostKeyChecking=no $USER@$HOST << 'EOF'
echo "🔧 Configuration sur la VM distante..."

# 1. Lancer MySQL (si pas encore lancé)
sudo systemctl start mysql

# 2. Aller dans le dossier projet
cd /var/www/fitchallenge

npm install
npm run build

# 3. Créer le fichier .env si absent
if [ ! -f .env ]; then
    cp .env.example .env

    sed -i 's/DB_HOST=.*/DB_HOST=127.0.0.1/' .env
    sed -i 's/DB_DATABASE=.*/DB_DATABASE=fitchallenge/' .env
    sed -i 's/DB_USERNAME=.*/DB_USERNAME=root/' .env
    sed -i 's/DB_PASSWORD=.*/DB_PASSWORD=Thibault0709/' .env
fi

# 4. Installer les dépendances
composer install --no-dev

# 5. Générer la clé Laravel (si jamais elle manque)
php artisan key:generate

# 6. Migrer la base
php artisan migrate --force

# 7. Optimisations
php artisan config:cache
php artisan view:cache

# 8. Droits d'accès
chmod -R 775 storage bootstrap/cache

echo "✅ Déploiement terminé sur la VM"
EOF
