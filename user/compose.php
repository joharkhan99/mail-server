<?php include "includes/header.php" ?>
<?php include "includes//nav.php" ?>

<?php
if (!isset($_SESSION['email']) || !isset($_SESSION['id'])) {
  header("Location: ../login.php");
}
?>

<?php
$message = '';
if (isset($_POST['save'])) {
  if (isset($_SESSION['email']) && isset($_SESSION['id'])) {
    $toEmail = escape(strtolower($_POST['email']));
    $subject = escape($_POST['subject']);
    $body = escape($_POST['message']);

    if (empty($toEmail))
      $toEmail = '';
    if (empty($subject))
      $subject = '';
    if (empty($body))
      $body = '';

    if (saveToDraft($toEmail, $subject, $body))
      // $message = 'Saved To Draft';
      echo "<script>showAlert('success','Saved to Drafts');</script>";
  }
}


if (isset($_POST['submit'])) {
  if (isset($_SESSION['email']) && isset($_SESSION['id'])) {
    $toEmail = escape(strtolower($_POST['email']));
    $subject = escape($_POST['subject']);
    $body = escape($_POST['message']);

    $errors = [
      'email' => '',
      'subject' => '',
      'body' => ''
    ];

    if (!emailExists(strtolower($toEmail)) || !emailExists(strtoupper($toEmail)))
      $errors['email'] = 'this email doesn\'t exist on this server';
    if (empty($toEmail))
      $errors['email'] = 'email can\'t be empty.';
    if (empty($body))
      $errors['body'] = 'please dont\'t leave this field empty';

    foreach ($errors as $key => $value) {
      if (empty($value))       //means no errorss bcz value is empty
        unset($errors[$key]);
    }
    // if errors array is empty means no errorss
    if (empty($errors) && emailExists(trim($toEmail))) {
      sendEmail($toEmail, $subject, $body);
      $toEmail = '';
      $subject = '';
      $body = '';
      sleep(1);
      // $message = 'Email Sent!';
      echo "<script>showAlert('success','Email Sent');</script>";
    }
  }
}

?>

<div class="title">
  <h1>Compose Email</h1>
  <hr class="side-line">
</div>

<div class="card">
  <form action="" method="POST">

    <div class="input-field">
      <input type="email" name="email" placeholder="Enter email address" spellcheck="false" class="<?php echo isset($errors['email']) ? 'error-border' : '' ?>" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
      <small class="error"><?php echo isset($errors['email']) ? $errors['email'] : '' ?></small>
    </div>
    <div class="input-field">
      <input type="text" name="subject" placeholder="Enter subject line" value="<?php echo isset($_POST['subject']) ? $_POST['subject'] : '' ?>">
    </div>
    <div class="input-field">
      <textarea name="message" id="" cols="30" rows="10" placeholder="Enter your message" class="<?php echo isset($errors['body']) ? 'error-border' : '' ?>"><?php echo isset($_POST['message']) ? $_POST['message'] : '' ?></textarea>
      <small class="error"><?php echo isset($errors['body']) ? $errors['body'] : '' ?></small>
    </div>

    <input type="submit" name="submit" value="Send">
    <input type="submit" name="save" value="Save To Draft">
  </form>

</div>

<?php include "includes/footer.php" ?>