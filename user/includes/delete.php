<?php
// /////
// here we will delete email from emails db and add it to recycle db
// ////

if (isset($_GET['source'])) {
  if (isset($_SESSION['email']) && isset($_SESSION['id'])) {
    if (isset($_GET['emid']) && $_GET['source'] == 'delete') {
      $emailId = $_GET['emid'];

      // way of selecting data from one table and insert to another
      $query = "INSERT INTO recyclebin(emailId,toId,fromId,toEmail,fromEmail,subject,message,date) (SELECT id,toId,fromId,toEmail,fromEmail,subject,message,date FROM emails WHERE id=$emailId)";
      $result = mysqli_query($connection, $query);
      confirmQuery($result);

      $query = "DELETE FROM emails WHERE id=$emailId";
      $result = mysqli_query($connection, $query);
      confirmQuery($result);

      sleep(1);
      if ($_GET['type'] == 'fromsent') {
        header("Location: emails.php?source=sent");
      } elseif ($_GET['type'] == 'starred') {
        header("Location: emails.php?source=starred");
      } else {
        header("Location: index.php");
      }
    }

    // from recyclebin
    if (isset($_GET['emid']) && $_GET['source'] == 'delete' && isset($_GET['type'])) {
      if ($_GET['type'] == 'trash') {

        $emailId = $_GET['emid'];
        $query = "DELETE FROM recyclebin WHERE emailId=$emailId";
        $result = mysqli_query($connection, $query);
        confirmQuery($result);

        sleep(1);
        header("Location: emails.php?source=trash");
      }
    }

    // from Drafts
    if (isset($_GET['emid']) && $_GET['source'] == 'delete' && isset($_GET['type'])) {
      if ($_GET['type'] == 'draft') {

        $emailId = $_GET['emid'];
        $query = "DELETE FROM drafts WHERE id=$emailId";
        $result = mysqli_query($connection, $query);
        confirmQuery($result);

        sleep(1);
        header("Location: emails.php?source=draft");
      }
    }
  } else {
    return false;
  }
}
