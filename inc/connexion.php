<?php
  $error_log = array();
// Lors de la soumission du formulaire
if(!empty($_POST['submit_login'])){

// fonction declarant et nettoyant (expace au debut et à la fin & supprimant les caractère pouvant créer un script) une variable
$mail_login  = clean('mail');
$pwd_loggin  = clean('pwd');

// test si le mail existe
$sql="SELECT * FROM v5_users WHERE mail =:mail "; //requete à modifier
$query= $pdo -> prepare($sql) ;//preparer la requete
$query-> bindvalue(':mail' , $mail_login , PDO::PARAM_STR );
$query-> execute(); //execute la requete
$user = $query -> fetch(); // $a variable retourner / fetchall() pour les requetes avec multiple array sinon fetch()

// test si le mot de passe existe
if(!empty($user)) {
  if (!password_verify ($pwd_loggin , $user['mdp'] )) {
    $error_log['pwd'] = 'Mauvais mot de passe';
  }
  }else{
    $error_log['mail'] = 'Veuillez vous inscrire';
}

if (count($error_log) == 0) {
  $_SESSION['user'] = array(
    'id'      =>$user['id'],
    'nom'     =>$user['nom'],
    'prenom'  =>$user['prenom'],
    'mail'    =>$user['mail'],
    'sexe'    =>$user['sexe'],
    'date_naissance'    =>$user['date_naissance'],
    'role'    =>$user['role'],
    'ip'      =>$_SERVER["REMOTE_ADDR"]

  );

  header('location: index.php');
}

}
