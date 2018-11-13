<?php
include('inc/fonctions.php');
include('inc/pdo.php');
include('dashboard_vaccin/inc/request.php');
$title = 'Ajout de vaccin';

$sql = "SELECT * FROM v5_vaccin WHERE 1=1";
$query= $pdo -> prepare($sql) ;
$query-> execute();
$tableauVaccins = $query -> fetchall();


include('inc/header.php');

?>
<!-- Il y a une id class container autour du body  -->

<div class="">
            <div class="">
            </div>
            <!-- /.box-header -->
            <div class="">
              <table class="">
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
                    .'</td><td>';
                    changementDate($tableauVaccin,'created_at');
                    echo '</td><td>';
                    changementDate($tableauVaccin,'updated_at');
                    echo '</td><td><a href="modification_vaccins.php?id='.$tableauVaccin['id'].'" class=".btn.btn-app"><i class="fa fa-edit"></i></a><td></tr>' ;
                }


                ?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>













<?php include('inc/footer.php');
