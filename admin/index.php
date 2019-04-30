<?php
    session_start();

     $navno = '';
     $pageTitle = 'Log In';

    include 'incls.php';

    if( $_SERVER['REQUEST_METHOD'] == 'POST' )
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hashpassowrd = sha1( $_POST['password'] );

        $stmt = $con->prepare( "SELECT Id , Username , password FROM matrix
                                WHERE Username = ? AND password = ? " );

        $stmt->execute( array ( $username , $password ) );
        $row = $stmt->fetch();
        $count = $stmt->rowCount();

         if($count > 0)
         {
            $_SESSION['Username'] = $username;
            $_SESSION['Id'] = $row['Id'];

             header('Location:dash.php');
             exit();
         }

    }


?>
  <form class="login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <h2 class="text-center"> Admin Login </h2>
    <input class="form-control" type="text" name="username" placeholder="Username"/>
    <input class="form-control" type="password" name="password" placeholder="Password"/>
    <input class="btn btn-danger btn-block" type="submit" name="btn" value="Log In"/>
  </form>
