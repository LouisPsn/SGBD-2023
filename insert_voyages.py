import pandas as pd

raw_data = pd.read_csv('./donnees/voyages.csv', sep=';')

#open a file to write the sql commands
f = open('./sql/insert.sql', 'a')

conducteur = 2

#append the sql commands to the file
for i in range(len(raw_data)):
    f.write("INSERT INTO voyages (nombre_places, id_voiture) VALUES ("+
            str(raw_data['nombre_places'][i])+","+
            str(raw_data['id_voiture'][i])+
            ");\n")
    i += 1

#close the file
f.close()