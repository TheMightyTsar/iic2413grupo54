def abrir_csv(archivo):
    carpeta = 'Datos/'
    texto = open(f'{carpeta}{archivo}.csv', "r", encoding="utf-8")
    lineas = texto.readlines()
    texto.close()
    return lineas


def extraer_datos():
    


    # se trabaja la lista
    lista_id = []
    sublista = None
    lista_listas = []
    linea = None
    for elem in lista_txt:
        linea = elem.split(",")
    return lista_listas



