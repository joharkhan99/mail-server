<div class="container">

  <div class="title">
    <h1>starred emails</h1>
    <hr class="side-line">
  </div>

  <div class="inbox-table">

    <table>
      <tbody>

        <?php
        $email = trim($_SESSION['email']);
        $id = getUserId($_SESSION['email']);
        $query = "SELECT * FROM emails WHERE toId=$id AND toEmail='$email' AND starred='star' ORDER BY id DESC";
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
                <input type="checkbox" name="check" class="check">
              </span>
            </td>
            <td class="email-name" title="click to open" onclick="window.location='<?php echo 'emails.php?source=view&emid=' . $emailId . ''; ?>';">
              <?php echo $row['fromEmail']; ?>
            </td>
            <td class="email-subj" title="click to open" onclick="window.location='<?php echo 'emails.php?source=view&emid=' . $emailId . ''; ?>';">
              <?php echo empty($row['subject']) ? '(no subject)' : $row['subject']; ?>
            </td>
            <td title="click to open" onclick="window.location='<?php echo 'emails.php?source=view&emid=' . $emailId . ''; ?>';">
              <?php echo empty($row['message']) ? '(no body)' : $row['message']; ?>
            </td>
            <td class="email-date" title="sent date">
              <i><?php echo $row['date']; ?></i>
              <a class="delete-icon" title="delete" href="emails.php?source=delete&emid=<?php echo $emailId; ?>&type=starred">
                <i class="fas fa-trash"></i>
              </a>
            </td>
          </tr>

        <?php endwhile; ?>

      </tbody>
    </table>

  </div>


</div>