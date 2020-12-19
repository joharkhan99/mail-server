<?php include "db.php"; ?>
<?php
function confirmQuery($result)
{
  global $connection;
  if (!$result) {
    die('Query Failed: ' . mysqli_error($connection));
  }
}
function getUserId($email)
{
  global $connection;
  $email = strtolower($email);
  if (!empty($email)) {
    $query = "SELECT id FROM users WHERE email='$email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return mysqli_fetch_assoc($result)['id'];
  }
}
function getUserName($email)
{
  global $connection;
  $email = strtolower($email);
  if (!empty($email)) {
    $query = "SELECT name FROM users WHERE email='$email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return mysqli_fetch_assoc($result)['name'];
  }
}
function getUserImage($email)
{
  global $connection;
  $email = strtolower($email);
  if (!empty($email)) {
    $query = "SELECT user_img FROM users WHERE email='$email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return mysqli_fetch_assoc($result)['user_img'];
  }
}

function escape($string)
{
  global $connection;
  return mysqli_real_escape_string($connection, trim($string));
}

function Defaultimage($image = "")
{
  if (!$image)
    return "default-user.png";
  else
    return $image;
}

function emailExists($email)
{
  global $connection;
  if (!empty($email)) {
    $query = "SELECT email FROM users WHERE email='$email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    if (mysqli_num_rows($result) > 0)   //means exist
      return true;
    else
      return false;
  }
}

function registerUser($name, $dob, $gender, $country, $email, $password)
{
  global $connection;
  if (!empty($email) && !empty($name) && !empty($dob) && !empty($gender) && !empty($country) && !empty($password)) {

    $dob = date('Y-m-d', strtotime($dob));
    $password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
    $email = strtolower($email);

    $query = "INSERT INTO users(name,dob,gender,location,email,password,account_date) VALUES('$name','$dob','$gender','$country','$email','$password',now())";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
  }
}

function loginUser($email, $password)
{
  global $connection;
  if (!empty($email) && !empty($password) && emailExists($email)) {
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    $row = mysqli_fetch_assoc($result);
    $db_email = $row['email'];
    $db_pass = $row['password'];
    $db_image = $row['user_img'];
    $verifyPass = password_verify($password, $db_pass);

    if (!strcasecmp($email, $db_email) && $verifyPass) {
      $_SESSION['name'] = $row['name'];
      $_SESSION['id'] = $row['id'];
      $_SESSION['dob'] = $row['dob'];
      $_SESSION['gender'] = $row['gender'];
      $_SESSION['email'] = $db_email;
      $_SESSION['img'] = $db_image;
      return true;
    } else {
      $_SESSION['name'] = '';
      $_SESSION['id'] = '';
      $_SESSION['dob'] = '';
      $_SESSION['gender'] = '';
      $_SESSION['email'] = '';
      return false;
    }
  }
}

function sendEmail($toEmail, $subject, $body)
{
  global $connection;
  if (!empty($toEmail) && !empty($body)) {
    if (empty($subject)) {
      $subject = '';
    }
    $toId = getUserId($toEmail);
    $fromId = getUserId($_SESSION['email']);
    $email_type = "to";
    $fromEmail = strtolower(trim($_SESSION['email']));
    $toEmail = strtolower(trim($toEmail));

    $query = "INSERT INTO emails(toId,fromId,type,toEmail,fromEmail,subject,message,date) VALUES($toId,$fromId,'$email_type','$toEmail','$fromEmail','$subject','$body',now())";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return true;
  }
}

function saveToDraft($toEmail, $subject, $body)
{
  global $connection;
  $fromId = getUserId($_SESSION['email']);

  $fromEmail = strtolower(trim($_SESSION['email']));
  $toEmail = strtolower(trim($toEmail));

  $query = "INSERT INTO drafts(sender_id,toEmail,fromEmail,subject,message,date) VALUES($fromId,'$toEmail','$fromEmail','$subject','$body',now())";
  $result = mysqli_query($connection, $query);
  confirmQuery($result);
  return true;
}

function UpdateToDraft($emailId, $toEmail, $subject, $body)
{
  global $connection;
  $fromId = getUserId($_SESSION['email']);

  $fromEmail = strtolower(trim($_SESSION['email']));
  $toEmail = strtolower(trim($toEmail));

  $query = "UPDATE drafts SET toEmail='$toEmail',fromEmail='$fromEmail',subject='$subject',message='$body',date=now() WHERE sender_id=$fromId AND id=$emailId";
  $result = mysqli_query($connection, $query);
  confirmQuery($result);
  return true;
}

function deleteFromDraft($emailId)
{
  global $connection;
  $fromId = getUserId($_SESSION['email']);

  $fromEmail = strtolower(trim($_SESSION['email']));

  $query = "DELETE FROM drafts WHERE sender_id=$fromId AND id=$emailId AND fromEmail='$fromEmail'";
  $result = mysqli_query($connection, $query);
  confirmQuery($result);
  return true;
}
