<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Logo -->
    <div class="navbar-header">
      <div>
        <a class="navbar-brand">
          <strong class="h2"> UTAssistant </strong>
        </a>
      </div>
        
        <a href="<?php echo ACCOUNT_DIR; ?>change_password.php"> </a>

        <div>
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavBar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
    </div>

    <!--Voci del menu -->
    <div class="collapse navbar-collapse" id="mainNavBar">
      <ul class="nav navbar-nav navbar-right">
          
           <li>
          <a href="<?php echo ACCOUNT_DIR; ?>change-password.php">
              <span class="h4">
                <span class="glyphicon glyphicon-sort"></span>Cambia Password</span>
          </a>
        </li>
          
        <li>
          <a href="<?php echo ACCOUNT_DIR; ?>logout.php">
              <span class="h4">
                <span class="glyphicon glyphicon-off"></span>Logout</span>
          </a>
        </li>
      </ul>
    </div>
    </div>
</nav>
