<?php

/*
    *******************************************************
    **  Manage Members Page
    **  You Can Add || Edit || Delete Members From Here
    *******************************************************
*/
 session_start();
 if( $_SESSION['Username'] )
 {
     $pageTitle = 'Members';
     include 'incls.php';

   $do = isset( $_GET['do'] ) ? $_GET['do'] : 'Manage';
   $userid = isset( $_GET['userid'] ) ? $_GET['userid'] : 0;
   if( $do == 'Manage')
   {  // Manage Page

       $Query = '';
       if ( isset($_GET['page']) && $_GET['page'] == 'pending' )
       {
           $Query = "AND RegStatus = 0";
       }

        $stmt = $con->prepare("SELECT * FROM matrix WHERE GroupId != 1 $Query ");
       $stmt->execute();
       $rows = $stmt->fetchAll();

    ?>
       <h1 class="text-center"> Manage Page </h1>
       <div class="container">
           <div class= "table-responsive">
                <table class="main-table text-center table table-bordered">
                   <tr class="main-tr">
                        <td>#Id</td>
                        <td>Username</td>
                        <td>Full Name</td>
                        <td>Email</td>
                        <td>Regesterd Date</td>
                        <td>Edit / Delete User</td>
                    </tr>
             <?php
                foreach( $rows as $row )
                {
                    echo '<tr class="branch-tr">';
                        echo "<td>" .  $row['Id'] . "</td>";
                        echo "<td>" .  $row['Username'] . "</td>";
                        echo "<td>" .  $row['fullname'] . "</td>";
                        echo "<td>" .  $row['email']    . "</td>";
                        echo "<td>" .  $row['Date']     . "</td>";
                        echo "<td>" . "<a style='margin:3px auto;' href='Members.php?do=Edit&userid=" . $row['Id'] . "' class='btn btn-success btn'><i class='fa fa-edit'></i>  Edit</a>
                                       <a  style='margin:3px auto;' href='Members.php?do=Delete&userid=" . $row['Id'] . "' class='btn btn-danger'><i class='fa fa-close'></i> Delete</a>" ;
                    if($row['RegStatus'] == 0)
                    {
                      echo "   <a  style='margin:3px auto;' href='Members.php?do=Activate&userid=" . $row['Id'] . "' class='btn btn-info'><i class='fa fa-close'></i> Activate</a>" ;

                    }
                    echo '</td>';
                    echo '</tr>';
                }
           ?>
                </table>
             </div>
             <div class="">
                  <a href="Members.php?do=Add"><input class="btn btn-primary btn-block" type="submit" name="btn" value="Add New Member" /></a>
             </div>

       </div>


   <?php }
   else if($do == 'Edit')
   {

       $userid =  isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
       $stmt = $con->prepare("SELECT * FROM matrix WHERE Id = ? Limit 1 ");
       $stmt->execute( array( $userid ) );
       $row = $stmt->fetch();
       $count = $stmt->rowCount();

       if($count > 0)
       { ?>
         <h1 class="text-center"> Edit Member </h1>
         <div class="container">
            <form class="form-horizontal" action="?do=Update" method="POST">

                <input type="hidden" name="id" value="<?php echo $userid ;?>"/>
                <div class="form-group">
                   <label class="control-label col-sm-2 control-label">Username</label>
                    <div class="col-sm-10 col-md-6">
                        <input class="form-control" type="text" name="username" value=" <?php echo $row['Username']?> " autocomplete="off" />
                    </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2 control-label">Password</label>
                    <div class="col-sm-10 col-md-6">
                        <input class="form-control" type="password" name="password" value="<?php echo $row['password'] ?>" autocomplete="off"/>
                    </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2 control-label">Email</label>
                    <div class="col-sm-10 col-md-6">
                        <input class="form-control" type="email" name="Email" value="<?php echo $row['email']?>" autocomplete="off"/>
                    </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-sm-2 control-label">Full Name</label>
                    <div class="col-sm-10 col-md-6">
                        <input class="form-control"  type="text" name="fullname" value="<?php echo $row['fullname']?>" autocomplete="off"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input class="btn btn-danger" type="submit" value="Save" />
                    </div>
                </div>
             </form>
           </div>

       <?php
        }
       else {
          echo  '<div class="continer">';
               $msg = '<div class="alert alert-danger"> Sorry you can\'t browse the page directly </div>' ;
               RedirectHome( $msg , 5);
          echo  '</div>';
       }



   }
   else if( $do == 'Update' )
   {

       if($_SERVER['REQUEST_METHOD'] == 'POST')
       {
            echo ' <h1> Update Member </h1> ';
            echo '<div class="continer">';

            // Get The New Data From The Form

           $user = $_POST['username'];
           $pass = $_POST['password'];
           $email= $_POST['Email'];
           $Fname= $_POST['fullname'];
           $id   = $_POST['id'];

           $formErrors = array();
           if(empty($user)  || strlen($user) < 4 ) $formErrors[] = 'ERROR !! :(< Check <strong>User</strong> Feild ';
           if(empty($pass)  || strlen($pass) < 4 ) $formErrors[] = 'ERROR !! :(< Check <strong>Passowrd</strong> Feild ';
           if(empty($email) || strlen($user) < 4 ) $formErrors[] = 'ERROR !! :(< Check <strong>Email</strong> Feild ';
           if(empty($Fname) || strlen($user) < 4 ) $formErrors[] = 'ERROR !! :(< Check <strong>Full Name</strong> Feild ';

           foreach( $formErrors as $error )
           {
               echo '<div class="alert alert-danger"' . $error . '</div>';
            }
           if(empty($formErrors))
           {
                $stmt = $con->prepare("UPDATE matrix SET Username = ? , email = ? , password = ? , fullname = ? WHERE Id = ?");
                $stmt->execute( array( $user , $email , $pass , $Fname , $id) );

           }
             $msg =  '<div class="alert alert-success">' . $stmt->rowCount() . '  <strong>Updated Record </strong></div>'  ;
             RedirectHome( $msg , 5);
       } else{
             $msg =  '<div class="alert alert-danger"> Sorry :(< You Can\'t Browse The page directly </div>';
             RedirectHome( $msg , 5);
        }

       echo '</div>';


   }
   else if( $do == 'Add' )
   { ?>
         <h1 class="text-center"> Add Member </h1>
         <div class="container">
            <form class="form-horizontal" action="?do=Insert" method="POST">

                 <div class="form-group">
                   <label class="control-label col-sm-2 control-label">Username</label>
                    <div class="col-sm-10 col-md-6">
                        <input class="form-control" type="text" name="username" placeholder="Username" autocomplete="off" />
                    </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2 control-label">Password</label>
                    <div class="col-sm-10 col-md-6">
                        <input class="form-control" type="password" name="password"  placeholder="Password" autocomplete="off"/>
                    </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2 control-label">Email</label>
                    <div class="col-sm-10 col-md-6">
                        <input class="form-control" type="email" name="Email"  placeholder="Email" autocomplete="off"/>
                    </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-sm-2 control-label">Full Name</label>
                    <div class="col-sm-10 col-md-6">
                        <input class="form-control"  type="text" name="fullname" placeholder="Full Name" autocomplete="off"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input class="btn btn-primary" type="submit" value="Save" />
                    </div>
                </div>
             </form>
           </div>

   <?php }
   else if( $do == 'Insert' )
   {

       if($_SERVER['REQUEST_METHOD'] == 'POST')
       {
           echo ' <h1> Update Member </h1> ';
           echo '<div class="continer">';
           // Get The New Data From The Form

           $user = $_POST['username'];
           $pass = $_POST['password'];
           $email= $_POST['Email'];
           $Fname= $_POST['fullname'];


           $formErrors = array();
           if(empty($user)  || strlen($user) < 4 ) $formErrors[] = 'ERROR !! :(< Check <strong>User</strong> Feild ';
           if(empty($pass)  || strlen($pass) < 4 ) $formErrors[] = 'ERROR !! :(< Check <strong>Passowrd</strong> Feild ';
           if(empty($email) || strlen($user) < 4 ) $formErrors[] = 'ERROR !! :(< Check <strong>Email</strong> Feild ';
           if(empty($Fname) || strlen($user) < 4 ) $formErrors[] = 'ERROR !! :(< Check <strong>Full Name</strong> Feild ';

           foreach( $formErrors as $error )
           {
               echo '<div class="alert alert-danger"' . $error . '</div>';
           }
           if(empty($formErrors))
           {
               $stmt = $con->prepare("INSERT INTO matrix ( Username , password  ,  email , fullname, RegStatus , Date ) VALUES ( '$user' , '$pass' , '$email' , '$Fname' , 1 , now())");
               $stmt->execute( array( $user , $pass , $email , $Fname ) );
             }
            $error =  '<div class="alert alert-success"' . $stmt->rowCount()  . '<strong> The Mamber Added</strong></div>';
            RedirectHome($error);
       }else{
           echo '<div class="container">';
            $error =  '<div class="alert alert-danger <strong>You Can\'t Brwose The page Directly</strong></div>';
            RedirectHome($error);
           echo '</div>';
        }


       echo '</div>';


   }
   else if( $do == 'Delete' )
   {
       $Id = $_GET['userid'];

            $stmt = $con->prepare("DELETE FROM matrix WHERE Id = ?");
            $stmt->execute( array( $Id ) );
            $msg = '<div class="alert alert-danger">' . $stmt->rowCount()  . ' Deleted From Database </div> ';
            RedirectHome($msg);

   }
    elseif($do == 'Activate')
    {
        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
        $stmt = $con->prepare("UPDATE matrix SET RegStatus = 1 WHERE Id = ? ");
        $stmt->execute(array($userid));
        $msg = '<div class="alert alert-success">' . $stmt->rowCount() .'  <strong> Activated Member </strong> </div>';
        RedirectHome($msg);


    }


 }









?>
