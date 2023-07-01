<?php include('templates/header.html');   ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <style>
        h2 {
            font-size: 1.75rem;
        }
        h3 {
            font-size: 1.5rem;
        }
        html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            -webkit-text-size-adjust: 100%;
        }
        header {
            background-color: rgba(255, 255, 255, 0.08);
            width: 100%;
            padding: 2rem;
            margin: 0;
            text-align: left;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-direction: row;
        }
        form {
            background-color: rgba(255, 255, 255, 0.08);
            padding: 2rem;
            border-radius: 1rem;
            width: 70%;
        }
        @media (max-width: 768px) {
            form {
                width: 90%;
            }
        }
        body {
            color: whitesmoke;
            width: 100%;
            background-color: #121212;
            min-height: 100%;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            margin: 0;
        }
        .btn-primary {
            font: inherit;
            background-color: rgba(255, 255, 255, 0.16);
            border-color: rgba(255, 255, 255, 0.16);
            border-radius: 0.5rem;
        }
        .btn-primary:hover {
            background-color: rgba(255, 255, 255, 0.24);
            border-color: rgba(255, 255, 255, 0.24);
        }
        .btn-primary:active {
            background-color: rgba(255, 255, 255, 0.32);
            border-color: rgba(255, 255, 255, 0.32);
        }
        .btn-primary:focus {
            background-color: rgba(255, 255, 255, 0.32);
            border-color: rgba(255, 255, 255, 0.32);
        }
        .btn-primary:disabled {
            background-color: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.08);
        }
        .container {
            width: 100%;
            display: flex;
            padding: 2rem;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.75rem;
        }
        th, td {
            text-align: center;
            border: 1px solid whitesmoke;
            padding: 1rem;
        }
        select, input {
            max-width: 90%;
        }
    </style>
    <body>
    <h1>Mis compras</h1>
<?php
$dbname2 = 'grupo47e3';
$user2 = 'grupo47';
$password2 = 'clavemuysegura';

$host = 'localhost';
$port = '5432';
$dbname = 'grupo54e3';
$user = 'grupo54';
$password = '!SVGrupo54';


$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";
$dsn2 = "pgsql:host=$host;port=$port;dbname=$dbname2;user=$user2;password=$password2";

try {
// Crear una instancia de PDO para la conexión
    $pdo = new PDO($dsn);
    $pdo2 = new PDO($dsn2);

// Establecer atributos de la conexión (opcional)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $id = $_POST['id'];
    # $id = 966;
    $query = "SELECT * FROM clientes WHERE id = $id";


    $result = $pdo -> prepare($query);
    $result -> execute();
    $usuario = $result -> fetch();
    $username = $usuario['nombre'];
    echo "<h1>$username</h1>";


    $query = "SELECT V.id_compra 
          FROM Venta V 
          INNER JOIN Compras C ON V.id = C.id_venta 
          WHERE C.id_cliente = $id";

    $result = $pdo->prepare($query);
    $result->execute();
    $carritos = $result -> fetchAll();



    # ver para que no se repitan los id_compra
    $id_compras = [];
    foreach ($carritos as $carrito) {
        $id_compra = $carrito['id_compra'];

        // Verificar si el id_compra ya existe en el array
        if (!in_array($id_compra, $id_compras)) {
            // Agregar el id_compra al array
            $id_compras[] = $id_compra;
        }
    }


    foreach ($id_compras as $compra){
        $costototal = 0;

        echo "<br>";
        echo "<br>";


        echo "<table>";
        echo "<tr>";
        echo "<th> ID de la compra </th>";
        echo "<th> nombre producto </th>";
        echo "<th> cantidad </th>";
        echo "<th> cajas </th>";
        echo "<th> costo </th>";

        echo "</tr>";

        $query = "SELECT *
          FROM Venta V 
          INNER JOIN Compras C ON V.ID = C.ID_venta 
          INNER JOIN Productos P ON V.id_producto = P.ID
          WHERE C.id_cliente = $id AND V.id_compra = $compra";
        $result = $pdo->prepare($query);
        $result->execute();
        $ventas = $result ->fetchAll();


        foreach ($ventas as $venta){



            # ver id de la compra/venta nombre productos, precios, numero de cajas cada producto, precio total y despacho
            $nombre = $venta['nombre'];
            $cantidad = intval($venta['cantidad']);
            $cajas = intval($venta['numero_cajas']) * $cantidad;


            $tienda = $venta['id_tienda'];
            $producto_id = $venta['id_producto'];

            $query = "SELECT descuento FROM ofertas WHERE tienda_id = $tienda AND producto_id = $producto_id";
            $result = $pdo2->prepare($query);
            $result->execute();
            $oferta = $result ->fetch();
            if (is_null($oferta[0])|| $oferta[0] == 0){
                $precio = $cantidad * intval($venta['precio']);

            }else{
                $precio = ($cantidad * intval($venta['precio'])) * $oferta[0]/ 100 ;

            }
            $costototal += $precio;

             # ver para el precio con las ofertas
            $fecha = $venta['fecha'];
            echo "<tr> <td> $compra</td> <td>$nombre</td> <td>$cantidad</td> <td>$cajas</td> <td>$precio </td></tr>";
        }

        echo "</table>";
        echo "<h2>Costo total = $costototal $ </h2>";

    }

    $pdo = null;
} catch (PDOException $e) {
    echo "<h1>F fallo</h1>";
    echo "Error de conexión: " . $e->getMessage();
}
?>
<br>
<?php include('../templates/footer.html');   ?>