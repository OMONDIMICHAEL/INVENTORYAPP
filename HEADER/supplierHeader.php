
<header>
  <?php
    if(!isset($_SESSION['supplierId'])){
      session_destroy();
      session_unset();
      //if there is no session then means the person is not logged in so take the person to login page
      ?>
      <script>window.location = "../SUPPLIER/supplierLogin.php";</script>
      <?php
      die;
    } elseif (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
      //if the session has been inactive for more than one hour then destroy the session so the user logs in again
      session_destroy();
      session_unset();
      ?><script>window.location = "../SUPPLIER/supplierLogin.php.php";</script><?php
  }
  //return the session's last active time to the current time
  $_SESSION['LAST_ACTIVITY'] = time();
  ?>
  <article id="headerArt">
    <nav class="navbar navbar-expand-sm">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)"><span class="bi bi-house"></span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)" id="supplierInventoryTrackingBtn">Inventory Tracking</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)" id="salesAndOrderBtn">Sales And Order</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)" id="supplierReportingAndAnalyticsBtn">Reports And Analysis</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)" id="supplierAccountBtn">My Account.</a>
            </li>
          </ul>
          <div class="d-flex align-items-center">
            <div>
              <a class="text-reset me-3" href="#">
                <i class="bi bi-cart-fill"></i>
              </a>
            </div>
            <div class="dropdown">
              <a class="dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" aria-expanded="false" data-bs-toggle="dropdown">
                <i class="bi bi-bell-fill"></i>
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
            <div class="dropdown">
              <a class="dropdown-toggle d-flex align-items-center" href="#"  id="navbarDropdownMenuAvatar" role="button" aria-expanded="false" data-bs-toggle="dropdown">
              <!-- <span class="bi bi-caret-down-fill"> -->
                <img id="supplierLogo" src="<?php echo $supplierLogoPath; ?>" class='img-fluid' alt='<?php echo $supplierLogo; ?>'/>
              </span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                <li>
                  <a class="dropdown-item" href="supplierProfile.php?loginId=<?php echo $loginId; ?>">My profile</a>
                </li>
                <li>
                   <div class="input-group" id="darkModeDiv">
                      <span class="bi bi-moon-fill"></span>
                      <button id="darkModeBtn">Dark Mode.</button>
                    </div> 
                </li>
                <li>
                   <div class="input-group">
                      <span class="bi bi-brightness-high-fill"></span>
                      <button id="lightModeBtn">Light Mode.</button>
                    </div> 
                </li>
                <li>
                  <a class="dropdown-item" href="#">Settings</a>
                </li>
                <li>
                  <a class="dropdown-item" href="supplierLogout.php">Logout</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </article>
</header>