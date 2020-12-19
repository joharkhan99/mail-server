<div class="container">

  <div class="title">
    <h1>Trash</h1>
    <hr class="side-line">
  </div>

  <div class="inbox-table">

    <table>
      <tbody>

        <?php
        $email = $_SESSION['email'];
        $id = getUserId($_SESSION['email']);
        $query = "SELECT * FROM recyclebin WHERE toId=$id AND toEmail='$email' ORDER BY id DESC";
        $result = mysqli_query($connection, $query);
        confirmQuery($query);
        while ($row = mysqli_fetch_assoc($result)) :
          $emailId = $row['emailId'];
          if (strlen($row['message']) > 30)
            $row['message'] = substr($row['message'], 0, 40) . "...";
          if (strlen($row['subject']) > 40)
            $row['subject'] = substr($row['subject'], 0, 30) . "...";
        ?>

          <tr class="single-email">
            <td class="box" title="click to select">
              <span>
                <input type="checkbox" name="check" class="check">
              </span>
            </td>
            <td class="email-name" onclick="window.location='<?php echo 'emails.php?source=view&emid=' . $emailId . '&type=trash'; ?>';" title="click to open">
              <?php echo $row['fromEmail']; ?>
            </td>
            <td class="email-subj" onclick="window.location='<?php echo 'emails.php?source=view&emid=' . $emailId . '&type=trash'; ?>';" title="click to open">
              <?php echo $row['subject']; ?>
            </td>
            <td onclick="window.location='<?php echo 'emails.php?source=view&emid=' . $emailId . '&type=trash'; ?>';" title="click to open">
              <?php echo $row['message']; ?>
            </td>
            <td class="email-date" title="sent date">
              <i><?php echo $row['date']; ?></i>
              <a class="delete-icon" title="delete" href="emails.php?source=delete&emid=<?php echo $emailId; ?>&type=trash">
                <i class="fas fa-trash"></i>
              </a>
            </td>
          </tr>

        <?php endwhile; ?>

      </tbody>
    </table>

  </div>


</div>