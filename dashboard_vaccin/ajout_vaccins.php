<?php
include('inc/header.php');
include('inc/sidebar.php');
  $error = array();

  if (!empty($_POST['submitted'])){
    -
    $nom = clean('nom');


    if (!empty($nom)){
      if(strlen($nom) < 3 ) {
        $error['nom'] = 'Le nom du vaccin est trop court. (minimum 3 caractères)';
      } elseif(strlen($nom) > 40) {
        $error['nom'] = 'Le nom du vaccin est trop long.  (maximum 40 caractères)';
      }
      }else {
      $error['nom'] = 'Veuillez entrer le nom du vaccin';
    }

debug($error);

  if (count($error) == 0){

    $sql = "INSERT INTO bdd_vaccin (nom, created_at) VALUES
    (:nom, :now())";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':nom',$nom, PDO::PARAM_STR);

    $stmt->execute();



  }
}

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
              <input type="text" class="form-control" id="inputError" name="nom" placeholder="Nom du vaccin...">
              <span class="help-block"><?php spanError($error,'nom') ?></span>
            </div>
            <!-- <div class="form-group">
              <div class="radio">
                <label>
                  <input type="radio" name="optionsRadios" id="optionsRadios1" value="1" >
                  Obligatoire
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="optionsRadios" id="optionsRadios2" value="0">
                  Optionnel
                </label>
              </div>
            </div>
            <div class="form-group"> -->

<input type="submit" name="submitted" value="ajouter">

            </div>

          </div>
          <!-- /.box-body -->

          <!-- <div class="box-footer">
            <button type="submit" name="submitted" class="btn btn-primary">Ajouter</button>
          </div> -->
        </form>
      </div>















</section>
<!-- fin content wrapper -->
</div>
<?php
  include('inc/footer.php');
?>
