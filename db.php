<?php

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'mail_server';

$connection = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (!$connection) {
  die("connection failed" . mysqli_error($connection));
}
