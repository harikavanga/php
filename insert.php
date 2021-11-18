<?php 
include('header.php');
require('connection.php');
session_start();

$username=$_SESSION['username'];
$name=$_REQUEST['name'];
$email=$_REQUEST['email'];
$gender=$_REQUEST['gender'];

foreach($_REQUEST['languages'] as $key => $value){    
         $x = $_POST["languages"];     
} 
    $languages = implode(",",$x);

$country=$_REQUEST['country'];
$state=$_REQUEST['state'];
$city=$_REQUEST['city'];


if(!empty($_FILES['emp_img']) && $_FILES['emp_img']['error']==0){

    $file_name=time().'_'.$_FILES['emp_img']['name'];
    $tmp_name=$_FILES['emp_img']['tmp_name'];
    $target_file='images/'.$file_name;
    move_uploaded_file($tmp_name,$target_file);
    }

$sql="SELECT * FROM users where username='$username'";
 $result=mysqli_query($conn,$sql);
   while($row = mysqli_fetch_assoc($result)){
    $id=$row['id'];
}

$sql="INSERT INTO user_contacts(user_id,name,email,gender,languages,country,state,city,image)
            VALUES ('$id','$name','$email','$gender','$languages','$country','$state','$city','$target_file')";
            
            $result=mysqli_query($conn,$sql);
            if($result){
               header('location:form.php');
            }else{
                echo "failed";
            }
      
?>