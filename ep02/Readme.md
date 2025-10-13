# ☕ PHP Tips — Episódio 02  
## Integração com DataLayer (CoffeeCode)

Este projeto é o **episódio 02** da série **PHP Tips**, com o objetivo de demonstrar o uso da biblioteca **[CoffeeCode/DataLayer](https://github.com/robsonvleite/datalayer)** — um ORM simples e eficiente para PHP.  
O exemplo implementa **dois modelos relacionais** (`User` e `Address`) e utiliza **Docker** com **Apache**, **PHP 8.1** e **MySQL 8.0** para executar a aplicação.

---

## 🧱 Estrutura do Projeto

php_tips/
└── src/
└── public/
└── ep02/
├── examples/
│ ├── create.php
│ ├── read.php
│ ├── update.php
│ ├── delete.php
├── src/
│ └── Models/
│ ├── User.php
│ └── Address.php
├── composer.json
├── composer.lock
└── README.md


---

## ⚙️ Tecnologias Utilizadas

- **PHP 8.1 (Apache)**
- **MySQL 8.0**
- **phpMyAdmin**
- **Composer 2**
- **CoffeeCode/DataLayer 2.0+**
- **Docker & Docker Compose**

---

## 🐳 Configuração do Ambiente com Docker

O ambiente foi criado utilizando os seguintes arquivos:

### 🧩 `Dockerfile`
```dockerfile
FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    git zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev && \
    docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite

WORKDIR /var/www/html
COPY ./src /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

---

## ⚙️ Arquivo docker-compose.yml:

version: "3.8"

services:
  web:
    build: .
    container_name: php81-apache
    ports:
      - "8080:80"
    volumes:
      - ./src:/var/www/html
    depends_on:
      - db
    networks:
      - devnet

  db:
    image: mysql:8.0
    container_name: mysql8
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: appdb
      MYSQL_USER: appuser
      MYSQL_PASSWORD: apppass
    ports:
      - "3307:3306"
    volumes:
      - db_data:/var/lib/mysql
    networks:
      - devnet

  phpmyadmin:
    image: phpmyadmin/phpmyadmin:latest
    container_name: phpmyadmin
    restart: always
    ports:
      - "8081:80"
    environment:
      PMA_HOST: db
      PMA_USER: appuser
      PMA_PASSWORD: apppass
    depends_on:
      - db
    networks:
      - devnet

volumes:
  db_data:

networks:
  devnet:

  ---

  🚀 Como Executar

Subir o ambiente Docker:

docker-compose up -d --build


Acessar os serviços:

Aplicação PHP → http://localhost:8080

phpMyAdmin → http://localhost:8081

Entrar no container PHP (opcional):

docker exec -it php81-apache bash


Instalar dependências do Composer (caso necessário):

docker exec -it php81-apache composer install

---

🗄️ Banco de Dados

O banco appdb contém duas tabelas:

Tabela users
Campo	Tipo	Descrição
id	INT (PK, AI)	Identificador único
first_name	VARCHAR(255)	Nome
last_name	VARCHAR(255)	Sobrenome
genre	VARCHAR(11)	Gênero (M/F)
created_at	TIMESTAMP	Data de criação
updated_at	TIMESTAMP	Última atualização

Tabela addresses
Campo	Tipo	Descrição
addr_id	INT (PK, AI)	Identificador único
user_id	INT (FK)	ID do usuário
street	VARCHAR(255)	Rua
number	VARCHAR(255)	Número da residência

🔗 Relação: addresses.user_id referencia users.id

---

🧪 Testando

Insira alguns usuários e endereços no banco via phpMyAdmin.

Acesse no navegador:

http://localhost:8080/public/ep02/examples/read.php


O resultado exibirá os usuários e seus respectivos endereços.

💡 Observações

O host MySQL dentro do PHP é sempre mysql, conforme definido no docker-compose.yml.

A porta configurada para o container MySQL é 3306 (internamente).

Use 3307 apenas se quiser acessar o banco fora do Docker (ex: DBeaver, HeidiSQL, etc).

As credenciais de acesso padrão são:

host: mysql
user: appuser
pass: apppass
db:   appdb

🧰 Comandos Úteis
# Acessar o container PHP
docker exec -it php81-apache bash

# Atualizar o pacote DataLayer
docker exec -it php81-apache composer update coffeecode/datalayer

# Ver logs do Apache
docker logs php81-apache

# Remover tudo e reconstruir do zero
docker-compose down -v && docker-compose up -d --build

✍️ Autor

Nicolas Torelli
Desenvolvedor Web • Estudante de Tecnologia • Entusiasta de Docker, PHP e Linux.
📍 Projeto criado para estudos práticos com PHP moderno e boas práticas.

🧾 Licença

Este projeto é distribuído sob a licença MIT.
Sinta-se livre para estudar, modificar e compartilhar.