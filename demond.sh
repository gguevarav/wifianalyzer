#!/bin/bash
# Script que será utilizado para crear logs a partir de la salida del comando iwconfig
# será configurado como un demonio para que muestre la información en tiempo real
# la información posteriormente será parseada y cargada a un sofware web en PHP
# 
# Gemis Daniel Guevara Villeda
# 17 de junio del 2020 21:46 pm
#

# Primero validaremos si existe o no el archivo de logs
if [ -f ./logs.txt ];
then
    # Si existe el archivo solo cargaremos la salida del comando.
    # Primero obtendremos el valor id del objeto a escribir
    idobjeto=$(tail -n 1 logs.txt)

    # Agregamos la hora y fecha en que se genero para poder usar una escala de tiempo
    # primero creamos un par de variables
    DIA=`date +"%d/%m/%Y"`
    HORA=`date +"%H:%M:%S"`

    # Primero el dia
    echo $DIA >> logs.txt
    # Luego la hora
    echo $HORA >> logs.txt

    # Enviamos la información al archivo
    iwconfig >> logs.txt

    # Luego escribimos la última línea con el valor id obtenido y le sumamos 1
    
    echo $((idobjeto+1)) >> logs.txt

else
    # No existe el archivo, primero inicializamos el archivo con un id
    echo "0" >> logs.txt

    # Agregamos la hora y fecha en que se genero para poder usar una escala de tiempo
    # primero creamos un par de variables
    DIA=`date +"%d/%m/%Y"`
    HORA=`date +"%H:%M:%S"`

    # Primero el dia
    echo $DIA >> logs.txt
    # Luego la hora
    echo $HORA >> logs.txt

    # Luego enviamos la salida del comando iwconfig al archivo
    iwconfig >> logs.txt

    # Escribimos el id del siguiente objeto
    echo "1" >> logs.txt
fi

#Fin del archivo