import pandas as pd
raw_data = pd.read_csv('./donnees/reservations.csv', sep=';')

#open a file to write the sql commands
f = open('./sql/insert.sql', 'a')

#append the sql commands to the file
for i in range(len(raw_data)):
    f.write("INSERT INTO reservations (id_voyage, id_date, id_ville, id_etudiant) VALUES ('"+i+"','"+i+"','"+i+"','"+i+"');\n")

#close the file
f.close()