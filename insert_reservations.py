#open a file to write the sql commands
f = open('./sql/insert.sql', 'a')

#append the sql commands to the file
#refusé
f.write("INSERT INTO reservations (confirmation_reservation, id_voyage, date, id_ville_depart, id_ville_arrive, id_etudiant) VALUES ('refuse', '1', '2023-09-10', '1', '1', '1');\n")

#accepté
f.write("INSERT INTO reservations (confirmation_reservation, id_voyage, date, id_ville_depart, id_ville_arrive, id_etudiant) VALUES ('accepte', '2', '2023-11-27', '2', '2', '2');\n")

#en attente
f.write("INSERT INTO reservations (confirmation_reservation, id_voyage, date, id_ville_depart, id_ville_arrive, id_etudiant) VALUES ('attente', '3', '2023-12-01', '3', '3', '3');\n")

#close the file
f.close()