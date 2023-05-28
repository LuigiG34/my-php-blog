# BLOG PHP OPENCLASSROOMS V1.0

[![SymfonyInsight](https://insight.symfony.com/projects/9d86c1a1-9311-4820-8a49-7d9e5c75d757/big.svg)](https://insight.symfony.com/projects/9d86c1a1-9311-4820-8a49-7d9e5c75d757)


- Pour l'administation : admin@admin.com | mot de passe : Adminpass123!

### 1. Requirements
1. Docker
2. Docker compose

### 2. Installation
1. Lancer les container : ```docker compose up -d```
2. Installer les dépendances : ```docker compose exec app composer install```
3. Renommer le fichier config.ini.dist à config.ini à la racine du projet
4. Importer le données de la BDD avec : ```docker compose exec -T db mysql -uroot -proot my_blog_db < my_blog_db.sql```

### 3. Accès
1. Accéder au projet : ```http:/localhost:8000```
2. Accéder à phpMyAdmin : ```http://localhost:8080``` user : root | password : root 
3. Accéder aux emails : ```http://localhost:8025```
4. Accéder à l'administration : ```http://localhost:8000/admin``` identifiants fournis dans credentials.txt
