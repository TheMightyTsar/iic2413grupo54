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
<?php
// Realizar la conexión a la base de datos
$host = "nombre_host";
$port = "puerto";
$dbname = "nombre_base_datos";
$user = "usuario";
$password = "contraseña";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Obtener el nombre del cliente desde la vista
$nombreCliente = $_POST['nombre_cliente']; // Reemplaza $_POST['nombre_cliente'] con la forma en que obtienes el nombre desde la vista

// Consulta para obtener los datos del cliente por su nombre
$query = "SELECT * FROM Clientes WHERE nombre = '$nombreCliente'";
$result = pg_query($conn, $query);

if (!$result) {
    echo "Error al obtener los datos del cliente.";
    exit;
}

// Verificar si se encontraron resultados
if (pg_num_rows($result) > 0) {
    // Recorrer los resultados y mostrar los datos del cliente
    while ($row = pg_fetch_assoc($result)) {
        $idCliente = $row['ID'];
        $rutCliente = $row['rut'];
        $nombreCliente = $row['nombre'];
        $calleCliente = $row['calle'];
        $numeroCliente = $row['numero_domicilio'];
        $comunaCliente = $row['comuna'];
        $regionCliente = $row['region'];

        echo "ID: $idCliente<br>";
        echo "RUT: $rutCliente<br>";
        echo "Nombre: $nombreCliente<br>";
        echo "Calle: $calleCliente<br>";
        echo "Número: $numeroCliente<br>";
        echo "Comuna: $comunaCliente<br>";
        echo "Región: $regionCliente<br>";
    }
} else {
    echo "No se encontraron datos para el cliente con el nombre: $nombreCliente";
}

// Cerrar la conexión
pg_close($conn);
?>
