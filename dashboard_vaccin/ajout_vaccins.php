<?php
include('inc/header.php');



// creer un tableau d'erreur
  $error = array();

// Condition de soumission du formulaire
  if (!empty($_POST['submitted'])){

    //Protection contre les failles xss
    $nom = trim(strip_tags($_POST['nom']));
    $injections = trim(strip_tags($_POST['frequences_injections']));

    //Recupere la valeur de radio et verification
    if (isset($_POST['optionsRadios'])){
    $obligatoire = $_POST['optionsRadios'];
    }else {
      $error['optionsRadios'] = 'Veuillez selectionnez une option';
    }
    //Verification contenu
    if (!empty($nom)){
      if(strlen($nom) < 3 ) {
        $error['nom'] = 'Le nom du vaccin est trop court. (minimum 3 caractères)';
      } elseif(strlen($nom) > 40) {
        $error['nom'] = 'Le nom du vaccin est trop long.  (maximum 40 caractères)';
      }
      }else {
      $error['nom'] = 'Veuillez entrer le nom du vaccin';
    }
    //verification content
    if (!empty($injections)){
        if(strlen($injections) < 3 ) {
    $error['frequences_injections'] = 'Votre contenu est trop court. (minimum 3 caractères)';
  }

    } else {
      $error['frequences_injections'] = 'Veuillez renseigner un contenu';
    }
    //Condition pas d'erreur
  if (count($error) == 0){

    $sql = "INSERT INTO v5_vaccin (nom, obligatoire,frequences_injections , created_at) VALUES
    (:nom, :obligatoire,:injections,now())";
    // preparation de la requête
    $stmt = $pdo->prepare($sql);
    // Protection injections SQL
    $stmt->bindValue(':nom',$nom, PDO::PARAM_STR);
    $stmt->bindValue(':obligatoire',$obligatoire, PDO::PARAM_INT);
    $stmt->bindValue(':frequencesInjections',$injections, PDO::PARAM_STR);
    // execution de la requête preparé
    $stmt->execute();

    header("Location: index.php");

  }
}
include('inc/sidebar.php');
?>
<section class="content-header">
  <h1>
    Ajout de vaccins
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
         <li class="active">Ajout de vaccins</li>
  </ol>
</section>

    <section class="content">
      <div class="box box-primary">
        <!-- /.box-header -->
        <!-- form start -->
        <form action="" method="POST" role="form">
          <div class="box-body">
            <div class="form-group">
              <label for="nom">Nom du vaccin</label>
              <input type="text" class="form-control" id="inputError" name="nom" placeholder="Nom du vaccin..." value="<?php if(!empty($_POST['nom'])) { echo $_POST['nom']; } ?>">
              <span class="error"><?php spanError($error,'nom');?></span>
            </div>

            <div class="form-group">
         			<label for="frequences_injections">Fréquence d'injection : </label>
   			            <span class="error"><?php if(!empty($error['frequences_injections'])) { echo $error['frequences_injections']; } ?></span>
   			                <textarea name="frequences_injections" class="form-control" rows="5" id="content"><?php if(!empty($_POST['frequences_injections'])) { echo $_POST['frequences_injections']; } ?></textarea>
   		                 </div>

            <div class="form-group">
              <div class="radio">
                <label>
                  <input type="radio" name="optionsRadios" id="optionsRadios1" value="obligatoire" >
                  Obligatoire
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="optionsRadios" id="optionsRadios2" value="optionnel">
                  Optionnel
                </label>
              </div>
              <span class="error"><?php spanError($error,'optionsRadios');?></span>
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">

            <input type="submit" name="submitted" class="btn btn-primary" value="Ajouter" >
          </div>
        </form>
      </div>















</section>
<!-- fin content wrapper -->
</div>
<?php
  include('inc/footer.php');
?>
