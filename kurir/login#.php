<?php

require "functions.php";

session_start();

if (isset($_POST["login"])) {

  $username = $_POST['username'];
  $password = $_POST['password'];

  $result = mysqli_query($conn, "SELECT * FROM tb_kurir WHERE username = '$username' or email = '$username'");
  if (mysqli_num_rows($result)) {
    
    $rows = mysqli_fetch_assoc($result);

    if (password_verify($password, $rows["password"])) {

      $_SESSION["login"] = true;
      header("Location: index.php?id=$rows[id]&asal_kurir=$rows[asal_kurir]");
      exit;
    }
  }

  $error = true;
}

?>

<!doctype html>
<html lang="en">

<head>
  <title>Login</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
  <link rel="stylesheet" type="text/css" href="css/style.css">



  <link href="css/login.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>


  <link href="css/login.css" rel="stylesheet">
</head>

<body class="text-center">

  <main class="form-signin">
    <form action="" method="POST">
      <img class="mb-4" src="image/logo_kurir.png" alt="navbar-brand" width="300">
      <h1 class="h3 mb-3 fw-normal">Login</h1>

      <div class="form-floating">
        <input type="text" class="form-control" name="username" id="username" placeholder="username" required autofocus>
        <label for="username">Username or Email</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
        <label for="password">Password</label>
      </div>

      <?php if (isset($error)) : ?>
        <p style="color:red;" class="fst-italic">Wrong username or password</p>
      <?php endif ?>

      <div class="checkbox mt-2 mb-2">
        <label for="setcookie">
          <input type="checkbox" name="setcookie" value="true" id="setcookie"> Remember me
        </label>
      </div>
      <div class="form">  
        <button class="w-100 btn btn-lg btn-primary" name="login" type="submit">Login</button>
      </div>
      <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
    </form>
  </main>



</body>

</html>