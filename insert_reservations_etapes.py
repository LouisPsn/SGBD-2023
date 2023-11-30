#open a file to write the sql commands
f = open('./sql/insert.sql', 'a')

#append the sql commands to the file
#refusé
f.write("INSERT INTO etapes (date, id_ville) VALUES ('2023-09-10', 1);\n")
f.write("INSERT INTO etapes (date, id_ville) VALUES ('2023-09-10', 2);\n")
f.write("INSERT INTO reservations (confirmation_reservation, id_voyage, date, etape_depart_resa, etape_arrive_resa, id_etudiant) VALUES ('refuse', 1, '2023-09-10', 1, 2, 1);\n")

#accepté
f.write("INSERT INTO etapes (date, id_ville) VALUES ('2023-11-27', 3);\n")
f.write("INSERT INTO etapes (date, id_ville) VALUES ('2023-11-27', 4);\n")
f.write("INSERT INTO reservations (confirmation_reservation, id_voyage, date, etape_depart_resa, etape_arrive_resa, id_etudiant) VALUES ('accepte', 2, '2023-11-27', 3, 4, 2);\n")

#en attente
f.write("INSERT INTO etapes (date, id_ville) VALUES ('2023-12-01', 5);\n")
f.write("INSERT INTO etapes (date, id_ville) VALUES ('2023-12-01', 6);\n")
f.write("INSERT INTO reservations (confirmation_reservation, id_voyage, date, etape_depart_resa, etape_arrive_resa, id_etudiant) VALUES ('attente', 3, '2023-12-01', 5, 6, 3);\n")

#close the file
f.close()