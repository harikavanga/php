<?php
include('connection.php');
$id=$_REQUEST['delid'];
if(isset($_REQUEST['delid'])){
    $sql="DELETE FROM validationform where id=$id";
    $result=mysqli_query($conn,$sql);
    if($result){
       
        // echo "deleted";
        header('location:index.php');
    }else{
        echo "not deleted";
    }
}
?>