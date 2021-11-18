<?php 
include('header.php');
require('connection.php');
// session_start();

if(isset($_REQUEST['username'])){
    $username=$_REQUEST['username'];
	$password=$_REQUEST['password'];

    // $_SESSION['username']=$username;

	$sql="SELECT * FROM users WHERE password='$password' AND Username='$username'";
	$result=mysqli_query($conn,$sql);
	$num_rows = mysqli_num_rows($result);
    
    	if($num_rows==1){

		      $_SESSION['username']=$username;

		      header('location:form.php'); 
		}
		else{
			$error="Enter valid username or password";
		}
}
?>

    <div class="container" align="center">
    	<div class="login">
    		<h4><u>Login</u></h4><br>
    	</div>
    	<form action=""  name="authentication" method="post" class="users">
    		<span style="color: red;"><?php if(isset($error)) echo $error; ?></span>
    		<div class="form-group">
    			<label for="userName">Username :</label>
    			<input type="text" name="username" id="username" required>
    		</div><br>
    		<div class="password">
    			<label for="password">Password :</label>
    			<input type="password" name="password" id="password" required>
    		</div><br>
    		<div>
    			<input type="submit" name="submit" value="login" id="login" class="btn-primary">
    		</div>
    	</form>
    </div>
    
<?php include('footer.php'); ?>
