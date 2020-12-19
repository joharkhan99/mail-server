<div class="container">

  <div class="title">
    <h1>Sent Emails</h1>
    <hr class="side-line">
  </div>

  <div class="inbox-table">

    <table>
      <tbody>

        <?php
        $email = $_SESSION['email'];
        $id = getUserId($_SESSION['email']);
        $query = "SELECT * FROM emails WHERE fromId=$id AND fromEmail='$email' ORDER BY id DESC";
        $result = mysqli_query($connection, $query);
        confirmQuery($query);
        while ($row = mysqli_fetch_assoc($result)) :
          $emailId = $row['id'];
          if (strlen($row['message']) > 30)
            $row['message'] = substr($row['message'], 0, 40) . "...";
          if (strlen($row['subject']) > 40)
            $row['subject'] = substr($row['subject'], 0, 30) . "...";
          if ($row['toEmail'] == $_SESSION['email'])
            $row['toEmail'] = 'me';
        ?>

          <tr class="single-email" title="click to open">
            <td class="box">
              <span>
                <input type="checkbox" name="check" class="check">
              </span>
            </td>
            <td class="email-name toemail" onclick="window.location='<?php echo 'emails.php?source=view&emid=' . $emailId . ''; ?>';">
              <?php echo "To: " . $row['toEmail']; ?>
            </td>
            <td class="email-subj" onclick="window.location='<?php echo 'emails.php?source=view&emid=' . $emailId . ''; ?>';">
              <?php echo $row['subject']; ?>
            </td>
            <td onclick="window.location='<?php echo 'emails.php?source=view&emid=' . $emailId . ''; ?>';">
              <?php echo $row['message'] ?>
            </td>
            <td class="email-date">
              <i><?php echo $row['date']; ?></i>
              <a class="delete-icon" title="delete" href="emails.php?source=delete&emid=<?php echo $emailId; ?>&type=fromsent">
                <i class="fas fa-trash"></i>
              </a>
            </td>
          </tr>

        <?php endwhile; ?>

      </tbody>
    </table>

  </div>


</div>