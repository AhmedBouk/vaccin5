<?php
include('../inc/pdo.php');
include('inc/fonctions.php');
include('inc/request.php');

if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];
  deleteuser($id);
  header("Location: liste_utilisateurs.php");
  }