<?php 
require('connection.php');

function delete(){
	echo "confirm('are u sure?')";
}

if(isset($_REQUEST['delete_id'])){
	$id=$_REQUEST['delete_id'];

	$sql="DELETE FROM user_contacts WHERE id=$id";
	$result=mysqli_query($conn,$sql);
	if($result){
		delete();
		header("location:form.php");
	}else{
		echo "failed";
	}

}
?>