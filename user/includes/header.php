<?php session_start(); ?>
<?php include "../db.php"; ?>
<?php include "../functions.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/inbox.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <script src="../js/app.js?v=<?php echo time(); ?>"></script>
  <title>Inbox | <?php echo $_SESSION['email']; ?></title>
</head>

<body>