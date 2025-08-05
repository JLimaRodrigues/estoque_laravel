#!/bin/bash

echo "Aguardando o banco de dados..."
until mysql -h "$DB_HOST" -u "$DB_USERNAME" -p"$DB_PASSWORD" -e "SELECT 1" 2>/dev/null; do
  sleep 2
done
echo "Banco disponível!"

if [ ! -d "vendor" ]; then
  echo "Instalando dependências PHP..."
  composer install
fi

if [ ! -d "node_modules" ]; then
  echo "Instalando dependências do Node..."
  npm install
fi

if [ ! -f ".env" ]; then
  echo "Gerando arquivo .env e chave..."
  cp .env.example .env
fi
php artisan key:generate --force

echo "Executando migrations..."
php artisan migrate --force

echo "Executando seeders..."
php artisan db:seed --force

echo "Ambiente Laravel pronto!"
apache2-foreground
