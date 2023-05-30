<?php include('../templates/header.html')?>

<body>
<?php
require("../config/conexion.php");
$id = $_POST['id'];

$query ="SELECT c.nombre, c.calle, c.numero_domicilio, c.comuna, c.region, SUM(p.precio * co.cantidad) AS valor_compra
FROM Compras co
JOIN Clientes c ON co.id_cliente = c.ID
JOIN Venta v ON co.ID_venta = v.ID
JOIN Productos p ON v.id_producto = p.ID
WHERE co.id_compra = $id;";
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
        <th> valor de compra</th>
    </tr>

    <?php
    foreach($clientes as $cliente){
        echo "<tr> <td> $cliente[0]</td> <td> $cliente[1]</td> <td>$cliente[2] </td> <td>$cliente[3] </td><td>$cliente[4] </td><td>$cliente[5] </td></tr>";
    }
    ?>

</table>
<?php include('../templates/footer.html')?>
