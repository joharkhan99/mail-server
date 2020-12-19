<div class="top-bar">
  <div class="inbox-logo">
    <span title="menu" onclick="openNav()" class="bars"><i class="fas fa-bars"></i></span>
    <img src="../img/inbox-logo.PNG" alt="" onclick="window.location='index.php'">
    <img src="../img/<?php echo Defaultimage(getUserImage($_SESSION['email'])); ?>" class="user-logo" alt="" title="profile" onclick="window.location='profile.php'">
  </div>
</div>

<nav>
  <!-- small screen -->
  <div class="sidenav" id="sidenav">
    <hr class="side-line">

    <a href="profile.php" id="profile"><i class="fas fa-user"></i> Profile</a>
    <hr class="side-line">

    <a href="index.php" id="inbox-link"><i class="fas fa-inbox"></i> Inbox</a>
    <a href="compose.php" id="compose-link"><i class="fas fa-plus"></i> Compose</a>
    <hr class="side-line">
    <a href="emails.php?source=sent" id="sent-link"><i class="fas fa-paper-plane"></i> Sent</a>
    <a href="emails.php?source=trash" id="trash"><i class="fas fa-trash"></i> Trash</a>
    <a href="emails.php?source=starred" id="starred"><i class="fas fa-star"></i> Starred</a>
    <a href="emails.php?source=draft" id="draft"><i class="fa fa-file"></i> Drafts</a>
    <!-- <a href="profile.php" id="profile"><i class="fas fa-user"></i> Profile</a> -->

    <hr class="side-line">

    <form action="../logout.php" method="POST">
      <input type="submit" name="logout" class="logout-btn" value="logout">
    </form>
  </div>
  <!-- <span title="menu" onclick="openNav()" class="bars"><i class="fas fa-bars"></i></span> -->
</nav>

<?php
$directoryURI = basename($_SERVER['SCRIPT_NAME']);
if ($directoryURI == "index.php") {
  echo "<script>document.getElementById('inbox-link').classList.add('active-link');</script>";
} else if ($directoryURI == "compose.php") {
  echo "<script>document.getElementById('compose-link').classList.add('active-link');</script>";
} else if ($_SERVER['QUERY_STRING'] == 'source=sent') {
  echo "<script>document.getElementById('sent-link').classList.add('active-link');</script>";
} else if ($_SERVER['QUERY_STRING'] == 'source=trash') {
  echo "<script>document.getElementById('trash').classList.add('active-link');</script>";
} else if ($_SERVER['QUERY_STRING'] == 'source=draft') {
  echo "<script>document.getElementById('draft').classList.add('active-link');</script>";
} else if ($_SERVER['QUERY_STRING'] == 'source=starred') {
  echo "<script>document.getElementById('starred').classList.add('active-link');</script>";
} else if ($directoryURI == "profile.php") {
  echo "<script>document.getElementById('profile').classList.add('active-link');</script>";
}
?>