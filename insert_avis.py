import pandas as pd

voyages = pd.read_csv('./donnees/voyages.csv', sep=';')
etudiants = pd.read_csv('./donnees/etudiants.csv', sep=';')

#open a file to write the sql commands
f = open('./sql/insert.sql', 'a')


#append the sql commands to the file
for i in range(len(voyages)):
    lenght = min(len(etudiants), int(voyages['nombre_places'][i]))
    avis = 1
    for j in range(lenght):
        f.write("INSERT INTO avis (id_etudiant, id_voyage, note) VALUES ("+
            str(j + 1)+","+
            str(i + 1)+","+
            str(avis)+
            ");\n")
        if (avis == 5):
            avis = 1
        else:
            avis += 1

#close the file
f.close()