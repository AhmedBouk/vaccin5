<?php
include('../inc/pdo.php');
include('inc/header.php');
include('inc/fonctions.php');
include('inc/sidebar.php');



$user = $_GET['user'];

$sql= "SELECT * FROM v5_users WHERE status='actif'";

  $query = $pdo -> prepare($sql);
  $query -> execute();
  $usercompte = $query -> fetchColumn();

print_r($usercompte);

$choixDate = explode("-", $_POST['year']);
$sql = "SELECT COUNT(id) FROM v5_users WHERE created_at BETWEEN >= :mois1 AND <= :mois2";
    $query = $pdo -> prepare($sql);
    $query -> bindValue(':mois1', $choixDate, PDO::PARAM_STR);
    $query -> bindValue(':mois2', $choixDate, PDO::PARAM_STR);
    $query -> execute();
    $date = $query -> fetchAll();



debug();

 ?>

 <!-- Content Header (Page header) -->
 <section class="content-header">
   <h1>
     Home
   </h1>
   <ol class="breadcrumb">
     <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
   </ol>
 </section>


   <!-- LINE CHART -->
   <div class="box box-info">
     <div class="box-header with-border">
       <h3 class="box-title">Nombre d'utilisateurs inscrits</h3>

       <div class="box-tools pull-right">
         <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
         </button>
         <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
       </div>
     </div>
     <div class="box-body chart-responsive">
       <div class="chart" id="line-chart" style="height: 300px;"></div>
     </div>
     <!-- /.box-body -->
   </div>
       <!-- /.box-body -->


    <section class="content">
      <!-- Default box -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <?php include('inc/footer.php');
