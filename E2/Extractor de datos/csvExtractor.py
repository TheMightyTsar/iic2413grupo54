def abrir_csv(archivo):
    carpeta = 'Datos/'
    texto = open(f'{carpeta}{archivo}.csv', "r", encoding="utf-8")
    lineas = texto.readlines()
    texto.close()
    return lineas


def escribir_csv(archivo, lineas):
    carpeta = 'PoblarTablas/'

    with open(f'{carpeta}{archivo}.csv', "w", encoding="utf-8") as archivo_csv:
        # Escribir los datos en el archivo
        for fila in lineas:
            linea = ','.join(str(valor) for valor in fila)  # Convertir los valores de la fila en una línea de texto separada por comas
            archivo_csv.write(linea + '\n')  # Escribir la línea en el archivo


    return lineas


def extraer_datos():
    # Productos
    lineas_productos = abrir_csv('productos')

    # se trabaja la lista
    lista_id = []
    sublista = None
    lista_listas = []
    linea = None
    for elem in lista_txt:
        linea = elem.split(",")
    return lista_listas
