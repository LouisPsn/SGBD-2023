CREATE TYPE confirmation AS ENUM ('refuse', 'accepte', 'attente');

CREATE TABLE IF NOT EXISTS etudiants (
    id_etudiant SMALLSERIAL PRIMARY KEY,
    nom CHAR(32) NOT NULL,
    prenom CHAR(32) NOT NULL,
    mail CHAR(64) UNIQUE NOT NULL,
    mot_de_passe CHAR(64) NOT NULL,
    date_de_naissance TIMESTAMP without time zone NOT NULL
);


CREATE TABLE IF NOT EXISTS villes (
    id_ville SMALLSERIAL PRIMARY KEY,
    nom CHAR(32) NOT NULL
);

CREATE TABLE IF NOT EXISTS voitures (
    id_voiture SMALLSERIAL PRIMARY KEY,
    marque CHAR(32),
    modele CHAR(32),
    typ CHAR(32),
    couleur CHAR(32),
    etat CHAR(32),
    divers CHAR(64),
    id_etudiant SMALLSERIAL UNIQUE NOT NULL,
    FOREIGN KEY (id_etudiant) REFERENCES etudiants(id_etudiant)
);

CREATE TABLE IF NOT EXISTS etapes (
    id_etape SMALLSERIAL PRIMARY KEY,
    date TIMESTAMP NOT NULL,
    id_ville SMALLSERIAL NOT NULL,
    FOREIGN KEY (id_ville) REFERENCES villes(id_ville) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS voyages (
    id_voyage SMALLSERIAL PRIMARY KEY,
    nombre_places SMALLINT NOT NULL,
    id_voiture SMALLSERIAL NOT NULL,
    distance INT NOT NULL,
    FOREIGN key (id_voiture) REFERENCES voitures(id_voiture) ON DELETE CASCADE,
    etape_depart_voyage SMALLSERIAL NOT NULL,
    FOREIGN KEY (etape_depart_voyage) REFERENCES etapes(id_etape) ON DELETE CASCADE,
    etape_arrive_voyage SMALLSERIAL NOT NULL,
    FOREIGN KEY (etape_arrive_voyage) REFERENCES etapes(id_etape) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS avis (
    id_etudiant SMALLSERIAL NOT NULL,
    id_voyage SMALLSERIAL NOT NULL,
    FOREIGN KEY (id_etudiant) REFERENCES etudiants(id_etudiant) ON DELETE CASCADE,
    FOREIGN KEY (id_voyage) REFERENCES voyages(id_voyage) ON DELETE CASCADE,
    note SMALLINT CHECK (note <= 5 AND note > 0) NOT NULL
);

CREATE TABLE IF NOT EXISTS reservations (
    id_reservation SMALLSERIAL PRIMARY KEY,
    confirmation_reservation confirmation NOT NULL,
    id_voyage SMALLSERIAL NOT NULL,
    FOREIGN KEY (id_voyage) REFERENCES voyages(id_voyage),
    date TIMESTAMP NOT NULL,
    proposition_prix INT NOT NULL,
    etape_depart_resa SMALLSERIAL NOT NULL,
    FOREIGN KEY (etape_depart_resa) REFERENCES etapes(id_etape) ON DELETE CASCADE,
    etape_arrive_resa SMALLSERIAL NOT NULL,
    FOREIGN KEY (etape_arrive_resa) REFERENCES etapes(id_etape) ON DELETE CASCADE,
    id_etudiant SMALLSERIAL NOT NULL,
    FOREIGN KEY (id_etudiant) REFERENCES etudiants(id_etudiant) ON DELETE CASCADE
);
