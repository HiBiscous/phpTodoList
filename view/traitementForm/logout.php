<?php
session_start();

session_destroy();
unset($_SESSION['id_users']);

header('Location: ../../index.php');
exit();
