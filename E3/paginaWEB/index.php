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
<h1> Sistemas de: tienda 47-54</h1>
<br>
<br>
<p style="text-align:center;">Ingrese sesion para poder continuar </p>
<br>
<form action="view_handler.php" method="POST">
    <label for="username">Nombre de usuario:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>

    <input type="submit" value="Enviar">
</form>

<br>
<form method="post" action="">
    <input type="submit" name="ejecutar" value="importar usuarios">
</form>

<?php
// Verificar si se ha enviado el formulario
if (isset($_POST['ejecutar'])) {
    // Realizar la conexión a la base de datos
    $host = "nombre_host";
    $port = "puerto";
    $dbname = "nombre_base_datos";
    $user = "usuario";
    $password = "contraseña";

    $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
    if (!$conn) {
        echo "Error al conectar a la base de datos.";
        exit;
    }

    // Ejecutar la consulta
    $query = "CREATE TABLE IF NOT EXISTS TABLE_NAME (column_name datatype, column_name datatype);";
    $result = pg_query($conn, $query);

    // Mostrar los resultados de la consulta
    while ($row = pg_fetch_assoc($result)) {
        echo $row['columna1'] . " - " . $row['columna2'] . "<br>";
    }

    // Cerrar la conexión
    pg_close($conn);
}
?>
</body>
