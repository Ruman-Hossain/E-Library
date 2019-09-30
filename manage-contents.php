<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{   
    header('location:index.php');
}
else{ 
    if(isset($_GET['del']))
    {
        $id=$_GET['del'];
        $sql = "delete from contents  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':id',$id, PDO::PARAM_STR);
        $query -> execute();
        $_SESSION['delmsg']="Category deleted scuccessfully ";
        header('location:manage-contents.php');

    }


    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>E-Library | Manage Contents</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- DATATABLE STYLE  -->
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    </head>
    <body style="background-image: url('./assets/img/bg.jpg');">
      <!------MENU SECTION START-->
      <?php include('includes/userheader.php');?>
      <!-- MENU SECTION END-->
      <div class="content-wrapper">
       <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line" style="color:white;">Manage Contents</h4>
            </div>
            <div class="row">
                <?php if($_SESSION['error']!="")
                {?>
                    <div class="col-md-6">
                        <div class="alert alert-danger" >
                           <strong>Error :</strong> 
                           <?php echo htmlentities($_SESSION['error']);?>
                           <?php echo htmlentities($_SESSION['error']="");?>
                       </div>
                   </div>
                   <?php } ?>
                   <?php if($_SESSION['msg']!="")
                   {?>
                    <div class="col-md-6">
                        <div class="alert alert-success" >
                           <strong>Success :</strong> 
                           <?php echo htmlentities($_SESSION['msg']);?>
                           <?php echo htmlentities($_SESSION['msg']="");?>
                       </div>
                   </div>
                   <?php } ?>
                   <?php if($_SESSION['updatemsg']!="")
                   {?>
                    <div class="col-md-6">
                        <div class="alert alert-success" >
                           <strong>Success :</strong> 
                           <?php echo htmlentities($_SESSION['updatemsg']);?>
                           <?php echo htmlentities($_SESSION['updatemsg']="");?>
                       </div>
                   </div>
                   <?php } ?>


                   <?php if($_SESSION['delmsg']!="")
                   {?>
                    <div class="col-md-6">
                        <div class="alert alert-success" >
                           <strong>Success :</strong> 
                           <?php echo htmlentities($_SESSION['delmsg']);?>
                           <?php echo htmlentities($_SESSION['delmsg']="");?>
                       </div>
                   </div>
                   <?php } ?>

               </div>


           </div>
           <div class="row">
              <div>
                <div class="panel panel-default">
                  <a href="add-content.php"><button class="btn btn-success"><i class="fa fa-plus "></i> Add New</button></a>
                </div>
              </div>
           </div>
           <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                     Content Listing
                 </div>
                 <div class="panel-body">
                    <div class="table-responsive">
                        <table class="col-md-12 table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Content Name</th>
                                    <th>Author</th>
                                    <th>Edition</th>
                                    <th>Session</th>
                                    <th>Submitted By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                                  $sql="SELECT contents.id,category.CategoryName,subcategory.subCategoryName,contents.contentName,contents.author,contents.edition,contents.session,contents.submittedBy from category join subcategory on category.id=subcategory.categoryId join contents on subcategory.id=contents.subCategoryId";

                                $query = $dbh -> prepare($sql);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;
                                if($query->rowCount() > 0)
                                {
                                    foreach($results as $result)
                                        {
                                           ?>                                      
                                            <tr class="odd gradeX">
                                                <td class="center"><?php echo htmlentities($cnt);?></td>
                                                <td class="center"><?php echo htmlentities($result->CategoryName);?></td>
                                                <td class="center"><?php echo htmlentities($result->subCategoryName);?></td>
                                                <td class="center"><?php echo htmlentities($result->contentName);?></td>
                                                <td class="center"><?php echo htmlentities($result->author);?></td>
                                                <td class="center"><?php echo htmlentities($result->edition);?></td>
                                                <td class="center"><?php echo htmlentities($result->session);?></td>
                                                <td class="center"><?php echo htmlentities($result->submittedBy);?></td>
                                                <td class="center">
                                                    <a href="view-content.php?contentid=<?php echo htmlentities($result->id);?>" target="_blank"><button class="btn btn-success"><i class="fa fa-eye"></i> View</button>
                                                    <!-- <a href="download-content.php?contentid=<?php //echo htmlentities($result->id);?>"><button class="btn btn-primary"><i class="fa fa-download "></i> Download</button> -->
                                                      </td>
                                                  </tr>
                                                  <?php $cnt=$cnt+1;}} ?>                                      
                                              </tbody>
                                          </table>
                                      </div>

                                  </div>
                              </div>
                              <!--End Advanced Tables -->
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
              <!-- DATATABLE SCRIPTS  -->
              <script src="assets/js/dataTables/jquery.dataTables.js"></script>
              <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
              <!-- CUSTOM SCRIPTS  -->
              <script src="assets/js/custom.js"></script>
          </body>
          </html>
          <?php } ?>
