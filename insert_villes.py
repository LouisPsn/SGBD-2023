import pandas as pd
raw_data = pd.read_csv('./donnees/villes.csv', sep=';')

#open a file to write the sql commands
f = open('./sql/insert.sql', 'a')

#append the sql commands to the file
for i in range(len(raw_data)):
    f.write("INSERT INTO villes (nom) VALUES ('"+raw_data['nom'][i]+"');\n")

#close the file
f.close()