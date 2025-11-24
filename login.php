<?php session_start();

if(!isset($_SESSION['username'])) {
  require 'frontend/views/login.view.php';
} else {
  header('Location: /shoedev/index.php');
}