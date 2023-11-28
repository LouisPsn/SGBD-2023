CREATE TABLE IF NOT EXISTS etudiants (
    id_etudiant SMALLSERIAL PRIMARY KEY,
    nom CHAR(32) UNIQUE NOT NULL,
    prenom CHAR(32) UNIQUE NOT NULL,
    mail CHAR(64) NOT NULL,
    mot_de_passe CHAR(64) NOT NULL,
    date_de_naissance TIMESTAMP without time zone NOT NULL
);


CREATE TABLE IF NOT EXISTS villes (
    id_ville SMALLSERIAL PRIMARY KEY,
    nom CHAR(32)
);

CREATE TABLE IF NOT EXISTS voitures (
    id_voiture SMALLSERIAL PRIMARY KEY,
    marque CHAR(32),
    modele CHAR(32),
    typ CHAR(32),
    couleur CHAR(32),
    etat CHAR(32),
    divers CHAR(64),
    id_etudiant SMALLSERIAL,
    FOREIGN KEY (id_etudiant) REFERENCES etudiants(id_etudiant) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS voyages (
    id_voyage SMALLSERIAL PRIMARY KEY,
    nombre_places SMALLINT NOT NULL,
    id_voiture SMALLSERIAL,
    FOREIGN key (id_voiture) REFERENCES voitures(id_voiture) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS etapes (
    date TIMESTAMP,
    id_ville SMALLSERIAL,
    FOREIGN KEY (id_ville) REFERENCES villes(id_ville) ON DELETE CASCADE,
    id_voyage SMALLSERIAL,
    FOREIGN key (id_voyage) REFERENCES voyages(id_voyage) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS avis (
    id_etudiant SMALLSERIAL,
    id_voyage SMALLSERIAL,
    FOREIGN KEY (id_etudiant) REFERENCES etudiants(id_etudiant) ON DELETE CASCADE,
    FOREIGN KEY (id_voyage) REFERENCES voyages(id_voyage) ON DELETE CASCADE,
    note SMALLINT CHECK (note <= 5 AND note > 0)
);

CREATE TABLE IF NOT EXISTS reservations (
    id_reservation SMALLSERIAL PRIMARY KEY,
    confirmation SMALLINT CHECK (confirmation <= 1),
    id_voyage SMALLSERIAL,
    FOREIGN KEY (id_voyage) REFERENCES voyages(id_voyage) ON DELETE CASCADE,
    date TIMESTAMP,
    id_ville_depart SMALLSERIAL,
    FOREIGN KEY (id_ville_depart) REFERENCES villes(id_ville) ON DELETE CASCADE,
    id_ville_arrive SMALLSERIAL,
    FOREIGN KEY (id_ville_arrive) REFERENCES villes(id_ville) ON DELETE CASCADE, 
    id_etudiant SMALLSERIAL,
    FOREIGN KEY (id_etudiant) REFERENCES etudiants(id_etudiant) ON DELETE CASCADE
);
