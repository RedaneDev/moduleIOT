# devSite1

## Online

&nbsp;

pour accéder au site en ligne se rendre sur cette adresse  

https://redanedev.fr/moduleiot/

pour accéder à la base de donnée en ligne se rendre sur cette adresse

https://phpmyadmin.redanedev.fr/

Voici les identifiants pour accéder à la base de donnée

- user:

        webreathe

- password:

        webreathe

&nbsp;

## Installation

&nbsp;

### Prérequis

&nbsp;

***php*** => 7.4

***composer*** => 2.3.9

***BDD*** => mariadb-10.6.7

&nbsp;

### Téléchargement

&nbsp;

Télécharger le projet zipper depuis cette url

https://www.swisstransfer.com/d/3ac0ab81-1a73-4d32-bf3f-7a990186f3d1

&nbsp;

### Déployement

&nbsp;

à la racine du projet tapez

        composer install

créer le fichier ***.env.local*** à la racine du projet et y mettre ceci

        APP_ENV=prod
        APP_SECRET=b879d89158a8b501fbb46d98b469cc4d
        DATABASE_URL="mysql://user:password@127.0.0.1:3306/devSite1?serverVersion=mariadb-10.6.7&charset=utf8mb4"

Dans la variable **DATABASE_URL** remplacer **user** par le nom de l'utilisateur de la base de donnée et **password** par le mot de passe de l'utilisateur de la base de donnée
