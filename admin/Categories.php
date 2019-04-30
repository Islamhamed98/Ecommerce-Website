<?php 

/*
    ===========================================
    == Category Page
    ===========================================
*/

  ob_start();
  session_start();
  $pageTitle = "Categories";


 if( isset( $_SESSION['Username'] ) )
 {
     include 'incls.php';

     $do = isset( $_GET['do'] ) ? $_GET['do'] : 'Manage';
     if($do == 'Manage')
     {
         echo 'Manage';
     }
     elseif($do == 'Add')
     { ?>

         <div class="container">
               <h1 class="text-center"> Add New Category </h1>
            <form class="form-horizontal" action="?do=Insert" method="POST">

                 <div class="form-group">
                   <label class="control-label col-sm-2 control-label">Cat Name</label>
                    <div class="col-sm-10 col-md-6">
                        <input class="form-control" type="text" name="catname" placeholder="Name Of The Category" autocomplete="off" />
                    </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2 control-label">Description</label>
                    <div class="col-sm-10 col-md-6">
                        <input class="form-control" type="text" name="catdesc"  placeholder="Description Of Category" autocomplete="off"/>
                    </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2 control-label">Ordering</label>
                    <div class="col-sm-10 col-md-6">
                        <input class="form-control" type="text" name="ordering"  placeholder="Number To Arrange The Categories" autocomplete="off"/>
                    </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-sm-2 control-label">Visible</label>
                    <div class="col-sm-10 col-md-6">
                        <div>
                            <input id="vis-yes" type="radio" name="visibility" value="0" checked/>
                            <label for="vis-yes">Yes</label>
                        </div>
                        <div>
                            <input id="vis-no" type="radio" name="visibility" value="1"/>
                            <label for="vis-no">No</label>
                        </div>
                    </div>
                </div>
                   <div class="form-group">
                   <label class="control-label col-sm-2 control-label">Allow Comment</label>
                        <div class="col-sm-10 col-md-6">
                            <div>
                                <input id="com-yes" type="radio" name="allcomment" value="0" checked/>
                                <label for="com-yes">Yes</label>
                            </div>
                            <div>
                                <input id="com-no" type="radio" name="allcomment" value="1"/>
                                <label for="com-no">No</label>
                            </div>
                        </div>
                    </div>
                  <div class="form-group">
                   <label class="control-label col-sm-2 control-label">Allow Advertises</label>
                        <div class="col-sm-10 col-md-6">
                            <div>
                                <input id="ads-yes" type="radio" name="allads" value="0" checked/>
                                <label for="ads-yes">Yes</label>
                            </div>
                            <div>
                                <input id="ads-no" type="radio" name="allads" value="1"/>
                                <label for="ads-no">No</label>
                            </div>
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
     elseif($do == 'Insert')
     {

       if($_SERVER['REQUEST_METHOD'] == 'POST')
       {
           echo ' <h1> Update Member </h1> ';
           echo '<div class="continer">';
           // Get The New Data From The Form

           $name = $_POST['catname'];
           $desc = $_POST['catdesc'];
           $order= $_POST['ordering'];
           $visible= $_POST['visibility'];
           $comment = $_POST['allcomment'];
           $ads = $_POST['allads'];

           if( !empty($name) )
           {
               $stmt = $con->prepare("INSERT INTO category ( CatName , Catdesc  , Ordering , visibility , Allow_Comment , Allow_ads ) VALUES ( '$name' , '$desc' , '$order' , '$visible' , '$comment' , '$ads')");
               $stmt->execute( array( $name , $desc , $order , $visible, $comment , $ads ) );

           }
            $error =  '<div class="alert alert-success"' . $stmt->rowCount()  . '<strong> The Record Inserted </strong></div>';
            RedirectHome($error);

           }
        else{
           echo '<div class="container">';
            $error =  '<div class="alert alert-danger <strong>You Can\'t Brwose The page Directly</strong></div>';
            RedirectHome($error);
           echo '</div>';

       }

       echo '</div>';

     }
     elseif($do == 'Edit')
     {
         echo 'Edit';
     }
     elseif($do == 'Update')
     {
         echo 'Update';
     }
     elseif($do == 'Delete')
     {
         echo 'DElete';
     }



 }



?>
