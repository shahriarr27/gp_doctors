<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GP Doctors</title>

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/png" href="./assets/img/logo/favicon.png">

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400;600;700;900&display=swap"
    rel="stylesheet">

  <!-- Stylesheet -->
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/admin-panel.css">
</head>

<body>

  <section>
    <div class="new-note-wrapper">
      <h2 class="title">Log in</h2>
      <form action="loginController.php" class="admin-panel-form" method="post">
        <label for="">
          
        <?php if (isset($_GET['error'])) { ?>
          <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        </label>
        <label for="email">Email</label><br>
        <input type="email" id="email" name="email">
        <br><br>
        <label for="password">Password</label><br>
        <input type="password" id="password" name="password">
        <br><br>
        <button type="submit" class="submit-button" name = "submit">Login</button>
      </form>
    </div>
  </section>


</body>

</html>