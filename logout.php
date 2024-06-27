<?php
// User Logout Dev
session_start();
unset($_SESSION["UserId"]);
unset($_SESSION["UserEmail"]);
unset($_SESSION["UserProfile"]);
unset($_SESSION["UserFullName"]);
unset($_SESSION["UserPassword"]);
unset($_SESSION["UserPhone"]);
header("Location: index.php");
