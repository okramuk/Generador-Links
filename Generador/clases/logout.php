<?php
session_start();
unset($_SESSION['usuario']); 
unset($_SESSION['username']); 
unset($_SESSION['password']); 
unset($_SESSION['organizacion']); 
unset($_SESSION['provincia']); 
header('Location: ../index.html');
?>