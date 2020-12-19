<?php include "includes/header.php" ?>
<?php include "includes//nav.php" ?>

<?php
if (!isset($_SESSION['email']) || !isset($_SESSION['id'])) {
  header("Location: ../login.php");
}
?>

<?php
if (isset($_GET['source'])) {
  $source = $_GET['source'];
} else {
  $source = '';
}
if (isset($_SESSION['email']) && isset($_SESSION['id'])) {
  switch ($source) {
    case 'sent':
      include "includes/sentemails.php";
      break;
    case 'view':
      include "includes/viewemail.php";
      break;
    case 'delete':
      include "includes/delete.php";
      break;
    case 'trash':
      include "includes/trash.php";
      break;
    case 'draft':
      include "includes/draft.php";
      break;
    case 'viewdraft':
      include "includes/editdraft.php";
      break;
    case 'starred':
      include "includes/starred.php";
      break;
  }
} else {
  header("Location: ../login.php");
}
?>

<?php include "includes/footer.php" ?>