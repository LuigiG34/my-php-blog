### BLOG PHP OPENCLASSROOMS

[![SymfonyInsight](https://insight.symfony.com/projects/9d86c1a1-9311-4820-8a49-7d9e5c75d757/big.svg)](https://insight.symfony.com/projects/9d86c1a1-9311-4820-8a49-7d9e5c75d757)

Pour installer le projet et le lancer il faut : 
- Créer le container avec Docker
- Importer le fichier .sql à la racine dans phpMyAdmin dans un bdd "my_blog_db"
- Lancer un composer install
- Créer un fichier "config.ini" à la racine du projet avec votre config BDD et SMTP :

```
MAIL_HOST = ''
MAIL_USERNAME = ''
MAIL_PASSWORD = ''

DB_HOST = ''
DB_NAME = ''
DB_USERNAME = ''
DB_PASSWORD = ''
```

- Créer un compte utilisateur pour tester les fonctionnalités accessibles pour un User
- Pour l'administation : admin@admin.fr | mot de passe : Adminpass123!
