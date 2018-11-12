<?php

include('inc/header.php');
include('inc/sidebar.php');
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

 <div class="box box-info">
       <div class="box-header with-border">
         <h3 class="box-title">Nombre d'utilisateurs inscrits en 2018</h3>

         <div class="box-tools pull-right">
           <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
           </button>
           <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
         </div>
       </div>
       <div class="box-body">
         <div class="chart">
           <canvas id="lineChart" style="height: 300px; width: 361px;" width="361" height="300"></canvas>
         </div>
       </div>
       <!-- /.box-body -->
  </div>

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
