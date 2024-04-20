# ModuleIOT

TEST RÉALISÉ SOUS PHP 7.4 & SYMFONY 5.4

1. Créer le fichier `.env.local`.

2. Dans ce fichier, entrer l'URL de la base de données avec ses identifiants selon le format suivant :
    ```
    DATABASE_URL=mysql://username:password@localhost:3306/nom_de_la_base_de_donnees
    ```
   Remplacez `username`, `password` et `nom_de_la_base_de_donnees` par vos propres informations.

3. Installer composer, exécutez la commande suivante dans le terminal :
   ```
   composer install
   ```
   
4. Pour créer la base de données, exécutez la commande suivante dans le terminal :
    ```
    php bin/console doctrine:database:create
    ```
    Suivez les instructions et entrez "Yes" lorsque vous y êtes invité.

5. Pour créer les tables et les champs via les migrations, exécutez la commande suivante :
    ```
    php bin/console doctrine:migrations:migrate
    ```

7. Enfin, lancez votre serveur local PHP ou Symfony pour exécuter l'application.

8. Pour acceder à l'application il faut : votrelocalhost/moduleiot

