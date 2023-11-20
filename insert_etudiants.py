import pandas as pd
raw_data = pd.read_csv('./donnees/etudiants.csv', sep=';')

#open a file to write the sql commands
f = open('./sql/insert.sql', 'a')

#append the sql commands to the file
for i in range(len(raw_data)):
    f.write("INSERT INTO etudiants (nom, prenom, mail, note) VALUES ('"+str(i)+raw_data['nom'][i]+"','"+raw_data['prenom'][i]+"','"+raw_data['mail'][i]+"');\n")

#close the file
f.close()