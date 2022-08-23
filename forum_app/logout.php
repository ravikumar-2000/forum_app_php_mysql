<?php include 'include/header.php' ?>

<?php 

unset($_SESSION['user']);
header('Location: login.php');

?>