def extraer_datos_productos():
    # se abre el archivo
    txt_open = open(".csv", "r", encoding="utf-8")
    lista_txt = txt_open.readlines()
    txt_open.close()

    # se trabaja la lista
    lista_id = []
    sublista = None
    lista_listas = []
    linea = None
    for elem in lista_txt:
        linea = elem.split(",")
    return lista_listas



