#!/usr/bin/bash

# pour démarrer postgresql
sudo service postgresql start

# pour créer les fichiers qui contiennent toutes les données pour accéder automatiquement à la base de données
if [ ! -e ".env" ] || [ ! -e "database.ini" ];
then
    echo PGHOST='localhost' > .env
    echo PGPORT='5432' >> .env
    read -s -p "Saisir mot de passe de la base de données : " PASSWORD
    echo PGPASSWORD="'$PASSWORD'" >> .env

    echo host=localhost > database.ini
    echo port=5432 >> database.ini
    echo password="$PASSWORD" >> database.ini
fi

# If psql is not available, then exit
if ! command -v psql > /dev/null ; then
    echo "This script requires psql to be installed and on your PATH. Exiting"
    exit 1
fi

# Load database connection info
set -o allexport
source .env
set +o allexport

# Connect to the database, run the query, then disconnect
psql -f sql/create.sql

# Ajouter les inserts python en commançant par le insert.py écrasant le fichier insert.sql

python insert_etudiants.py
python insert_voitures.py
python insert_villes.py

psql -f sql/insert.sql
psql -f sql/select.sql
php -t src/ -S localhost:8000
psql -f sql/drop.sql