import pandas as pd
raw_data = pd.read_csv('./donnees/dates.csv', sep=';')

#open a file to write the sql commands
f = open('./sql/insert.sql', 'a')

#append the sql commands to the file
for i in range(len(raw_data)):
    f.write("INSERT INTO dates (dat) VALUES ('"+raw_data['date'][i]+"');\n")

#close the file
f.close()