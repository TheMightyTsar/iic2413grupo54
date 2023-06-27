<?php include('templates/header.html');   ?>
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
    $query = "SELECT * FROM tabla";
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
