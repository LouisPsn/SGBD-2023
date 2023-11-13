CREATE TABLE IF NOT EXISTS etudiants (
    id_etudiant SMALLSERIAL PRIMARY KEY,
    nom CHAR(32) UNIQUE NOT NULL,
    prenom CHAR(32) UNIQUE NOT NULL,
    mail CHAR(64) NOT NULL,
    note FLOAT
);


CREATE TABLE IF NOT EXISTS dates (
    id_date SMALLSERIAL PRIMARY KEY,
    dat TIMESTAMP UNIQUE NOT NULL
);


CREATE TABLE IF NOT EXISTS voyages (
    id_voyage SMALLSERIAL PRIMARY KEY,
    nombre_places SMALLINT NOT NULL,
    id_voiture SMALLSERIAL,
    FOREIGN key (id_voiture) REFERENCES voitures(id_voiture)
);

CREATE TABLE IF NOT EXISTS avis (
    id_avis SMALLSERIAL PRIMARY KEY,
    id_etudiant SMALLSERIAL,
    FOREIGN KEY (id_etudiant) REFERENCES etudiants(id_etudiant),
    id_voyage SMALLSERIAL,
    FOREIGN KEY (id_voyage) REFERENCES voyages(id_voyage),
    note SMALLINT CHECK (note <= 5)
);

CREATE TABLE IF NOT EXISTS reservations (
    id_reservation SMALLSERIAL PRIMARY KEY,
    id_voyage SMALLSERIAL,
    FOREIGN KEY (id_voyage) REFERENCES voyages(id_voyage),
    id_date SMALLSERIAL,
    FOREIGN KEY (id_date) REFERENCES dates(id_date),
    id_ville SMALLSERIAL,
    FOREIGN KEY (id_ville) REFERENCES villes(id_ville),
    id_etudiant SMALLSERIAL,
    FOREIGN KEY (id_etudiant) REFERENCES etudiants(id_etudiant)
);


CREATE TABLE IF NOT EXISTS villes (
    id_ville SMALLSERIAL PRIMARY KEY,
    nom CHAR(32)
);

CREATE TABLE IF NOT EXISTS destinations (
    id_destination SMALLSERIAL PRIMARY KEY,
    id_date SMALLSERIAL,
    FOREIGN KEY (id_date) REFERENCES dates(id_date),
    id_ville SMALLSERIAL,
    FOREIGN KEY (id_ville) REFERENCES villes(id_ville),
    id_voyage SMALLSERIAL,
    FOREIGN key (id_voyage) REFERENCES voyages(id_voyage)
);

CREATE TABLE IF NOT EXISTS voitures (
    id_voiture SMALLSERIAL PRIMARY KEY,
    marque CHAR(32),
    modele CHAR(32),
    typ CHAR(32),
    couleur CHAR(32),
    etat CHAR(32),
    divers CHAR(64),
    id_etudiant SMALLSERIAL NOT NULL,
    FOREIGN KEY (id_etudiant) REFERENCES etudiants(id_etudiant)
);