<?php
  //Base de datos
  require'database.php';
  //Se crea una variable mensaje con un campo vacio apara llenarlo despues
  $message = '';

    //Si no esta vacio en el formulacio el email y el password haga...
    if (!empty($_POST['rol']) && !empty($_POST['password']) && !empty($_POST['email'])) {
      $sql = "INSERT INTO users (rol, email, password) VALUES (:rol, :email, :password)";//inserta los datos a la base de datos
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':rol', $_POST['rol']);
      $stmt->bindParam(':email', $_POST['email']);
      $password = password_hash($_POST['password'], PASSWORD_BCRYPT); //el password bcrypt protege la contrase;a del usuario encryptandolo
      $stmt->bindParam(':password', $password);



    if ($stmt->execute()) {
      $message = 'Felicidades, se ha creado un nuevo usuario';
    } else {
      $message = 'Lo siento, ha ocurrido un error';
    }
  }






 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SignUp</title> <!-- titulo de la pag-->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> <!-- estilo del texto-->
    <link rel="stylesheet" href="assets/css/style.css"><!-- busca en archivo style donde se modifica los estilos del texto,botones, etc-->
  </head>
  <body>
    <!-- header-->
    <?php require'partials/header.php'; ?>

    <?php if(!empty($message)): ?>
    <p><?= $message ?></p>
    <?php endif; ?>

    <!-- texto subtitulo-->
    <h2>SignUp</h2>
    <!-- para ir a la pagina login-->
    <span>or <a href="login.php">Login</a> </span>

    <!-- formulario en signup-->
    <form action="signup.php" method="post">
      <!-- lista desplegable-->
    <select type="select" name="rol">
      <option value="0">Seleccionar...</option>
      <option value="1">Supervisor</option>
      <option value="2">Operador</option>
    </select>
    <!-- ingreso de datos e imagen del usuario-->
    <input type="text" name="email" placeholder="Ingrese su email">
    <input type="password" name="password" placeholder="Ingrese su contraseña">
    <input type="password" name="confirm_password" placeholder="Verifique su contraseña">
    <h3>seleccione una imagen de perfil</h3><input type="file" class="form-control-file" name="image" accept="image/*" >
    <input type="submit" name="send" value="enviar">

    </form>
  </body>
</html>
