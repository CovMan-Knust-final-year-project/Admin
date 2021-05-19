<div class="sidebar" data-color="rose" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
      -->
      <div class="logo"><a href="#" class="simple-text logo-normal">
          <img src="assets/img/logo.png" width="30%"/> CovMan Admin
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active  ">
            <a class="nav-link" href="./dashboard.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./students.php">
              <i class="material-icons">person_outline</i>
              <p>Students</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./scans.php">
              <i class="material-icons">content_paste</i>
              <p>Scans</p>
            </a>
          </li>
          <!-- <li class="nav-item ">
            <a class="nav-link" href="./notifications.html">
              <i class="material-icons">notifications_none</i>
              <p>Notifications</p>
            </a>
          </li> -->
           <li class="nav-item" onclick="Logout()">
            <a class="nav-link">
            <i class="text-danger material-icons">logout</i>
                <p class="text-danger">Logout</p>
            </a>
          </li>
        </ul>
      </div>
    </div>