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
    lista_productos = abrir_csv('productos')
    id_productos_repetidos = []
    new_productos = []
    for linea in lista_productos:
        if linea[0] not in id_productos_repetidos:
            id_productos_repetidos.append(linea[0])
            new_productos.append(linea)
    escribir_csv('productos', new_productos)

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
    lineas_clientes = abrir_csv('clientes')
    id_clientes = []
    new_lineas_clientes = []

    for linea in lineas_clientes:
        if linea[0] not in id_clientes:

            id_clientes.append(linea[0])
            agregar = [linea[0],linea[2], linea[1], linea[3],linea[4], linea[5], linea[6]]
            print(agregar)
            new_lineas_clientes.append(agregar)
            if linea[0] == '1':
                print("Usuario con ID 0")

    escribir_csv('clientes', new_lineas_clientes)

    # Venta y compra
    lineas_compras = abrir_csv('compras')
    # id_compra,fecha , producto ,id_cliente,id_tienda,cantidad
    # id_venta, id_compra, id_producto
    # id_venta, id_cliente, id_tienda, cantidad, fecha
    headerP = lineas_compras[0]
    escribirV = [['id', 'id_compra', 'id_producto']]
    escribirC = [['id_venta', 'id_cliente', 'id_tienda', 'cantidad','fecha']]

    ID_venta = 0

    ID_compras = []
    for linea in lineas_compras:
        if linea[0] != 'id_compra':
            if linea[3] in id_clientes:
                new_LV = [str(ID_venta), linea[0], linea[2]]
                ID_compras.append(linea[0])
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

    id_vehiculos = []

    for linea in lineas_vehiculo:
        if linea[0] != 'id':
            if linea[0] not in id_vehiculos:

                id_vehiculos.append(linea[0])


                num_region = random.randint(1, 2994)

                new_linea_patente = [linea[0], linea[1]]
                escribirP.append(new_linea_patente)
                new_linea_vehiculo = [linea[0], linea[2], linea[3], lineas_lugares[num_region][1]]
                escribirVE.append(new_linea_vehiculo)
    escribir_csv('patentes', escribirP)
    escribir_csv('vehiculos', escribirVE)

    # Despachos
    lineas_despachos = abrir_csv('despachos')

    # id_despacho,id_compra,fecha_entrega

    # id (Primary Key **añadir en code), id_despacho, id_compra,

    # id_entrega (Primary Key **añadir en code), fecha_entrega, ID_vehiculo

    HeaderDespachos = lineas_despachos[0]

    new_admin_despachos = [['id', HeaderDespachos[0], HeaderDespachos[1]]]
    new_despachos = [['id_entrega', HeaderDespachos[2], 'id_vehiculo']]

    id_entrega = 0
    max_id_vehiculos = len(id_vehiculos)

    for linea in lineas_despachos:
        if linea[0] != 'id_despacho':
            if linea[1] in ID_compras:


                id_vehiculo = random.randint(0, max_id_vehiculos-1)

                new_linea_admin_despachos = [str(id_entrega), linea[0], linea[1]]
                new_admin_despachos.append(new_linea_admin_despachos)

                new_linea_despachos = [str(id_entrega), linea[2], str(id_vehiculos[id_vehiculo])]
                new_despachos.append(new_linea_despachos)


                id_entrega += 1
    escribir_csv('despachos', new_despachos)
    escribir_csv('AdminDespachos', new_admin_despachos)

    # Repartidores, Conductores, RUTs y Licencias

    lineas_repartidores = abrir_csv('repartidores')

    # id,nombre,rut,edad,genero,id_vehiculo,es_chofer

    # Repartidores: id(Primary key), nombre, edad, genero, id_vehiculo, region(**añadir en code)

    # Conductores: id(Primary key ** code), id_vehiculo, id_repartidor

    # RUT: ID_repartidor (PRIMARY KEY), RUT

    # Licencias: id (Primary key),id_repartidor,fecha_emision,fecha_expiracion,tipo

    Repartidores = [['id', 'nombre', 'edad', 'genero', 'id_vehiculo', 'region']]
    Conductores = [['id', 'id_vehiculo', 'id_repartidor']]
    RUTS = [['id_repartidor', 'RUT']]

    lineas_licencia = abrir_csv('licencias')
    Licencia = [['id', 'id_repartidor', 'fecha_emision', 'fecha_expiracion', 'tipo']]
    id_licencias = []
    for linea in lineas_licencia:
        if linea[0] != 'id':
            if linea[0] not in id_licencias:
                id_licencias.append(linea[0])
                Licencia.append(linea)
    id_conductor = 0

    id_repartidores = []
    for linea in lineas_repartidores:
        if linea[0] != 'id':
            if linea[0] not in id_repartidores:
                id_repartidores.append(linea[0])
                Nregion = random.randint(1, 2994)

                Repartidores.append([linea[0], linea[1], linea[3], linea[4], linea[5], lineas_lugares[Nregion][1]])

                if linea[6] == 'YES':

                    Conductores.append([str(id_conductor), linea[5], linea[0]])
                    id_conductor += 1

                RUTS.append([linea[0], linea[2]])

    escribir_csv('licencias', Licencia)
    escribir_csv('repartidores', Repartidores)
    escribir_csv('conductores', Conductores)
    escribir_csv('ruts', RUTS)

print('extrayendo datos')
extraer_datos()
print('listo los datos')