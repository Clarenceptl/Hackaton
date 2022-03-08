## Getting started

```bash
docker-compose build --pull --no-cache
docker-compose up -d
docker-compose exec php composer i 
```

```
# URL
http://127.0.0.1

# Env DB (à mettre dans .env, si pas déjà présent)
DATABASE_URL="postgresql://postgres:password@databse:5432/db?serverVersion=13&charset=utf8"
```

## Commandes utiles
```
# Lister l'ensemble des commandes existances 
docker-compose exec php bin/console

# Supprimer le cache du navigateur
docker-compose exec php bin/console cache:clear

# Création de fichier vierge
docker-compose exec php bin/console make:controller
docker-compose exec php bin/console make:form

# Création d'un CRUD complet
docker-compose exec php bin/console make:crud

# Commandes pour recréer la base de donnée et les fixtures
docker-compose exec php bin/console d:d:d --force
docker-compose exec php bin/console d:d:c
docker-compose exec php bin/console d:f:l
docker-compose exec php bin/console d:s:u --dump-sql
docker-compose exec php bin/console d:s:u --force
docker-compose exec php bin/console d:f:l
```



## Gestion de base de données

#### Commandes de création d'entité
```
docker-compose exec php bin/console make:entity
```
Document sur les relations entre les entités
https://symfony.com/doc/current/doctrine/associations.html

#### Mise à jour de la base de données
```
# Voir les requètes qui seront jouer avec force
docker-compose exec php bin/console doctrine:schema:update --dump-sql

# Executer les requètes en DB
docker-compose exec php bin/console doctrine:schema:update --force
```

#### Création des dataFixtures
https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html

Utilisation avec FakerBundle : https://github.com/fzaninotto/Faker#seeding-the-generator

## Gestion des formulaires
https://symfony.com/doc/current/reference/forms/types.html

## Gestion de l'authentification
https://symfony.com/doc/current/components/security/authentication.html

#### Commande pour générer l'auth
```
docker-compose exec php bin/console make:user
docker-compose exec php bin/console doctrine:schema:update --force
docker-compose exec php bin/console make:auth

// Puis aller dans votre le fichier "custom authenticator" pour choisir la route de redirection après connexion (ligne 54).
```

## Sécurité
#### Contrôle d'accèss par role
https://symfony.com/doc/current/security.html#securing-controllers-and-other-code

####Validation des formulaires avec les Assert
https://symfony.com/doc/current/validation.html

####Création de test d'accessibilité avec les voters
https://symfony.com/doc/current/security/voters.html

## Gestion des messages flash
https://symfony.com/doc/current/controller.html#flash-messages

## Bundle d'aide

#### Gedmo
https://symfony.com/bundles/StofDoctrineExtensionsBundle/current/index.html
https://github.com/doctrine-extensions/DoctrineExtensions/tree/main/doc

#### Vich Uploader
https://github.com/dustin10/VichUploaderBundle/blob/master/docs/generating_urls.md
