<div class="navbar navbar-inverse set-radius-zero" >
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="./dashboard.php" >
        <img src="assets/img/eLibrary_logo_web.png" />
      </a>

    </div>
    <?php if($_SESSION['login'])
    {
      ?> 
      <div class="right-div">
        <a href="logout.php" class="btn btn-danger pull-right">LOG ME OUT</a>
      </div>
      <?php }?>
    </div>
  </div>
  <!-- LOGO HEADER END-->
  <section class="menu-section" style="background-color:cyan;">
    <div class="container">
      <div class="row ">
        <div class="col-md-12">
          <div class="navbar-collapse collapse ">
            <a href="https://brur.ac.bd/" target="_blank" style="float:left;">
              <img src="./assets/img/brur_logo.png" />
            </a>
            <ul id="menu-top" class="nav navbar-nav navbar-right">                        

              <li><a href="adminlogin.php">Admin Login</a></li>
              <li><a href="index.php">User Login</a></li>


            </ul>
          </div>
        </div>

      </div>
    </div>
  </section>