<?php include "includes/header.php" ?>
<?php include "includes//nav.php" ?>

<?php
if (!isset($_SESSION['email']) || !isset($_SESSION['id'])) {
  header("Location: ../login.php");
}
?>

<?php
// unstar
if (isset($_GET['source'])) {
  if (isset($_SESSION['email']) && isset($_SESSION['id'])) {
    if (isset($_GET['emid'])) {
      $emailId = $_GET['emid'];
      $fromEmail = $_SESSION['email'];

      if (isset($_GET['starred'])) {
        if ($_GET['starred'] == 'star') {
          // $query = "UPDATE emails SET starred = IF (starred='star','unstar',starred) WHERE id=$emailId AND fromEmail='$fromEmail'";
          $query = "UPDATE emails SET starred = 'unstar' WHERE id=$emailId AND toEmail='$fromEmail'";
        } else if ($_GET['starred'] == 'unstar') {
          $query = "UPDATE emails SET starred = 'star' WHERE id=$emailId AND toEmail='$fromEmail'";
          // $query = "UPDATE emails SET starred = IF (starred='unstar','star',starred) WHERE id=$emailId AND fromEmail='$fromEmail'";
        }
      }


      $result = mysqli_query($connection, $query);
      confirmQuery($result);
      header("Location: index.php");
    }
  }
}

// bulk option select
if (isset($_POST['submit'])) {
  if (isset($_SESSION['email']) && isset($_SESSION['id'])) {
    if (isset($_POST['checkBoxArray'])) {
      $checkBoxArray = $_POST['checkBoxArray'];

      foreach ($checkBoxArray as $checkBoxValue) {
        $bulk_options = $_POST['bulk_options'];

        switch ($bulk_options) {
          case 'delete':
            // way of selecting data from one table and insert to another
            $query = "INSERT INTO recyclebin(emailId,toId,fromId,toEmail,fromEmail,subject,message,date) (SELECT id,toId,fromId,toEmail,fromEmail,subject,message,date FROM emails WHERE id=$checkBoxValue)";
            $result = mysqli_query($connection, $query);
            confirmQuery($result);

            $query = "DELETE FROM emails WHERE id=$checkBoxValue";
            $result = mysqli_query($connection, $query);
            confirmQuery($result);
            echo "<script>showAlert('error','Moved to Trash');</script>";
            break;

          case 'star':
            $fromEmail = $_SESSION['email'];
            $query = "UPDATE emails SET starred = 'star' WHERE id=$checkBoxValue AND toEmail='$fromEmail'";
            $result = mysqli_query($connection, $query);
            confirmQuery($result);
            echo "<script>showAlert('success','Starred');</script>";
            break;

          case 'unstar':
            $fromEmail = $_SESSION['email'];
            $query = "UPDATE emails SET starred = 'unstar' WHERE id=$checkBoxValue AND toEmail='$fromEmail'";
            $result = mysqli_query($connection, $query);
            confirmQuery($result);
            echo "<script>showAlert('success','Unstarred');</script>";
            break;

          default:
            break;
        }
      }
    }
  }
}
?>

<div class="container">

  <div class="title">
    <h1>Inbox</h1>
    <hr class="side-line">
  </div>

  <div class="inbox-table">

    <form action="" method="POST">


      <table>

        <!-- bulk options -->
        <div class="select-emails" id="bulkOptionContainer">
          <input type="checkbox" name="" id="selectAllBoxes" onclick="toggle(this)" title="select all">
          <select name="bulk_options" id="">
            <option value="" selected>Choose option</option>
            <option value="delete">Delete</option>
            <option value="star">Star</option>
            <option value="unstar">Unstar</option>
          </select>
          <input type="submit" value="Apply" name="submit">
          <hr class="side-line">
        </div>

        <tbody>

          <?php

          $email = $_SESSION['email'];
          $id = getUserId($_SESSION['email']);
          $per_page = 10;
          $page = 1;

          if (isset($_GET['page'])) {
            $page = $_GET['page'];
          } else {
            $page = '';
          }

          //default page or first page
          if ($page == '' || $page == 1) {
            $page_1 = 0;
          } else {
            $page_1 = ($page * $per_page) - $per_page;
          }

          $query = "SELECT * FROM emails WHERE toId=$id AND toEmail='$email' ORDER BY id DESC";
          $result = mysqli_query($connection, $query);
          confirmQuery($query);
          $count = mysqli_num_rows($result);

          $count = ceil($count / $per_page);

          $query = "SELECT * FROM emails WHERE toId=$id AND toEmail='$email' ORDER BY id DESC LIMIT $page_1,$per_page";
          $result = mysqli_query($connection, $query);
          confirmQuery($query);
          while ($row = mysqli_fetch_assoc($result)) :
            $emailId = $row['id'];
            if (strlen($row['message']) > 30)
              $row['message'] = substr($row['message'], 0, 40) . "...";
            if (strlen($row['subject']) > 40)
              $row['subject'] = substr($row['subject'], 0, 30) . "...";
          ?>

            <tr class="single-email">
              <td class="box" title="click to select">
                <span>
                  <!-- checkBoxARr will be filled with emil Id's -->
                  <input type="checkbox" name="checkBoxArray[]" class="check" value="<?php echo $emailId; ?>">
                </span>
              </td>
              <td class="email-name" onclick="window.location='<?php echo 'emails.php?source=view&emid=' . $emailId . ''; ?>';" title="click to open">
                <?php echo $row['fromEmail']; ?>
              </td>
              <td class="email-subj" onclick="window.location='<?php echo 'emails.php?source=view&emid=' . $emailId . ''; ?>';" title="click to open">
                <?php echo $row['subject']; ?>
              </td>
              <td onclick="window.location='<?php echo 'emails.php?source=view&emid=' . $emailId . ''; ?>';" title="click to open">
                <?php echo $row['message']; ?>
              </td>
              <td class="email-date" title="sent date">
                <i><?php echo $row['date']; ?></i>
                <a class="delete-icon" title="delete" href="emails.php?source=delete&emid=<?php echo $emailId; ?>">
                  <i class="fas fa-trash"></i>
                </a>
                <a class="save-icon" title="add to starred" href="index.php?source=save&emid=<?php echo $emailId; ?>&starred=<?php echo $row['starred']; ?>">
                  <i class="<?php
                            if ($row['starred'] == 'unstar')
                              echo 'far fa-star';
                            elseif ($row['starred'] == 'star')
                              echo 'fas fa-star';
                            ?>"></i>
                </a>
              </td>
            </tr>

          <?php endwhile; ?>

        </tbody>
      </table>
    </form>

    <ul class="pager">
      <?php
      for ($i = 1; $i <= $count; $i++) {
        if ($i == $page) {
          echo '<li><a class="active_link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
        } else {

          echo '<li><a href="index.php?page=' . $i . '">' . $i . '</a></li>';
        }
      }
      ?>
    </ul>
  </div>

</div>

<?php include "includes/footer.php"; ?>