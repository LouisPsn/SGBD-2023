# Projet SGBD : Covoiturage sur le campus

<!-- [![forthebadge](https://forthebadge.com/images/featured/featured-built-with-love.svg)](https://forthebadge.com) -->

Projet d'initiation à la gestion et l'utilisation de bases de données.

## Pour commencer

Ce projet est hebergé localement en utilisant Postgresql. Il y a donc quelques manipulations à faire avant de pouvoir le visualiser.

### Pré-requis

Ce qu'il est requis pour lancer le projet :

- Postgresql
- Python3
- Module pandas de python

### Installation

Afin de pouvoir lancer le projet il vous faut un utilisateur ainsi qu'une base de donnée Postgresql.
Si ce n'est pas le cas veuillez suivre ces instructions :

    $ sudo -i -u postgres
    $ psql

    CREATE USER nom de session WITH PASSWORD 'nom de session';
    CREATE DATABASE 'nom de session';
    GRANT ALL ON DATABASE 'nom de session' TO 'nom de session';
    ALTER DATABASE 'nom de session' OWNER TO 'nom de session';

Ensuite dans les fichiers **.env** et dans **database.ini** rentré votre propre password.

## Démarrage

Pour lancer le site faites :

`$ ./start.sh`

## Fabriqué avec

- [Psql](https://www.postgresql.fr/) - gestionnaire de bases de données
- [Vscode](http://materializecss.com) - Editeur de textes
- [Bootstrap](https://getbootstrap.com/) - (front-end)

## Auteurs

- **Bastien Hugo** _alias_ [@Hugoooz12](https://github.com/Hugoooz12)

- **Durand Arthur** _alias_ [@Arthurr-Durand](https://github.com/Arthurr-Durand)

- **Pierson Louis** _alias_ [@LouisPsn](https://github.com/LouisPsn)

- **Vernant Charlène** _alias_ [@charlene-vernant](https://github.com/charlene-vernant)
