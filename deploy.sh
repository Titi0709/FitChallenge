#!/bin/bash

# Variables
USER=azureuser              
HOST=98.66.215.189           
DEST=/var/www/fitchallenge   
KEY=id_rsa

echo "Début du déploiement sur Azure ($HOST)..."

# Transfert du projet
rsync -avz -e "ssh -i $KEY -o StrictHostKeyChecking=no" \
  --exclude=node_modules --exclude=vendor --exclude=fitchallenge-key.pem \
  . $USER@$HOST:$DEST

# Connexion distante pour setup Laravel
ssh -i $KEY -o StrictHostKeyChecking=no $USER@$HOST << 'EOF'
cd /var/www/fitchallenge
composer install --no-dev
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
chmod -R 775 storage bootstrap/cache

echo "✅ Déploiement terminé sur la VM"
EOF
