<?php include "db.php"; ?>
<?php include "functions.php"; ?>
<?php
$message = '';
if (isset($_POST['submit'])) {
  $name = escape($_POST['name']);
  $dob = escape($_POST['dob']);
  $gender = escape($_POST['gender']);
  $country = escape($_POST['country']);
  $email = escape($_POST['email']);
  $password = escape($_POST['password']);

  $errors = [
    'name' => '',
    'email' => '',
    'password' => '',
    'dob' => '',
    'gender' => '',
    'country' => ''
  ];

  if (emailExists(strtolower($email)) || emailExists(strtoupper($email)))
    $errors['email'] = 'this email has been taken. choose another.';
  if (empty($email))
    $errors['email'] = 'email can\'t be empty.';
  if (strlen($name) < 4)
    $errors['name'] = 'name must be larger than 4 letters.';
  if (empty($name))
    $errors['name'] = 'name can\'t be empty.';
  if (empty($dob))
    $errors['dob'] = 'dob can\'t be empty.';
  if (empty($gender))
    $errors['gender'] = 'gender can\'t be empty.';
  if (empty($country))
    $errors['country'] = 'country can\'t be empty.';
  if (strlen($password) < 8)
    $errors['password'] = 'password must be larger than 8 characters.';
  if (empty($password))
    $errors['password'] = 'password can\'t be empty.';

  foreach ($errors as $key => $value) {
    if (empty($value))       //means no errorss bcz value is empty
      unset($errors[$key]);
  }
  // if errors array is empty means no errorss
  if (empty($errors)) {
    registerUser($name, $dob, $gender, $country, $email, $password);
    $email = '';
    $password = '';
    $name = '';
    $dob = '';
    $country = '';
    $gender = '';
    sleep(1);
    $message = "Registered. Please <a href='login.php'>Login</a>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/register.css">
  <title>Registration</title>
</head>

<body>
  <div class="title">
    <h1>register</h1>
    <hr>
  </div>

  <div class="container">
    <form action="" method="POST">

      <small class="message"><?php echo $message; ?></small>

      <div class="input-field">
        <label>Name </label>
        <input type="text" name="name" placeholder="Enter your full name" required value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
        <small class="error"><?php echo isset($errors['name']) ? $errors['name'] : ''; ?></small>
      </div>

      <div class="input-field">
        <label>Date Of Birth </label>
        <input type="date" name="dob" placeholder="Select dob" required value="<?php echo isset($_POST['dob']) ? $_POST['dob'] : ''; ?>">
        <small class="error"><?php echo isset($errors['dob']) ? $errors['dob'] : ''; ?></small>
      </div>

      <div class="input-field">
        <label>Choose Your Gender </label>
        <select name="gender" required>
          <option value="" selected>choose gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
        <small class="error"><?php echo isset($errors['gender']) ? $errors['gender'] : ''; ?></small>
      </div>

      <div class="input-field">
        <label>Country </label>
        <input type="text" name="country" placeholder="Enter your country name" required value="<?php echo isset($_POST['country']) ? $_POST['country'] : ''; ?>">
        <small class="error"><?php echo isset($errors['country']) ? $errors['country'] : ''; ?></small>
      </div>

      <div class="input-field">
        <label>Email </label>
        <input type="email" name="email" placeholder="Enter email address" required value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
        <small class="error"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></small>
      </div>

      <div class="input-field">
        <label>Choose Your Password </label>
        <input type="password" name="password" placeholder="Enter password" required value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
        <small class="error"><?php echo isset($errors['password']) ? $errors['password'] : ''; ?></small>
      </div>

      <input type="submit" value="Register" name="submit">

    </form>
  </div>



</body>

</html>