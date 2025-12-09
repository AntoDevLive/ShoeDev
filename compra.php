<?php session_start();

if(isset($_SESSION['username'])) {
  header('Location: /shoedev/user/compras.php');
} else {
  header('Location: /shoedev?session=false');
}