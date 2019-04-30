<?php ?>


<nav class="navbar navbar-inverse">

  <div class="container-fluid container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dash.php">Home</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="Categories.php?do=Manage&userid=<?php echo $_SESSION['Id'];?>">Categories <span class="sr-only">(current)</span></a></li>
        <li><a href="Members.php?do=Manage&userid=<?php echo $_SESSION['Id'];?>">Members</a></li>
        <li><a href="#">Items</a></li>
        <li><a href="#">Statstics</a></li>
        <li><a href="#">Documentation</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Setting <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="Members.php?do=Edit&userid=<?php echo $_SESSION['Id']?>">Edit Profile</a></li>
            <li><a href="#">Security</a></li>
            <li><a href="index.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
