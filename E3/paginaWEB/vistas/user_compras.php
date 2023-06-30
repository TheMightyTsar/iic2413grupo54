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
$host = 'localhost';
$port = '5432';
$dbname = 'grupo54e3';
$user = 'grupo54';
$password = '!SVGrupo54';


$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";

try {
// Crear una instancia de PDO para la conexión
    $pdo = new PDO($dsn);

// Establecer atributos de la conexión (opcional)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $id = $_POST['id'];
    $query = "SELECT * FROM clientes WHERE id = $id";

    $result = $pdo -> prepare($query);
    $result -> execute();
    $usuario = $result -> fetch();
    $username = $usuario['nombre'];
    echo "<h1>$username </h1>";

    $qproductos = "SELECT * FROM compras WHERE id_cliente = $id";
    $result = $pdo -> prepare($qproductos);
    $result -> execute();
    $compras = $result -> fetchAll();

    echo "<table>";
    # ver id de la compra/venta nombre productos, precios, numero de cajas cada producto, precio total y despacho




    $pdo = null;
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
    </body>
