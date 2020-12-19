<?php session_start(); ?>
<?php include "functions.php"; ?>

<?php

if (isset($_POST['submit'])) {
  $email = escape($_POST['email']);
  $password = escape($_POST['password']);

  $errors = [
    'email' => '',
    'password' => '',
    'invalid' => ''
  ];

  if (empty($email))
    $errors['email'] = 'email can\'t be empty.';
  if (empty($password))
    $errors['password'] = 'password can\'t be empty.';

  foreach ($errors as $key => $value) {
    if (empty($value))       //means no errorss bcz value is empty
      unset($errors[$key]);
  }
  // if errors array is empty means no errorss
  if (empty($errors)) {
    if (loginUser($email, $password)) {
      header("Location: user");
    } else {
      $errors['invalid'] = 'invalid email or password';
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- custom css -->
  <link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>">
  <!-- font awesome -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <title>Login</title>
</head>

<body>
  <div class="title">
    <h1>Login</h1>
    <hr>
  </div>

  <div class="container">
    <form action="" method="POST">

      <small class="error message"><?php echo isset($errors['invalid']) ? $errors['invalid'] : '' ?></small>

      <div class="input-field">
        <label>Email </label>
        <input type="email" name="email" placeholder="Enter email address" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
        <small class="error"><?php echo isset($errors['email']) ? $errors['email'] : '' ?></small>
      </div>

      <div class="input-field">
        <label>Password
          <span class="eye" onclick="showPass()" title="hide/show password">
            <i class="fas fa-eye-slash pass-eye"></i>
          </span>
        </label>
        <input type="password" name="password" placeholder="Enter password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>" id="pass">
        <small class="error"><?php echo isset($errors['password']) ? $errors['password'] : '' ?></small>
      </div>

      <input type="submit" value="Login" name="submit">

    </form>
  </div>



  <script src="js/app.js"></script>
</body>

</html>