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


</body>
