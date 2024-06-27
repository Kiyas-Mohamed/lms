<?php
// Admin Logout Dev
session_start();
unset($_SESSION["AdminId"]);
unset($_SESSION["AdminEmail"]);
unset($_SESSION["AdminProfile"]);
unset($_SESSION["AdminFullName"]);
unset($_SESSION["AdminPassword"]);
unset($_SESSION["AdminPhone"]);
unset($_SESSION["AdminStatus"]);
header("Location: index.php");
