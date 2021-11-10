<?php
  session_start();
  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PRUEBA DE DESARROLLO DE SOFTWARE</title>
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <!--header-->
    <?php require'partials/header.php'; ?>
    <!---->
    <?php if(!empty($user)): ?>
      <br> Bienvenido: <?= $user['email']; ?>
      <br>Tu has iniciado sesion correctamente
      <a href="logout.php">Logout</a>
    <?php else: ?>

    <!-- pedirle al usuario que seleccione inicio de sesion o registrarse-->
      <h2>Porfavor inicie sesion o Registrarse</h2>
      <a href="login.php">iniciar sesion </a> or
      <a href="signup.php">Registrarse</a>
    <?php endif; ?>
  </body>
</html>
