<div class="navbar navbar-inverse set-radius-zero" >
    <div class="container">
        <div class="navbar-header">
            <a href="dashboard.php" class="navbar-brand">
                <img src="../assets/img/eLibrary_logo_web.png" />
            </a>
        </div>
        <div class="right-div">
            <h4 class="bg-info text-white" style="padding:5px;border-radius:5px;">You Are Logged In As Admin</h4>
        </div>
    </div>
</div>
<!-- LOGO HEADER END-->
<section class="menu-section" style="background-color:cyan;">
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="navbar-collapse collapse ">
                    <a href="https://brur.ac.bd/" target="_blank" style="float:left;">
                        <img src="../assets/img/brur_logo.png" />
                    </a>
                    <ul id="menu-top" class="nav navbar-nav navbar-right">
                        <li><a href="dashboard.php" class="menu-top-active">Home</a></li>

                        <li>
                            <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Categories <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="add-category.php">Add Category</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="add-sub-category.php">Add Sub Category</a></li> -->
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-categories.php">Manage Categories</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-sub-categories.php">Manage Sub Categories</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="manage-contents.php">E-Library</a>
                            <!-- <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> E-Seminar <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="add-content.php">Add Content</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-contents.php">Manage Contents</a></li>
                            </ul> -->
                        </li>

                        <li><a href="reg-students.php">Registered Students</a></li>
                        <li>
                            <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Account Setting <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="change-password.php">Change Password</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="logout.php" class="btn btn-danger">Logout</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>