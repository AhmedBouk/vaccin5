<?php
  include('inc/header.php');


  $sql = "SELECT * FROM v5_vaccin";

  $query= $pdo -> prepare($sql) ;
  $query-> execute();
  $tableauVaccins = $query -> fetchall();



  include('inc/sidebar.php');
?>
<section class="content-header">
  <h1>
    Liste des vaccins
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
         <li class="active">Liste des vaccins</li>
  </ol>
</section>

<div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="example2_paginate" class="table table-hover">
                <tr>
                  <th>Id</th> <!-- titre -->
                  <th>Nom</th>
                  <th>Obligatoire</th>
                  <th>Fréquences d'injection</th>
                  <th>Created_at</th>
                  <th>Uptaded_at</th>
                  <th>Modifier</th>
                </tr>
                <?php foreach ($tableauVaccins as $tableauVaccin) {
                    echo '<tr><td>'.$tableauVaccin['id']
                    .'</td><td>'
                    .$tableauVaccin['nom']
                    .'</td>';
                    if ($tableauVaccin['obligatoire'] == 1){
                       echo '<td><span class="label label-success"</span>Obligatoire</td>';
                    } else {
                      echo '<td><span class="label label-danger">Non obligatoire</span></td>';
                    }
                    echo '</td><td>'
                    .$tableauVaccin['frequences_injections']
                    .'</td><td>'
                    .$tableauVaccin['created_at']
                    .'</td><td>'
                    .$tableauVaccin['updated_at']
                    .'</td><td><a href="modification_vaccins.php" class=".btn.btn-app"><i class="fa fa-edit"></i></a><td></tr>' ;
                } ?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

          <?php
            include('inc/footer.php');
