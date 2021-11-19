<?php
require('connection.php');
$first_name=$_REQUEST['firstname'];
$last_name=$_REQUEST['lastname'];
$email=$_REQUEST['email'];
$phone=$_REQUEST['phone'];
$gender=$_REQUEST['gender'];

    // check for array of each language selected
    foreach($_POST['lang'] as $key => $value) {    
         $x = $_POST["lang"];     
    } 
    $languages = implode(",",$x);
    // print_r($_FILES['image']);

if(isset($_REQUEST['submit'])){
    if(!empty($_FILES['image']) && $_FILES['image']['error']==0){

         $file_name=time().'_'.$_FILES['image']['name'];
         $tmp_name=$_FILES['image']['tmp_name'];
         $target_file='images/'.$file_name;
         $move_file=move_uploaded_file($tmp_name,$target_file);
        //  if($move_file){
        //      echo "uploaded";
        //  }else{
        //      echo "failed";
        //  }
        
        // inserting values into database
        $sql="INSERT INTO validationform(FirstName,LastName,Email,Phone,Gender,LanguagesKnown,Image) 
              values('$first_name','$last_name','$email','$phone','$gender','$languages','$target_file')";
                  if($conn->query($sql)===true){

                         header('location:index.php');
                  }else{
                         echo "failed";
                   }
        
       
    } 
}
   



?>