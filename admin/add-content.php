<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/sessionchecker.php');
if(strlen($_SESSION['alogin'])==0)
{   
  header('location:../adminlogin.php');
} 

  if(isset($_POST['add']))
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
/*    error_reporting(E_ERROR | E_PARSE);
    if(!isset($rslt)){
      echo "Fail to Upload";
      echo "Try Again";
      exit();
    }*/

    $submittedBy=$_POST['submittedBy'];

    

    $sql="INSERT INTO  contents(contentName,categoryId,subCategoryId,author,edition,session,file,submittedBy) VALUES(:contentName,:categoryId,:subCategoryId,:author,:edition,:session,:file,:submittedBy)";
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
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
      $_SESSION['msg']="Content Listed successfully";
      header('location:manage-contents.php');
    }
    else 
    {
      $_SESSION['error']="Something went wrong. Please try again";
      header('location:manage-contents.php');
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
    <title>E-Library | Add A New Content</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

  </head>
   <script src="../jquery.min.js"></script>
  <body style="background-image: url('./assets/img/bg.jpg');">
  <script>
      $(document).ready(function() {
        $('#category').change(function(){
        //var st=$('#category option:selected').text();
        var cat_id=$('#category').val();
        $('#sub-category').empty(); //remove all existing options
        $.get('../subcheck.php',{'cat_id':cat_id},function(return_data){
          if(return_data.data.length>0){
            $('#msg').html( '('+ return_data.data.length + ' Subcategory Name Found )');
            $.each(return_data.data, function(key,value){
              $("#sub-category").append("<option value='" + value.id +"'>"+value.subCategoryName+"</option>");
            });
          }else{
            $('#msg').html(' (No Subcategory Found ) &nbsp;<a href="add-sub-category.php" class="btn btn-success" target="_blank">Add New</a>');
          }
        }, "json");
        });
    });
  </script>
<!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
 <div class="container">
  <div class="row pad-botm">
    <div class="col-md-12">
      <h4 class="header-line" style="color:white;">Add A New Content</h4>
    <?php //echo "<h1 style='color:white;'>Hello : ".$_SESSION['alogin']." Admin UserName : ".$admin."</h1>"; ?>
    </div>

  </div>
  <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
      <div class="panel panel-info">
        <div class="panel-heading">
          Content Info
        </div>
        <div class="panel-body">
          <form role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label>Content Name<span style="color:red;">*</span></label>
              <input class="form-control" type="text" name="contentName" placeholder="Enter Content Name" autocomplete="off"  required />
            </div>

            <div class="form-group">
              <label> Category<span style="color:red;">*</span></label>
              <select class="form-control" name="categoryId" id="category" required="required">
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

              
                  <div class='form-group'>
                    <label> Sub Category<span style='color:red;'>* </span></label><span id="msg">(Nothing Selected)</span>
                    <select class='form-control' name='subCategoryId' id='sub-category' required='required'>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Author</label>
                    <input class="form-control" type="text" name="author"  placeholder="Enter Author Name" autocomplete="off"  />
                    <p class="help-block">Writter of the Content or Book</p>
                  </div>

                  <div class="form-group">
                   <label>Edition</label>
                   <input class="form-control" type="text" name="edition" autocomplete="off"   placeholder="Enter Content Edition"  />
                 </div>
                 <div class="form-group">
                   <label>Session</label>
                   <input class="form-control" type="text" name="session" autocomplete="off"   placeholder="Enter Session" />
                 </div>
                 <div class="form-group">
                   <label>File</label>
                   <input class="form-control" type="file" name="file" autocomplete="off" />
                 </div>
                 <div class="form-group">
                   <label>Submitted By</label>
                   <input class="form-control" type="text" name="submittedBy" autocomplete="off"  placeholder="Enter Your Name" />
                 </div>
                 <button type="submit" name="add" class="btn btn-info">Add </button>

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