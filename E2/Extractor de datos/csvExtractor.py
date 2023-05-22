import random

def abrir_csv(archivo):
    carpeta = 'Datos/'
    texto = open(f'{carpeta}{archivo}.csv', "r", encoding="utf-8")
    lineas = texto.readlines()
    texto.close()
    datos = []
    for linea in lineas:
        fila = linea.strip().split(',')

        datos.append(fila)

    return datos


def escribir_csv(archivo, lineas):
    carpeta = 'PoblarTablas/'

    with open(f'{carpeta}{archivo}.csv', "w", encoding="utf-8") as archivo_csv:
        # Escribir los datos en el archivo
        for fila in lineas:

            linea = ','.join(str(valor) for valor in fila)

            archivo_csv.write(linea + '\n')  # Escribir la línea en el archivo


    return lineas


def extraer_datos():
    # Productos
    escribir_csv('productos', abrir_csv('productos'))

    # distribucion Cajas y Cajas
    lineas_cajas = abrir_csv('cajas')
    headerDC = lineas_cajas[0]

    # [id_caja, id_producto, peso, descripcion] -> [id_producto, n_caja]
    DistribucionCajas = [['ID_caja', headerDC[1], 'n_caja']]
    TablaCajas = [['id_caja', headerDC[2], headerDC[3]]]

    ID_caja = 0
    for linea in lineas_cajas:
        if linea[0] != 'id':
            new_lineaDC = [str(ID_caja), linea[1], linea[0]]
            DistribucionCajas.append(new_lineaDC)
            new_lineaTC = [str(ID_caja), linea[2], linea[3]]
            TablaCajas.append(new_lineaTC)
            ID_caja += 1
    escribir_csv('distribucioncajas', DistribucionCajas)
    escribir_csv('cajas', TablaCajas)

    # Clientes

    escribir_csv('clientes', abrir_csv('clientes'))

    # Venta y compra
    lineas_compras = abrir_csv('compras')
    # id_compra,fecha , producto ,id_cliente,id_tienda,cantidad
    # id_venta, id_compra, id_producto
    # id_venta, id_cliente, id_tienda, cantidad, fecha
    headerP = lineas_compras[0]
    escribirV = [['id', 'id_compra', 'id_producto']]
    escribirC = [['id_venta', 'id_cliente', 'id_tienda', 'cantidad','fecha']]

    ID_venta = 0
    for linea in lineas_compras:
        if linea[0] != 'id_compra':
            new_LV = [str(ID_venta), linea[0], linea[2]]
            escribirV.append(new_LV)
            new_LC = [str(ID_venta), linea[3], linea[4], linea[5], linea[1]]
            escribirC.append(new_LC)
            ID_venta +=1
    escribir_csv('venta', escribirV)
    escribir_csv('compra', escribirC)

    # Vehiculos y Patentes
    # id,patente,capacidad_carga(Toneladas),cantidad_personas ->
    # id,capacidad_carga(Toneladas),cantidad_personas, region

    # id, patente
    lineas_vehiculo = abrir_csv('vehiculos')
    lineas_lugares = abrir_csv('comuna_region')
    max_region = len(lineas_lugares)
    headerV = lineas_vehiculo[0]
    escribirP = [['id_vehiculo', 'patente']]
    escribirVE = [['id', 'capacidad_carga(toneladas)', 'cantidad_personas', 'region']]

    for linea in lineas_vehiculo:
        if linea[0] != 'id':
            num_region = random.randint(1, 2994)
            print(num_region)
            new_linea_patente = [linea[0], linea[1]]
            escribirP.append(new_linea_patente)
            new_linea_vehiculo = [linea[0], linea[2], linea[3], lineas_lugares[num_region][1]]
            escribirVE.append(new_linea_vehiculo)
    escribir_csv('patentes', escribirP)
    escribir_csv('vehiculos', escribirVE)

    # Despachos

print('extrayendo datos')
extraer_datos()
print('listo los datos')