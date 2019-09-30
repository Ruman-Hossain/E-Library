<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{   
    header('location:index.php');
}
else{ 

    if(isset($_POST['update']))
    {   
        $categoryId=$_POST['categoryId'];
        //echo $categoryId;echo "Category ID UPDATE";
        $subcategory=$_POST['subcategory'];
        $status=$_POST['status'];
        $catid=intval($_GET['catid']);
        $sql="update  subcategory set categoryId=:categoryId,subCategoryName=:subcategory,Status=:status where id=:catid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':categoryId',$categoryId,PDO::PARAM_INT);
        $query->bindParam(':subcategory',$subcategory,PDO::PARAM_STR);
        $query->bindParam(':status',$status,PDO::PARAM_STR);
        $query->bindParam(':catid',$catid,PDO::PARAM_STR);
        $query->execute();
        $_SESSION['updatemsg']="Brand updated successfully";
        header('location:manage-sub-categories.php');


    }
    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>E-Library | Edit Sub Categories</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    </head>
    <body style="background-image: url('./assets/img/bg.jpg');">
      <!------MENU SECTION START-->
      <?php include('includes/userheader.php');?>
      <!-- MENU SECTION END-->
      <div class="content-wra
      <div class="content-wrapper">
       <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line" style="color:white;">Edit Sub category</h4>

            </div>

        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
                <div class="panel panel-info">
                    <div class="panel-heading">
                       Sub Category Info
                   </div>

                   <div class="panel-body">
                    <form role="form" method="post">
                        <div class="form-group">
                            <label> Category Name<span style="color:red;">*</span></label>
                            <select class="form-control" name="categoryId" required="required">
                                <option value=""> Select Category</option>
                                <?php 
                                $status=1;
                                $sql = "SELECT * from  category where Status=:status";
                                $query = $dbh -> prepare($sql);
                                $query -> bindParam(':status',$status, PDO::PARAM_STR);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;
                                if($query->rowCount() > 0)
                                {
                                  foreach($results as $result)
                                    {               ?>  
                                      <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->CategoryName);?></option>
                                      <?php }} ?> 
                                  </select>
                              </div>
                              <?php 
                              $catid=intval($_GET['catid']);
                              $sql="SELECT * from subcategory where id=:catid";
                              $query=$dbh->prepare($sql);
                              $query-> bindParam(':catid',$catid, PDO::PARAM_STR);
                              $query->execute();
                              $results=$query->fetchAll(PDO::FETCH_OBJ);
                              if($query->rowCount() > 0)
                              {
                                foreach($results as $result)
                                {               
                                  ?>
                                  <div class="form-group">
                                    <label>Sub Category Name</label>
                                    <input class="form-control" type="text" name="subcategory" value="<?php echo htmlentities($result->subCategoryName);?>" required />
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <?php if($result->Status==1) {?>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="status" id="status" value="1" checked="checked">Active
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="status" id="status" value="0">Inactive
                                        </label>
                                    </div>
                                    <?php } else { ?>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="status" id="status" value="0" checked="checked">Inactive
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="status" id="status" value="1">Active
                                        </label>
                                        </div
                                        <?php } ?>
                                    </div>
                                    <?php }} ?>
                                    <button type="submit" name="update" class="btn btn-info">Update </button>

                                </form>
                            </div>
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
    <?php } ?>
