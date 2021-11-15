
<?php
session_start();
require('connection.php');

if(isset($_REQUEST['username'])){
    $username=$_REQUEST['username'];
	$password=$_REQUEST['password'];


	$sql="SELECT * FROM users WHERE password='$password' AND Username='$username'";
	$result=mysqli_query($conn,$sql);
	while($row = mysqli_fetch_assoc($result)){

		$output=$row["ID"];
	}
	$rows = mysqli_num_rows($result);

    	if($rows==1){
		      echo $output;
		}
		else{
			echo 10;
		}
}

?>
