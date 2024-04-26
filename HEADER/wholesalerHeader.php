
<header>
  <?php
    if(!isset($_SESSION['wholesalerId'])){
      session_destroy();
      session_unset();
      //if there is no session then means the person is not logged in so take the person to login page
      ?>
      <script>window.location = "../WHOLESALER/wholesalerLogin.php";</script>
      <?php
      die;
    } elseif (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
      //if the session has been inactive for more than one hour then destroy the session so the user logs in again
      session_destroy();
      session_unset();
      ?><script>window.location = "../WHOLESALER/wholesalerLogin.php.php";</script><?php
  }
  //return the session's last active time to the current time
  $_SESSION['LAST_ACTIVITY'] = time();
  ?>
  <article id="headerArt">
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
      <!-- Container wrapper -->
      <div class="container-fluid">
        <!-- Toggle button -->
        <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarSupportedContent"  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Navbar brand -->
          <a class="navbar-brand mt-2 mt-lg-0" href="#">
          <span class="fas fa-warehouse"></span>
          </a>
          <!-- Left links -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)" id="inventoryTrackingBtn">Inventory Tracking</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)" id="wholesalerSalesAndOrderBtn">Sales And Order</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)" id="reportingAndAnalyticsBtn">Reports And Analysis</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)" id="accountingSystemBtn">My Account.</a>
            </li>
          </ul>
          <!-- Left links -->
        </div>
        <!-- Collapsible wrapper -->

        <!-- Right elements -->
        <div class="d-flex align-items-center">
          <!-- Icon -->
          <a class="text-reset me-3" href="#">
            <i class="fas fa-shopping-cart"></i>
          </a>

          <!-- Notifications -->
          <div class="dropdown">
            <a data-mdb-dropdown-init class="text-reset me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" aria-expanded="false">
              <i class="fas fa-bell"></i>
              <span class="badge rounded-pill badge-notification bg-danger">1</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
              <li>
                <a class="dropdown-item" href="#">Some news</a>
              </li>
              <li>
                <a class="dropdown-item" href="#">Another news</a>
              </li>
              <li>
                <a class="dropdown-item" href="#">Something else here</a>
              </li>
            </ul>
          </div>
          <!-- Avatar -->
          <div class="dropdown">
            <a data-mdb-dropdown-init class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#"  id="navbarDropdownMenuAvatar" role="button" aria-expanded="false">
            <span class="fas fa-circle-chevron-down">
              <img id="wholesalerLogo" src="<?php echo $wholesalerLogoPath; ?>" class='img-fluid' alt='<?php echo $wholesalerLogo; ?>'/>
            </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
              <li>
                <a class="dropdown-item" href="wholesalerProfile.php?wholesalerLoginId=<?php echo $wholesalerLoginId; ?>">My profile</a>
              </li>
              <li>
                <a class="dropdown-item" href="#">Settings</a>
              </li>
              <li>
                <a class="dropdown-item" href="wholesalerLogout.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
        <!-- Right elements -->
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  </article>
</header>