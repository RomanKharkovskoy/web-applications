<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'];
  
  if ($action === 'login') {
    header("Location: login.html");
    exit();
  } elseif ($action === 'register') {
    header("Location: register.html");
    exit();
  }
}
?>