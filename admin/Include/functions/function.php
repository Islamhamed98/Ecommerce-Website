<?php
/*
**  This is A Function To Get The Title Of Page That Focused On.
**  No Pararmeters For The Function.
**  Check By A Variable Found On Page Or Not.
*/


    function getTitle(){
        global $pageTitle;
        if( isset($pageTitle) ) echo $pageTitle;
        else echo 'default';
        
    }

/*=========================================================================================================*/


/*
** Home Redirect Function [ This Function Accept Two Parameters ]. 
** $theMsg => echo The Msg [ Success | Error | Warning ].
** $seconds => You Will Be Directed After ($seconds) seconds.  
*/

function RedirectHome( $TheMsg , $url = null,$seconds = 3 ){
    
    if($url === '')  $url = 'index.php';     
    else $url = isset( $_SERVER['HTTP_REFERER']) &&  $_SERVER['HTTP_REFERER']  !== '' ?  $_SERVER['HTTP_REFERER'] : 'index.php';    
     
    echo $TheMsg;
    echo  '<div class="alert alert-info"> You Will Be Directed For Home Page After ' . $seconds . ' Seconds </div>';
     
    header("refresh:$seconds;url=$url");
    exit();
}


/*=========================================================================================================*/


/*
** CheckItem Function
** $select = The Item To Select [ example: user | item | category ]
** $table = The table.
** $value = The Value Of Select. 
**  
*/
 
function CheckItem( $select , $table , $value ){
    
    global $con;
    
    $stmt = $con->prepare("SELECT $select FROM $table WHERE $select = ? ");
    
    $stmt->execute( array( $value ));
    
    $count = $stmt->rowCount();
    
    return $count;
    
}
  

/*=========================================================================================================*/

/*
** 
** Count Number Of Itmes Function
** $item  = The Item To Count
** $table = The Table To Choose From 
**  
*/

function CountItems( $items , $table )
{
    global $con;
    
    $stmt = $con->prepare("SELECT COUNT($items) FROM $table ");
    $stmt->execute();
    return $stmt->fetchColumn();
    
}

/*=========================================================================================================*/

/*
** 
** The getLatest Member Function v.01
** $select = The Item To Select [ example: user | item | category ].
** $table = The table.
**  
*/

function getLatest($select , $table , $limit = 5)
{
    global $con;
    $stmt = $con->prepare("SELECT $select , Id , RegStatus FROM $table LIMIT $limit");
    $stmt->execute();
    
    $rows = $stmt->fetchAll();
    
    return $rows;
    
}






 