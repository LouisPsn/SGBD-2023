import pandas as pd

raw_data = pd.read_csv('./donnees/etudiants.csv', sep=';')

#open a file to write the sql commands
f = open('./sql/insert.sql', 'w')

#append the sql commands to the file
for i in range(len(raw_data)):
    f.write("INSERT INTO etudiants (nom, prenom, mail, mot_de_passe, date_de_naissance) VALUES ('"+
        raw_data['nom'][i]+"','"+
        raw_data['prenom'][i]+"','"+
        raw_data['mail'][i]+"','"+
        raw_data['mot_de_passe'][i]+"',"+
        str(raw_data['date_de_naissance'][i])+
        ");\n")

#close the file
f.close()