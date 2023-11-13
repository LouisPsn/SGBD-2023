CREATE TABLE IF NOT EXISTS etudiants (
    id_etudiant SMALLSERIAL PRIMARY KEY,
    nom CHAR(32) UNIQUE NOT NULL,
    prenom CHAR(32) UNIQUE NOT NULL,
    mail CHAR(64) NOT NULL,
    note FLOAT
);


CREATE TABLE IF NOT EXISTS dates (
    id_dates SMALLSERIAL PRIMARY KEY,
    dat TIMESTAMP UNIQUE NOT NULL
);


CREATE TABLE IF NOT EXISTS voyages (
    id_voyages SMALLSERIAL PRIMARY KEY,
    FOREIGN KEY id_dates REFERENCES dates(id_dates)
);


CREATE TABLE IF NOT EXISTS reservations (
    id_reservations SMALLSERIAL PRIMARY KEY,
    FOREIGN KEY (id_voyage) REFERENCES voyages(id_voyage)
);


CREATE TABLE IF NOT EXISTS villes (
    id_ville SMALLSERIAL PRIMARY KEY,
    nom CHAR(32)
);


CREATE TABLE IF NOT EXISTS voiture (
    id_voitures SMALLSERIAL PRIMARY KEY,
    marque CHAR(32),
    typ CHAR(32),
    couleur CHAR(32),
    nombre_places SMALLINT NOT NULL,
    état CHAR(32),
    divers CHAR(64),
    FOREIGN KEY (id_etudiants) REFERENCES etudiants(id_etudiants)
);