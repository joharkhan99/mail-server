<?php

if (isset($_GET['source'])) {
  if (isset($_SESSION['email']) && isset($_SESSION['id'])) {
    if ($_GET['source'] == 'view' && isset($_GET['emid'])) {
      $emailId = $_GET['emid'];

      $query = "SELECT * FROM emails WHERE id=$emailId";
      $result = mysqli_query($connection, $query);
      confirmQuery($result);
      $row = mysqli_fetch_assoc($result);
    }
    if ($_GET['source'] == 'view' && isset($_GET['emid']) && isset($_GET['type'])) {
      $emailId = $_GET['emid'];

      $query = "SELECT * FROM recyclebin WHERE emailId=$emailId";
      $result = mysqli_query($connection, $query);
      confirmQuery($result);
      $row = mysqli_fetch_assoc($result);
    }
  }
}
?>
<div class="container viewEmail">
  <div class="inbox-table">
    <h1 class="inbox-subject"><?php echo !empty($row['subject']) ? $row['subject'] : 'No Subject Line'; ?></h1>
    <div class="sender-info">
      <div class="sender-img">
        <img src="../img/<?php echo Defaultimage(getUserImage($row['fromEmail'])); ?>" alt="">
      </div>
      <span class="sender-name"><?php echo getUserName($row['fromEmail']); ?></span>
      <small><?php echo "&lt;" . $row['fromEmail'] . "&gt;"; ?></small>
      <span class="sender-date"><?php echo $row['date']; ?></span>
      <p class="sender-body">
        <?php echo $row['message']; ?>
      </p>
      <div class="speaker">
        <i class="fas fa-volume-up" title="read email" onclick="readEmail()"></i>
        <i class="fas fa-volume-mute" title="stop reading" onclick="stopread()"></i>
      </div>
    </div>
  </div>
</div>
