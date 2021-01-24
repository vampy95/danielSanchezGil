#!/usr/bin/python3
#importamos la libreria para conectarnos a PostgreSQL
import psycopg2
import sys
import pandas as pd
import numpy as np

try:
        #conectamos a la base de datos
        conn = psycopg2.connect(host='localhost',dbname='daniel',user='postgres',password='root',port='5432')                             
        #creamos el cursor
        cur = conn.cursor()        
        #Ruta del csv que paso por parametro al lanzar el script
        csvFileName = sys.argv[1];

        #Si se descomentan los comentarios podemos ver la informacion con pandas
        #df = pd.read_csv(csvFileName, sep = ';')
        #Creamos un dataFrame
        #dfObj = pd.DataFrame(df, columns=['id', 'zona', 'fecha_desde', 'fecha_hasta'])

        #print("Obtener fecha_desde(inicial) y fecha_hasta(final) para un mismo id")
        #fechaId = dfObj.groupby('id').agg({'fecha_desde': ['min'],'fecha_hasta': ['max']})
        #print(fechaId)
        
        #print("Obtener registros duplicados")
        #duplicados = dfObj[dfObj.duplicated()]
        #print(duplicados)

        #print("Encontrar registros erroneos")
        #erroneos = dfObj[df['fecha_desde'] > df['fecha_hasta']]
        #print(erroneos)

        #Leer csv y insertar informacion en la base de datos
        sql = "COPY csvs FROM STDIN DELIMITER ';' CSV HEADER"
        cur.copy_expert(sql, open(csvFileName, "r"))

        print("Exito al leer el fichero!")
    
except Exception as e:

        print("Error al leer el fichero!")
        sys.exit(1)

finally:

        #Guardamos los cambios
        conn.commit()
        #Cerramos conexion a la base de datos
        conn.close()
