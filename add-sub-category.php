<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{   
    header('location:index.php');
}
else{ 

    if(isset($_POST['create']))
    {
        $categoryId=$_POST['categoryId'];
        //Get the id of the Category from the Category table
        $subCategoryName=$_POST['subCategoryName'];
        $status=$_POST['status'];
        $sql="INSERT INTO  subcategory(categoryId,subCategoryName,Status) VALUES(:categoryId,:subCategoryName,:status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':categoryId',$categoryId,PDO::PARAM_INT);
        $query->bindParam(':subCategoryName',$subCategoryName,PDO::PARAM_STR);
        $query->bindParam(':status',$status,PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if($lastInsertId)
        {
            $_SESSION['msg']="Brand Listed successfully";
            header('location:manage-sub-categories.php');
        }
        else 
        {
            $_SESSION['error']="Something went wrong. Please try again";
            header('location:manage-sub-categories.php');
        }

    }
    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>E-Library | Add Sub Categories</title>
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
                    <h4 class="header-line" style="color:white;">Add Sub category</h4>

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
                                  <div class="form-group">
                                    <label>Sub Category Name<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="subCategoryName" placeholder="Enter Sub Category Name..." autocomplete="off" required />
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
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

                                </div>
                                <button type="submit" name="create" class="btn btn-info">Create </button>

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
