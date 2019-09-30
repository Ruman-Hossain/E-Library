<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/sessionchecker.php');
if(strlen($_SESSION['alogin'])==0)
{ 
  header('location:../adminlogin.php');
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <![endif]-->
      <title>E-Library | Dashboard</title>
      <!-- BOOTSTRAP CORE STYLE  -->
      <link href="assets/css/bootstrap.css" rel="stylesheet" />
      <!-- FONT AWESOME STYLE  -->
      <link href="assets/css/font-awesome.css" rel="stylesheet" />
      <!-- CUSTOM STYLE  -->
      <link href="assets/css/style.css" rel="stylesheet" />
      <!-- GOOGLE FONT -->
      <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    </head>
    <body style="background-image:url('assets/img/bg.jpg');">
      <!------MENU SECTION START-->
      <?php include('includes/header.php');?>
      <!-- MENU SECTION END-->
      <div class="content-wrapper">
       <div class="container">
        <div class="row pad-botm">
          <div class="col-md-12">
            <h4 class="header-line" style="color:white;">DASHBOARD</h4>

          </div>

        </div>

        <div class="row">

         <div class="col-md-3 col-sm-3 col-xs-6">
          <div class="alert alert-success back-widget-set text-center">
            <i class="fa fa-book fa-5x"></i>
            <?php 
            $sql ="SELECT id from contents where edition IS NOT NULL ";
            $query = $dbh -> prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $listdbooks=$query->rowCount();
            ?>


            <h3 style="color:white;"><?php echo htmlentities($listdbooks);?></h3>
            <span style="color:white;">Available Contents</span>
          </div>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-6">
          <div class="alert alert-danger back-widget-set text-center">
            <i class="fa fa-users fa-5x"></i>
            <?php 
            $sql3 ="SELECT id from students ";
            $query3 = $dbh -> prepare($sql3);
            $query3->execute();
            $results3=$query3->fetchAll(PDO::FETCH_OBJ);
            $regstds=$query3->rowCount();
            ?>
            <h3 style="color:white;"><?php echo htmlentities($regstds);?></h3>
            <span style="color:white;">Registered Students</span>
          </div>
        </div>

       <div class="col-md-3 col-sm-3 col-xs-6">
        <div class="alert alert-success back-widget-set text-center">
          <i class="fa fa-user fa-5x"></i>
          <?php 
          $sql4 ="SELECT id from contents WHERE author IS NOT NULL ";
          $query4 = $dbh -> prepare($sql4);
          $query4->execute();
          $results4=$query4->fetchAll(PDO::FETCH_OBJ);
          $listdathrs=$query4->rowCount();
          ?>


          <h3 style="color:white;"><?php echo htmlentities($listdathrs);?></h3>
          <span style="color:white;">Authors Listed</span>
        </div>
      </div>


      <div class="col-md-3 col-sm-3 rscol-xs-6">
        <div class="alert alert-info back-widget-set text-center">
          <i class="fa fa-file-archive-o fa-5x"></i>
          <?php 
          $sql5 ="SELECT id from category ";
          $query5 = $dbh -> prepare($sql5);
          $query5->execute();
          $results5=$query5->fetchAll(PDO::FETCH_OBJ);
          $listdcats=$query5->rowCount();
          ?>

          <h3 style="color:white;"><?php echo htmlentities($listdcats);?> </h3>
          <span style="color:white;">Listed Categories</span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 col-sm-3 rscol-xs-6">
        <div class="alert alert-info back-widget-set text-center">
          <i class="fa fa-list-alt fa-5x"></i>
          <?php 
          $sql6 ="SELECT id from subcategory ";
          $query6 = $dbh -> prepare($sql6);
          $query6->execute();
          $results6=$query6->fetchAll(PDO::FETCH_OBJ);
          $listdsubcats=$query6->rowCount();
          ?>

          <h3 style="color:white;"><?php echo htmlentities($listdsubcats);?> </h3>
          <span style="color:white;">Listed Sub Categories</span>
        </div>
      </div>

        <div class="col-md-3 col-sm-3 col-xs-6">
          <div class="alert alert-success back-widget-set text-center">
            <i class="fa fa-users fa-5x"></i>
            <?php 
            $sql8 ="SELECT id from students where Status =1 ";
            $query8 = $dbh -> prepare($sql8);
            $query8->execute();
            $results8=$query8->fetchAll(PDO::FETCH_OBJ);
            $active8=$query8->rowCount();
            ?>
            <h3 style="color:white;"><?php echo htmlentities($active8);?></h3>
            <span style="color:white;">Active Students</span>
          </div>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-6">
          <div class="alert alert-danger back-widget-set text-center">
            <i class="fa fa-ban fa-5x"></i>
            <?php 
            $sql9 ="SELECT id from students where Status = 0 ";
            $query9 = $dbh -> prepare($sql9);
            $query9->execute();
            $results9=$query9->fetchAll(PDO::FETCH_OBJ);
            $Blocked9=$query9->rowCount();
            ?>
            <h3 style="color:white;"><?php echo htmlentities($Blocked9);?></h3>
            <span style="color:white;">Blocked Students</span>
          </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6">
          <div class="alert alert-success back-widget-set text-center">
            <i class="fa fa-adn fa-5x"></i>
            <?php 
            $sql10 ="SELECT distinct count(submittedBy) from contents";
            $query10 = $dbh -> prepare($sql10);
            $query10->execute();
            $results10=$query10->fetchAll(PDO::FETCH_OBJ);
            $contributors10=$query10->rowCount();
            ?>
            <h3 style="color:white;"><?php echo htmlentities($contributors10);?></h3>
            <span style="color:white;">Total Contributors</span>
          </div>
        </div>

    </div>             

    <div class="row">

      <div class="col-md-10 col-sm-8 col-xs-12 col-md-offset-1">
        <div id="carousel-example" class="carousel slide slide-bdr" data-ride="carousel" >

          <div class="carousel-inner">
            <div class="item active">

              <img src="assets/img/1.jpg" alt="" />

            </div>
            <div class="item">
              <img src="assets/img/2.jpg" alt="" />

            </div>
            <div class="item">
              <img src="assets/img/3.jpg" alt="" />

            </div>
          </div>
          <!--INDICATORS-->
          <ol class="carousel-indicators">
            <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example" data-slide-to="1"></li>
            <li data-target="#carousel-example" data-slide-to="2"></li>
          </ol>
          <!--PREVIUS-NEXT BUTTONS-->
          <a class="left carousel-control" href="#carousel-example" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#carousel-example" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
        </div>
      </div>





    </div>

  </div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<?php include('includes/footer.php');?>
<!-- FOOTER SECTION END-->
<!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
<!-- CORE JQUERY  -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
<!-- CUSTOM SCRIPTS  -->
<script src="assets/js/custom.js"></script>
</body>
</html>
