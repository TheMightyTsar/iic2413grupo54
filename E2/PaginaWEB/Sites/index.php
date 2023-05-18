<?php include('templates/header.html');   ?>

<body>
  <h1 align="center">Super consultas 54</h1>
  <p style="text-align:center;">Servicio de productos y entregas</p>

  <br>

  <h3 align="center"> ¿Quieres buscar los despachos para una fecha especifica?</h3>

  <form align="center" action="consultas/consulta_despachos_por_fecha.php" method="post">
    Fecha:
    <input type="text" name="fecha">
    <br/>
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres buscar al cliente de una compra?</h3>

  <form align="center" action="consultas/consulta_cliente_compra.php" method="post">
    Id de compra:
    <input type="text" name="id_elegido">
    <br>
    <br>
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres conocer los Pokemones más altos que: ?</h3>

  <form align="center" action="consultas/consulta_altura.php" method="post">
    Altura Mínima:
    <input type="text" name="altura">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  <br>
  <br>
  <br>

  <h3 align="center">¿Quieres buscar todos los pokemones por tipo?</h3>

  <?php
  #Primero obtenemos todos los tipos de pokemones
  require("config/conexion.php");
  $result = $db -> prepare("SELECT DISTINCT tipo FROM pokemones;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>

  <form align="center" action="consultas/consulta_tipo.php" method="post">
    Seleccinar un tipo:
    <select name="tipo">
      <?php
      #Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
      foreach ($dataCollected as $d) {
        echo "<option value=$d[0]>$d[0]</option>";
      }
      ?>
    </select>
    <br><br>
    <input type="submit" value="Buscar por tipo">
  </form>

  <br>
  <br>
  <br>
  <br>
</body>
</html>
