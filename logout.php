<?php
// old way not ptotected (user can go back)
// $_SESSION['name'] = null;
// $_SESSION['id'] = null;
// $_SESSION['dob'] = null;
// $_SESSION['gender'] = null;
// $_SESSION['email'] = null;

// new way user cant go back
session_start();
session_destroy();

header("Location: index.php");
