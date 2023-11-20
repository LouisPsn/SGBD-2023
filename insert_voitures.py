import pandas as pd

raw_data = pd.read_csv('./donnees/voitures.csv', sep=';')

#open a file to write the sql commands
f = open('./sql/insert.sql', 'a')

i = 0

#append the sql commands to the file
for i in range(len(raw_data)):
    f.write("INSERT INTO voitures (marque, modele, typ, couleur, etat, divers, id_etudiant) VALUES ('"+
            raw_data['marque'][i]+"','"+
            raw_data['modele'][i]+"','"+
            raw_data['type'][i]+"','"+
            raw_data['couleur'][i]+"','"+
            raw_data['etat'][i]+"','"+
            raw_data['divers'][i]+"', "+
            str(i)
            ");\n")
    i += 1
#close the file
f.close()