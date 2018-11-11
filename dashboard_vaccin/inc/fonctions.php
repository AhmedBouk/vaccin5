<?php
// Saute une ligne
function br(){
  echo '<br>';
}
//Affiche un tableau de façon claire
function debug($array){
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}
//Affiche une erreur dans le formulaire
function spanError($error, $key){
    if(!empty($error[$key])) {
    echo $error[$key]; }
}
//Ne prends pas en compte les balises html et php dans le champ
function clean($key){
  return trim(strip_tags($_POST[$key]));
}
function value($key){
	 if(!empty($_POST[$key])) {
     echo $_POST[$key]; }
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function is_logged(){
  if (
    !empty($_SESSION['user']['id'])
  && !empty($_SESSION['user']['pseudo'])
  && !empty($_SESSION['user']['email'])
  && !empty($_SESSION['user']['role'])
  && $_SESSION['user']['ip'] = $_SERVER['REMOTE_ADDR']){
    return true;
  }else {
  return false;
  }
}
function is_admin(){
  if (is_logged() == true && $_SESSION['user']['role'] === 'admin'){
    return true;
  }
}
