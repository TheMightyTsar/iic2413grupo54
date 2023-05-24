<?php include('templates/header.html');   ?>

<body>
  <h1 align="center">Super consultas 54</h1>
  <p style="text-align:center;">Servicio de productos y entregas</p>

  <br>

  <h3 align="center"> ¿Quieres buscar los despachos para una fecha especifica?</h3>

  <?php
  #Primero obtenemos todos los tipos de pokemones
  require("config/conexion.php");
  $result = $db -> prepare("SELECT DISTINCT fecha_entrega FROM despachos;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>

  <form align="center" action="consultas/consulta_despachos_por_fecha.php" method="post">
    Fecha:
    <select name="fecha">
      <?php
      #Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
      foreach ($dataCollected as $d) {
        echo "<option value=$d[0]>$d[0]</option>";
      }
      ?>
    </select>
    <br><br>
    <input type="submit" value="Buscar por Fecha">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres buscar al cliente de una compra?</h3>
  <?php
  #Primero obtenemos todos los tipos de pokemones
  require("config/conexion.php");
  $result = $db -> prepare("SELECT DISTINCT id_compra FROM venta;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>

  <form align="center" action="consultas/consulta_cliente_compra.php" method="post">
    Id de compra:
    <select name="id">
      <?php
      #Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
      foreach ($dataCollected as $d) {
        echo "<option value=$d[0]>$d[0]</option>";
      }
      ?>
    </select>
    <br><br>
    <input type="submit" value="Buscar por ID de compra">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres saber el numero de cajas de un pedido?</h3>
  <?php
  #Primero obtenemos todos los tipos de pokemones
  require("config/conexion.php");
  $result = $db -> prepare("SELECT DISTINCT id_compra FROM venta;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>

  <form align="center" action="consultas/consulta_compra_cajas.php" method="post">
    Id de compra:
    <select name="id">
      <?php
      #Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
      foreach ($dataCollected as $d) {
        echo "<option value=$d[0]>$d[0]</option>";
      }
      ?>
    </select>
    <br><br>
    <input type="submit" value="Buscar por ID de compra">
  </form>






  <br>
  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres buscar los despachos de un vehiculo para una fecha especifica?</h3>

  <?php
  #Primero obtenemos todos los tipos de pokemones
  require("config/conexion.php");
  $result = $db -> prepare("SELECT DISTINCT fecha_entrega FROM despachos;");
  $result2 =  $db -> prepare("SELECT DISTINCT patente FROM patentes;");
  $result -> execute();
  $result2 -> execute();
  $dataCollected = $result -> fetchAll();
  $dataCollected2 = $result2 -> fetchAll();
  ?>

  <form align="center" action="consultas/consulta_despachos_por_fecha.php" method="post">
    Fecha:
    <select name="fecha">
      <?php
      #Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
      foreach ($dataCollected as $d) {
        echo "<option value=$d[0]>$d[0]</option>";
      }
      ?>
    </select>
    Patente:
    <select name="patente">
      <?php
      #Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
      foreach ($dataCollected2 as $d) {
        echo "<option value=$d[0]>$d[0]</option>";
      }
      ?>
    </select>
    <br><br>
    <input type="submit" value="Buscar por Fecha y Patente">
  </form>




  <br>
  <br>
  <br>
  <br>

  <h3 align="center"> ¿El numero de trabajadores y su promedio de edad de una region?</h3>

  <?php
  #Primero obtenemos todos los tipos de pokemones
  require("config/conexion.php");
  $result = $db -> prepare("SELECT DISTINCT region FROM clientes;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>

  <form align="center" action="consultas/consulta_tranajadores_region_edad.php" method="post">
    Region:
    <select name="id">
      <?php
      #Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
      foreach ($dataCollected as $d) {
        echo "<option value=$d[0]>$d[0]</option>";
      }
      ?>
    </select>
    <br><br>
    <input type="submit" value="Buscar por Region">
  </form>


  <br>
  <br>
  <br>

  <h3 align="center"> ¿Saber las compras de un cliente?</h3>
  <?php
  #Primero obtenemos todos los tipos de pokemones
  require("config/conexion.php");
  $result = $db -> prepare("SELECT DISTINCT id FROM clientes;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>

  <form align="center" action="consultas/consulta_cliente_compra.php" method="post">
    Id de Cliente:
    <select name="id">
      <?php
      #Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
      foreach ($dataCollected as $d) {
        echo "<option value=$d[0]>$d[0]</option>";
      }
      ?>
    </select>
    <br><br>
    <input type="submit" value="Buscar por ID de cliente">
  </form>


  <br>
  <br>
  <br>

  <h3 align="center"> ¿Los mayores compradores de la region?</h3>
  <?php
  #Primero obtenemos todos los tipos de pokemones
  require("config/conexion.php");
  $result = $db -> prepare("SELECT DISTINCT region FROM clientes;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>

  <form align="center" action="consultas/consulta_compradores_region.php" method="post">
    Region:
    <select name="id">
      <?php
      #Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
      foreach ($dataCollected as $d) {
        echo "<option value=$d[0]>$d[0]</option>";
      }
      ?>
    </select>
    <br><br>
    <input type="submit" value="Buscar por Region">
  </form>

</body>
</html>
