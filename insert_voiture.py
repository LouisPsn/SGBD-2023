
voitures_csv_file = open("donnees/voitures.csv", "r")
insert_sql_file = open("sql/insert.sql", "r")



for line in voitures_csv_file:
    line = line.split(";")
    print(line)