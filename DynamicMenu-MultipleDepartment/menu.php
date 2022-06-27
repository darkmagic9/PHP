<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/PHP/">
    <img src="http://localhost/AdminLTE/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Dynamic Menu</span>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse order-3" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/PHP/DynamicMenu-MultipleDepartment/">Home <span class="sr-only">(current)</span></a>
      </li>
      <!--  <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li> -->
      <?php
      // error_reporting(E_ERROR);
      include 'database.php';
      $url = basename($_SERVER['REQUEST_URI']);
      echo "<script>console.log('". $url ."')</script>";
      
      ///GET SUBMENU ID 
      $submenuidqy = "SELECT * FROM sub_menu where submenu_url='$url'";
      $submenuidres = mysqli_query($con, $submenuidqy);
      $submenuiddata = mysqli_fetch_assoc($submenuidres);
      if ($submenuiddata) {
        $submenu_id = $submenuiddata['submenu_id'];
      } else {
        $submenu_id = "";
      }

      $login_user = 1;
      
      ///check user name
      $userqry = "SELECT * FROM `users` WHERE user_id='$login_user'";
      $userres = mysqli_query($con, $userqry);
      $userdta = mysqli_fetch_assoc($userres);
      if ($userdta) {
        $user_name = $userdta['user_name'];
        $user_department = $userdta['user_department'];
      } else {
        $user_name = "";
        $user_department = "";
      }
      
      
      // $user_permission = false;
      ///fetch the department of user
      $userdeptqry = "SELECT user_department FROM users where user_id='$login_user'";
      $userdeptres = mysqli_query($con, $userdeptqry);
      $userdeptdata = mysqli_fetch_assoc($userdeptres);
      if ($userdeptdata) {
        $userdepartment = $userdeptdata['user_department'];
      } else {
        $userdepartment = "";
      }
      

      //get department of submenu
      $deptqry = "SELECT * FROM submenu_department where sub_menu_id='$submenu_id' AND department_id='$userdepartment'";
      $deptres = mysqli_query($con, $deptqry);
      $deptrow = mysqli_num_rows($deptres);
      if ($deptrow > 0) {
        $user_permission = 'True';
      } else {
        $user_permission = 'False';
      }

      $menulistqry = "SELECT * FROM menu where menu_status='Enable' order by menu_order asc";
      $menulistres = mysqli_query($con, $menulistqry);
      while ($menulistdata = mysqli_fetch_assoc($menulistres)) {
        $menu_id = $menulistdata['menu_id'];

        $submenulistqry = "SELECT * FROM sub_menu inner join submenu_department on submenu_department.sub_menu_id=sub_menu.submenu_id ";
        $submenulistqry .= "where submenu_status='Enable' AND sub_menu.menu_id='$menu_id' AND submenu_display='Yes' ";
        $submenulistqry .= "AND submenu_department.department_id='$userdepartment' order by submenu_order asc";
        $submenulistres = mysqli_query($con, $submenulistqry);
        $submenutotal = mysqli_num_rows($submenulistres);
        if ($submenutotal > 0) {
      ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span><i class="<?php echo $menulistdata['menu_icon']; ?>"></i></span> <?php echo $menulistdata['menu_name']; ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <?php
              while ($submenulistdata = mysqli_fetch_assoc($submenulistres)) { ?>
                <a class="dropdown-item" href="<?php echo $submenulistdata['submenu_url']; ?>"><?php echo $submenulistdata['submenu_name']; ?></a>
              <?php } ?>
            </div>
          </li>
      <?php }
      } ?>

      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Setting
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="menu_add.php">Add Menu</a>
          <a class="dropdown-item" href="submenu_add.php">Add Sub Menu</a>
          <a class="dropdown-item" href="user_permission.php">Permission</a>
        </div>
      </li> -->
    </ul>
  </div>
  
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-comments"></i>
        <span class="badge badge-danger navbar-badge">3</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="https://adminlte.io/themes/v3/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                Brad Diesel
                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">Call me whenever you can...</p>
              <p class="text-sm text-muted"><i class="fas fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="https://adminlte.io/themes/v3/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                John Pierce
                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">I got your message bro</p>
              <p class="text-sm text-muted"><i class="fas fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="https://adminlte.io/themes/v3/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                Nora Silvester
                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">The subject goes here</p>
              <p class="text-sm text-muted"><i class="fas fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
      </div>
    </li>
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-bell"></i>
        <span class="badge badge-warning navbar-badge">15</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">15 Notifications</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i> 4 new messages
          <span class="float-right text-muted text-sm">3 mins</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-users mr-2"></i> 8 friend requests
          <span class="float-right text-muted text-sm">12 hours</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-file mr-2"></i> 3 new reports
          <span class="float-right text-muted text-sm">2 days</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </li>
    
    <li class="nav-item dropdown user-menu">
      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
        <span class="d-none d-md-inline"><?php echo $user_name; ?></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
        <li class="user-header bg-primary">
          <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">

          <p>
            <?php echo $user_name; ?> - Web Developer
            <small>Member since Nov. 2012</small>
          </p>
        </li>
        <!-- Menu Body -->
        <li class="user-body">
          <div class="row">
            <div class="col-4 text-center">
              <a href="menu_add.php">Menu</a>
            </div>
            <div class="col-4 text-center">
              <a href="submenu_add.php">SubMenu</a>
            </div>
            <div class="col-4 text-center">
              <a href="user_permission.php">Permission</a>
            </div>
          </div>
          <!-- /.row -->
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
          <a href="#" class="btn btn-default btn-flat">Profile</a>
          <a href="/PHP/" class="btn btn-default btn-flat float-right">Sign out</a>
        </li>
      </ul>
    </li>
  </ul>
</nav>