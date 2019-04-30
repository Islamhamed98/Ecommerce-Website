<?php
     
 ob_start(); // Output Buffering Start Except The Header

 session_start();
     
 if( isset($_SESSION['Username'] ))   
 {
     $pageTitle='dashboard';
     include 'incls.php';
  
     $latest = 5;
     $LatestUsers = getLatest('Username','matrix',$latest);
     
     /* Start The Dashboard Page */
     ?>
       <div class="home-stat">
          <div class="container ">
            <h1 class='text-center'> Dashboard</h1>
            <div class="col-md-3">
                <div class="stat st-members">
                    Total Member
                    <span><a href="Members.php"><?php echo CountItems('Id', 'matrix')?></a></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-pending">
                    Pending Member
                    <span> <a href="Members.php?do=Manage&page=pending"> <?php echo CheckItem( 'RegStatus','matrix',0 );?> </a></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-items">
                    Total Items
                    <span>1500</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-comments">
                    Total Comments
                    <span>1500</span>
                </div>
            </div>
          </div>     
        </div>    
      <div class="latest">
          <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-users"></i> Latest <?php   echo $latest . ' ' ;?>Regesterd Users
                        </div>
                        <div class="panel-body">
                           <ul class="list-unstyled latest-users">
                            <?php 
                                $LatestUsers= getLatest('Username','matrix',$latest);
                                foreach( $LatestUsers as $row )
                                    echo '<li>' . $row['Username'] . '<span class="btn btn-success pull-right"><i class="fa fa-edit"></i>   <a href="Members.php?do=Edit&userid=' . $row['Id']. '">Edit</a></span>';
                                    if( $row['RegStatus'] == 0 )
                                    {
                                        echo  ' <span class="btn btn-success pull-right"> <a href="Members.php?do=Activate&userid=' . $row['Id'] . '">Activate</a></span> ';
                                     }
                                    echo ' </li>';
                            ?>
                            </ul>
                            
                        </div>
                    </div>
                </div> 
                  <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-tag"></i> Latest Items
                        </div>
                        <div class="panel-body">
                            TEST
                        </div>
                    </div>
                  </div> 
            </div>
          </div>


     </div>

     
     
     
     
    <?php
    /* End The Dashboard Page */

     
     
 } else{
     header('Location:index.php');
     exit();
 }

ob_end_flush();

?>
