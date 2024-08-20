<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Logo -->
    <div class="navbar-header">
      <div>
        <a class="navbar-brand" href="<?php echo BASE_DIR; ?>index.php">
          <strong class="h2"> UTAssistant </strong>
        </a>
      </div>

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
          <a href="<?php echo BASE_DIR; ?>index.php">
              <span class="h4">
                <span class="glyphicon glyphicon-home"></span>&nbsp;Home</span>
          </a>
        </li>
          
        <li>
          <a href="<?php echo ESPERTO_DIR; ?>esperto_crea_studio.php">
              <span class="h4"><span class="glyphicon glyphicon-file"></span>&nbsp;Crea Studio</span>
          </a>
        </li>
          
        <li>
          <a href="<?php echo ACCOUNT_DIR; ?>change-password.php">
              <span class="h4"><span class="glyphicon glyphicon-sort"></span>&nbsp;Cambia Password</span>
          </a>
        </li>
          
        <li>
          <a href="<?php echo NAVBAR_DIR; ?>info.php">
              <span class="h4"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;Info</span>
          </a>
        </li>

        <li>
          <a href="<?php echo ACCOUNT_DIR; ?>logout.php">
              <span class="h4">
                <span class="glyphicon glyphicon-off"></span>&nbsp;Logout</span>
          </a>
        </li>
      </ul>
    </div>
    </div>
</nav>
