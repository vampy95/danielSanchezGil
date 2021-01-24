#!/usr/bin/python3
#importamos la libreria para conectarnos a PostgreSQL
import psycopg2 
import sys

try:
	#Pasamos el nombre de la ruta del csv por parametro
	rutaCsv = sys.argv[1];
    #connect to the database
    conn = psycopg2.connect(host='localhost',dbname='daniel',user='postgres',password='root',port='5432')                                
    #creamos el cursor
    cur = conn.cursor()
    #Leer csv y insertar informacion en la base de datos
    csv_file_name = 'C:\python\data.csv'
    sql = "COPY csv FROM STDIN DELIMITER ';' CSV HEADER"
    cur.copy_expert(sql, open(rutaCsv, "r"))

    print("Exito al leer el fichero")
    
except Exception as e: 

    print("Error al leer el fichero: ", e)
  
finally:
    
    #Guardamos los cambios
    conn.commit()
    #Cerramos conexion a la base de datos
    conn.close()
