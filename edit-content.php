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
    $contentName=$_POST['contentName'];
    $categoryId=$_POST['categoryId'];
    $subCategoryId=$_POST['subCategoryId'];
    $author=$_POST['author'];
    $edition=$_POST['edition'];
    $session=$_POST['session'];

    $loc = "files/";
    $filename = $_FILES['file']['name'];
    $tmpname = $_FILES['file']['tmp_name'];
    $filesize = $_FILES['file']['size'];
    $filetype = $_FILES['file']['type'];
    $file = $loc.$filename;
    $rslt = move_uploaded_file($tmpname,$file);
    /*error_reporting(E_ERROR | E_PARSE);
    if(!isset($rslt)){
      echo "Fail to Upload";
      echo "Try Again";
      exit();
    }*/

      $submittedBy=$_POST['submittedBy'];

      $contentid=intval($_GET['contentid']);
      $sql="update  contents set contentName=:contentName,categoryId=:categoryId,subCategoryId=:subCategoryId,author=:author,edition=:edition,session=:session,file=:file,submittedBy=:submittedBy where id=:contentid";
      $query = $dbh->prepare($sql);
      $query->bindParam(':contentName',$contentName,PDO::PARAM_STR);
      $query->bindParam(':categoryId',$categoryId,PDO::PARAM_INT);
      $query->bindParam(':subCategoryId',$subCategoryId,PDO::PARAM_INT);
      $query->bindParam(':author',$author,PDO::PARAM_STR);
      $query->bindParam(':edition',$edition,PDO::PARAM_STR);
      $query->bindParam(':session',$session,PDO::PARAM_STR);
      $query->bindParam(':file',$file,PDO::PARAM_STR);
      $query->bindParam(':submittedBy',$submittedBy,PDO::PARAM_STR);
      $query->execute();
      $_SESSION['msg']="Book info updated successfully";
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
      <title>E-Library | Edit Content</title>
      <!-- BOOTSTRAP CORE STYLE  -->
      <link href="assets/css/bootstrap.css" rel="stylesheet" />
      <!-- FONT AWESOME STYLE  -->
      <link href="assets/css/font-awesome.css" rel="stylesheet" />
      <!-- CUSTOM STYLE  -->
      <link href="assets/css/style.css" rel="stylesheet" />
      <!-- GOOGLE FONT -->
      <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    </head>
    <body style="background-image:url('./assets/img/bg.jpg');">
      <!------MENU SECTION START-->
      <?php include('includes/userheader.php');?>
      <!-- MENU SECTION END-->

      <div class="content-wrapper">
       <div class="container">
        <div class="row pad-botm">
          <div class="col-md-12">
            <h4 class="header-line" style="color:white;">Update Content</h4>

          </div>

        </div>
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
            <div class="panel panel-info">
              <div class="panel-heading">
                Update Content Info
              </div>
              <div class="panel-body">
                <form role="form" method="post" enctype="multipart/form-data">
                  <?php 
                  $contentid=intval($_GET['contentid']);
                  $sql="SELECT category.CategoryName,subcategory.subCategoryName,contents.contentName,contents.author,contents.edition,contents.session,contents.submittedBy from category join subcategory on category.id=subcategory.categoryId join contents on subcategory.id=contents.subCategoryId where contents.id=:contentid";

                  $query = $dbh -> prepare($sql);
                  $query->bindParam(':contentid',$contentid,PDO::PARAM_INT);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                  $cnt=1;
                  if($query->rowCount() > 0)
                  {
                    foreach($results as $result)
                      {               ?>  

                        <div class="form-group">
                          <label>Content Name<span style="color:red;">*</span></label>
                          <input class="form-control" type="text" name="contentName" value="<?php echo htmlentities($result->contentName);?>" placeholder="Enter Content or Book Name" required />
                        </div>

                        <div class="form-group">
                          <label> Category</label>
                          <select class="form-control" name="categoryId" required="required">
                            <!-- <option value="<?php //echo htmlentities($result->categoryId);?>"> <?php //echo htmlentities($catname=$result->CategoryName);?></option> -->
                            <option value="">Select Sub Category</option>
                            <?php 
                            $status=1;
                            $sql1 = "SELECT * from  category where Status=:status";
                            $query1 = $dbh -> prepare($sql1);
                            $query1-> bindParam(':status',$status, PDO::PARAM_STR);
                            $query1->execute();
                            $resultss=$query1->fetchAll(PDO::FETCH_OBJ);
                            if($query1->rowCount() > 0)
                            {
                              foreach($resultss as $row)
                              {           
                                if($catname==$row->CategoryName)
                                {
                                  continue;
                                }
                                else
                                {
                                  ?> 
                                  <option value="<?php echo htmlentities($row->id);?>"><?php echo htmlentities($row->CategoryName);?></option>
                                  <?php }}} ?> 
                                </select>
                              </div>

                              <div class="form-group">
                                <label> Sub Category</label>
                                <select class="form-control" name="subCategoryId" required="required">
                                  <!-- <option value="<?php //echo htmlentities($result->subCategoryId);?>"> <?php //echo htmlentities($subcatname=$result->subCategoryName);?></option> -->
                                  <option value="">Select Category</option>
                                  <?php 
                                  $status=1;
                                  $sql2 = "SELECT * from  subcategory where Status=:status";
                                  $query2 = $dbh -> prepare($sql2);
                                  $query2-> bindParam(':status',$status, PDO::PARAM_STR);
                                  $query2->execute();
                                  $resultsub=$query2->fetchAll(PDO::FETCH_OBJ);
                                  if($query1->rowCount() > 0)
                                  {
                                    foreach($resultsub as $rowsub)
                                    {           
                                      if($subcatname==$rowsub->subCategoryName)
                                      {
                                        continue;
                                      }
                                      else
                                      {
                                        ?>  
                                        <option value="<?php echo htmlentities($rowsub->id);?>"><?php echo htmlentities($rowsub->subCategoryName);?></option>
                                        <?php }}} ?> 
                                      </select>
                                    </div>

                                    <div class="form-group">
                                     <label> Author</label>
                                     <input class="form-control" type="text" name="author" value="<?php echo htmlentities($result->author);?>" placeholder="Enter Author Name" />
                                     <p class="help-block">Writter of the Book or Content</p>
                                   </div>

                                   <div class="form-group">
                                    <label>Edition</label>
                                    <input class="form-control" type="text" name="edition" value="<?php echo htmlentities($result->edition);?>" placeholder="Enter Book Edition" required="required" />
                                  </div>

                                  <div class="form-group">
                                   <label>Session</label>
                                   <input class="form-control" type="text" name="session" value="<?php echo htmlentities($result->session);?>"  placeholder="Enter Session" required="required" />
                                 </div>
                                 <div class="form-group">
                                   <label>File</label>
                                   <input class="form-control" type="file" name="file" value="" />
                                 </div>
                                 <div class="form-group">
                                   <label>Submitted By</label>
                                   <input class="form-control" type="text" name="submittedBy" value="<?php echo htmlentities($result->submittedBy);?>"  placeholder="Enter Your Name"  />
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
