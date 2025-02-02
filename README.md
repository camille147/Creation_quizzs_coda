Projet Camille PINAULT - Création de quizz

Fonctionalité manquantes dû à un manque de temps à cause d'une semaine d'absence:
- les tries sur les colonnes
- le drage and drop
- les boutons ajouter ne sont que des boutons visuels et interactifs, l'enregistrement n'est pas possible
- Faker ne fonctionne pas dû à des accès à des variables et àa des fichiers je suppose

La racine du projet est l'endroit où est le dossier mvc

Installation:

- Clonez le dépôt dans htdocs et démarrez MySQL et Apache sur XAMPP.
- Dans le fichier .env.dist, remplissez les variables d'environnement, puis renommez le fichier en .env
- Créez une base de données puis importez le fichier base_de_donnee.sql qui se trouve à la racine du projet.
- Initialisez Faker PHP avec ces ligne de commandes dans le projet :
    composer install
    composer require fakerphp/faker
- Allez à l'aide du terminal dans mvc/scripts/ et Faites cette ligne
    php fixtures.php
- Allez sur votre navigateur et entrez l'URL :  127.0.0.1/creation_quizzs_coda/mvc/index.php
Adaptez-la si necessaire à votre environnement
- Pour passez le login, l'identifiant et le mot de passe sont camille et camille

