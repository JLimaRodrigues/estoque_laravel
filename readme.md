# estoque-laravel

## Get started

1. Para rodar o projeto localmente (se tiver Docker Desktop)

   ```bash
   docker-compose up --build -d
   ```

1.1 Para rodar o projeto se for rodar no Xampp.

- Rodar 

    ```bash
        composer install
   ```
- no phpmyadmin do Xampp crie um novo DATABASE e nomeie de 'estoque'

- importe o codigo de db.sql para dentro do 'estoque'

- Copie o conteudo do .env.example para um arquivo .env 

lembrando de definir as variaveis globais

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=estoque
DB_USERNAME=root
DB_PASSWORD=

e rode

    ```bash
    php artisan key:generate
   ```
   no terminal

- rode depois os migrations 
    ```bash
    php artisan migrate
   ```

- e depois os seeders
    ```bash
    php artisan db:seed
   ```

2. Acessar o link

Aplicação http://localhost:8000/ (Docker Desktop)
Banco de dados http://localhost:8080/ (Docker Desktop)

Aplicação http://localhost/estoque/public/ (Xampp)
Banco de dados http://localhost/phpmyadmin (Xampp)

###Tópicos 

- [Descrição do Projeto](#descrição-do-projeto)

- [Funcionalidades](#funcionalidades)

##Descrição do Projeto

<p align="justify">
Teste prático para avaliar as habilidades técnicas proposto pela Zammix
</p>

##Funcionalidades


## Ferramentas Utilizadas

:heavy_check_mark: - Laravel 5.6.
:heavy_check_mark: - MySQL Básico.
:heavy_check_mark: - BootStrap Básico.

