import pandas as pd
raw_data = pd.read_csv('./donnees/voitures.csv', sep=';')

#open a file to write the sql commands
f = open('./sql/insert.sql', 'a')

#append the sql commands to the file
for i in range(len(raw_data)):
    f.write("INSERT INTO voitures (marque, typ, couleur, nombre_places, etat, divers, id_etudiant) VALUES ('"+
            raw_data['marque'][i]+"','"+
            raw_data['type'][i]+"','"+
            raw_data['couleur'][i]+"','"+
            str(raw_data['nombre_places'][i])+"','"+
            raw_data['etat'][i]+"','"+
            raw_data['divers'][i]+"', "+
            str(i)+
            ");\n")

#close the file
f.close()