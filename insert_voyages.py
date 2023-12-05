import pandas as pd

raw_data = pd.read_csv('./donnees/voyages.csv', sep=';')

#open a file to write the sql commands
f = open('./sql/insert.sql', 'a')

conducteur = 2

#append the sql commands to the file
for i in range(len(raw_data)):
    f.write("INSERT INTO etapes (date, id_ville) VALUES ('2023-09-10', '"+str(i+1)+"');\n")
    f.write("INSERT INTO etapes (date, id_ville) VALUES ('2023-09-10', '"+str(i+2)+"');\n")
    f.write("INSERT INTO voyages (nombre_places, id_voiture, distance, etape_depart_voyage, etape_arrive_voyage) VALUES ("+
            str(raw_data['nombre_places'][i])+","+
            str(raw_data['id_voiture'][i])+","+
            str(raw_data['distance'][i])+","+
            str(i+1)+","+
            str(i+2)+
            ");\n")
    i += 1

#close the file
f.close()