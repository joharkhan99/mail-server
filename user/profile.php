<?php include "includes/header.php" ?>
<?php include "includes//nav.php" ?>

<?php
if (!isset($_SESSION['email']) || !isset($_SESSION['id'])) {
  header("Location: ../login.php");
}
?>

<?php

if (isset($_POST['submit'])) {
  if (isset($_SESSION['email']) && isset($_SESSION['id'])) {
    $image = $_FILES['dp-image']['name'];
    if (!empty($image)) {

      $image_tempAddress = $_FILES['dp-image']['tmp_name'];
      $id = trim($_SESSION['id']);
      $email = trim($_SESSION['email']);

      //move img from temp addrss to images folder with its name
      move_uploaded_file($image_tempAddress, "../img/$image");    //(filename, destination)
      $query = "UPDATE users SET user_img='$image' WHERE id=$id AND email='$email'";
      $result = mysqli_query($connection, $query);
      confirmQuery($result);
      sleep(1);

      header("Location: profile.php");
    } else {
      echo "<script>showAlert('error','Choose an Image First.')</script>";
    }
  } else {
    header("Location: ../login.php");
  }
}

?>


<?php
if (isset($_SESSION['email']) && isset($_SESSION['name']) && isset($_SESSION['id'])) {
  $email = $_SESSION['email'];
  $query = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($connection, $query);
  confirmQuery($result);
  $row = mysqli_fetch_assoc($result);
}

?>

<div class="container viewEmail profile-page-div">
  <div class="inbox-table profile-div">
    <fieldset>
      <legend>Profile</legend>
      <div class="profile-img-div">
        <img src="../img/<?php echo Defaultimage($row['user_img']) ?>" alt="">
        <form action="" method="POST" enctype="multipart/form-data">
          <input type="file" name="dp-image" id="">
          <input type="submit" name="submit" value="Change dp">
          <small style="font-size:9px;text-align: center;text-transform: lowercase;">(400 x 400) px</small>
        </form>
      </div>

      <div class="profile-user-info">
        <div class="info-field">
          <div class="field">
            <label>Name </label>
            <input type="text" name="" value="<?php echo $row['name'] ?>" disabled id="">
          </div>
          <div class="field">
            <label>Date Of Birth </label>
            <input type="text" name="" value="<?php echo $row['dob'] ?>" disabled id="">
          </div>
          <div class="field">
            <label>gender </label>
            <input type="text" name="" value="<?php echo $row['gender'] ?>" disabled id="">
          </div>
          <div class="field">

            <label>country </label>
            <input type="text" name="" value="<?php echo $row['location'] ?>" disabled id="">
          </div>
          <div class="field">
            <label>email </label>
            <input type="text" name="" value="<?php echo $row['email'] ?>" disabled id="">
          </div>
          <div class="field">
            <label>account creation date </label>
            <input type="text" name="" value="<?php echo !empty($row['account_date']) ? $row['account_date'] : '0/0/0000' ?>" disabled id="">
          </div>
        </div>
      </div>
    </fieldset>

    <fieldset class="password-div">
      <legend>Change Password</legend>
      <div class="info-field">
        <form action="" method="POST">
          <div class="field">
            <label>Why do you want to change password?</label>
            <input type="text" name="reason" id="reason" placeholder="Enter your reason" autocomplete="off" value="<?php echo isset($_POST['reason']) ? $_POST['reason'] : '' ?>">
          </div>
          <div class="field">
            <label>New password</label>
            <input type="password" name="password" placeholder="Enter new password" autocomplete="off" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>" id="password">
          </div>
          <div class="field">
            <label>confirm new password</label>
            <input type="password" name="pass-confirm" placeholder="Confirm new password" autocomplete="off" value="<?php echo isset($_POST['pass-confirm']) ? $_POST['pass-confirm'] : '' ?>" id="pass-confirm">
          </div>
          <div class="field">
            <input type="submit" name="change" value="change" onclick="javascript:void(0)">
          </div>
        </form>
      </div>
    </fieldset>
  </div>
</div>

<?php include "includes/footer.php"; ?>

<?php
if (isset($_POST['change'])) {
  if (isset($_SESSION['email']) && isset($_SESSION['id'])) {
    $pass = escape(trim($_POST['password']));
    $pass_confirm = escape(trim($_POST['pass-confirm']));
    $reason = escape(trim($_POST['reason']));

    if (empty($pass) || empty($pass_confirm) || empty($reason)) {
      echo "<script>showAlert('error','Fill all Fields.')</script>";
    } elseif (strlen($pass) < 8) {
      echo "<script>showAlert('error','Password length must be greater than 8.')</script>";
    } elseif ($pass != $pass_confirm) {
      echo "<script>showAlert('error','Password Fields not Matching.')</script>";
    } else {
      $pass = password_hash($pass, PASSWORD_BCRYPT, ['cost' => 12]);
      $email = $_SESSION['email'];
      $id = $_SESSION['id'];
      $query = "UPDATE users SET password='$pass' WHERE email='$email' AND id=$id";
      $result = mysqli_query($connection, $query);
      confirmQuery($result);
      echo "<script>
          document.getElementById('reason').value = '';
          document.getElementById('password').value = '';
          document.getElementById('pass-confirm').value = '';
          showAlert('success','Password Changed.')
        </script>";
    }
  } else {
    header("Location: ../login.php");
  }
}

?>