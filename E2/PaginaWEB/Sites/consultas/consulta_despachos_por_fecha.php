<?php include('../templates/header.html')?>

<body>
<?php
require("../config/conexion.php");
$fecha = $_POST['fecha'];

$query ="SELECT c.nombre, c.calle, c.numero_domicilio, c.comuna, c.region
FROM Compras co
JOIN Clientes c ON co.id_cliente = c.ID
JOIN Venta v ON co.ID_venta = v.ID
JOIN Despachos d ON v.ID = d.id_entrega
WHERE d.fecha_entrega = '$fecha';";
$result = $db -> prepare($query);
$result -> execute();
$clientes = $result -> fetchAll();
?>

<table>
    <tr>
        <th>Nombre </th>
        <th> calle</th>
        <th> numero domicilio</th>
        <th> comuna</th>
        <th> region</th>
    </tr>

    <?php
    foreach($clientes as $cliente){
        echo "<tr> <td> $cliente[0]</td> <td> $cliente[1]</td> <td>$cliente[2] </td> <td>$cliente[3] </td><td>$cliente[4] </td></tr>";
    }
    ?>

</table>

<?php include('../templates/footer.html')?>
