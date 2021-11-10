<!-- llamando a la base de datos-->
<?php
  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /login_system');
  }
  require'database.php';


  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /login_system");
    } else {
      $message = 'Lo siento, el usuario o contrase;a que ingreso son incorrectos';
    }
  }
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <!-- header-->
    <?php require'partials/header.php'; ?>
    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <!-- titulo-->
    <h2>Login</h2>
    <!-- devolverse a la pag de signup-->
    <span>or <a href="signup.php">SignUp</a> </span>

    <!-- formulario-->
    <form action="login.php" method="post">

      <!-- lista desplegable-->
      <select type="select" name="rol">
        <option value="0">Seleccionar...</option>
        <option value="1">Administrador</option>
        <option value="2">Supervisor</option>
        <option value="3">Operador</option>
      </select>
      <!-- ingreso de datos del usuario-->
      <input type="text" name="email" placeholder="Ingrese su email">
      <input type="password" name="password" placeholder="Ingrese su contraseña">
      <input type="submit" value="Enviar">
    </form>
  </body>
</html>
