<?php 
include('header_welcome.php'); 
require('connection.php');
// session_start();

$id=$_REQUEST['update_id'];
$sql="select * from user_contacts where id=$id";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);


?>
 <div class="container">
     	<form action="" name="user_contacts" method="post" id="user_contacts" enctype="multipart/form-data">
     		<div class="form-group">
     			<label for="name">Name :</label>
     			<input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required autofocus>
                <span id="nerror" class="error"> </span>
     		</div><br>
     		<div class="form-group"> 
     			<label for="email">Email :</label>
     			<input type="text" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                <span id="eerror" class="error"> </span>
     		</div><br>
     		<div class="form-group">
     			<label for="gender">Gender :</label>
     			<input type="radio" id="male" name="gender" value="male" 
     			   <?php 
                      if($row['gender']=='male'){
                      	echo 'checked';
                      }
     			   ?>>
     			   <label for="male">Male</label>
     			<input type="radio" id="female" name="gender" value="female"
     			    <?php 
                      if($row['gender']=='female'){
                      	echo 'checked';
                      }
     			   ?>>
     			   <label for="female">Female</label>     
     		</div><br>
     		<div class="form-group">
     			<label for="languges">Languages :</label>
     			<input type="checkbox" id="lang1" name="languages[]" value="English"
                    <?php
                          if(strpos($row['languages'], 'English')){
                                 echo "checked";
                           }
                         ?>>

     			   <label for="english">English</label>
     			<input type="checkbox" id="lang2" name="languages[]" value="Hindi"
     			    <?php
                          if(strpos($row['languages'], 'Hindi')){
                                 echo "checked";
                           }
                         ?>>
     			   <label for="hindi">Hindi</label>
     			<input type="checkbox" id="lang3" name="languages[]" value="Telugu"

     			    <?php
                          if(strpos($row['languages'], 'Telugu')){
                                 echo "checked";
                           }
                         ?>>
     			   <label for="telugu">Telugu</label> 
                   <span id="lerror" class="error"> </span>     
     		</div><br>
     		<div class="form-group">
                <label>Country:</label>
                <select class="country" name="country">
                    <option>Select country</option>
                    <option value="usa">United States</option>
                    <option value="india">India</option>
                    <option value="uk">United Kingdom</option>
                </select><br><br>
                <div id="states" class="state">
                   
                </div><br> 
                <div id="cities" class="city">
                   
                </div>        
            </div><br>
            <div class="image">
                <label for="image">Upload Image :</label>
                <input type="file" id="image" name="emp_img" accept="image/*">
                <span id="ferror" class="error"> </span>
            </div><br>
            <div class="form-group">
                <input type="submit" name="submit" value="submit" id="submit">
                <button id="cancel" class="btn-link"><a href="form.php">Cancel<a></button>
            </div>
     	</form>
     </div>
   <script>
     $(document).ready(function(){
              

        //dependent dropdown
     
          $(".country").change(function(){
            var selectedcountry = $(".country option:selected").val();
            $.ajax({
            type: "POST",
            url: "country.php",
            data: { country : selectedcountry } 
             }).done(function(data){
                $("#states").html(data);
           });
         });
         $(".state").change(function(){
       
            var selectedstate = $(".state option:selected").val();
            $.ajax({
            type: "POST",
            url: "state.php",
            data: { state : selectedstate } 
             }).done(function(data){
                 $("#cities").html(data);
             });
          });   

           // validating name
            $("#name").on("blur", function() {

                 if ( $(this).val().match('^[a-zA-Z]{3,16}$') ) {
                      $("#nerror").html("");
                 } else {
                     $("#nerror").html("*Enter valid name*");
                   }
            });

            // validating email
            $("#email").on("blur",function(){

                if($(this).val().match('^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$')){
                   $("#eerror").html("");
                }else{
                    $("#eerror").html("*Enter valid email*");
                }
            });
            // validating image
             $(document).on('change','#image',function(){

                 var img=$(this).val();
                 var arr_img_path=img.split(".");
                 var lastelement=arr_img_path.pop();

                 //defining array with file extensions
                 var arr_extensions=["jpg","jpeg","png"];
                if(!arr_extensions.includes(lastelement)){
                    $("#ferror").html("*Please upload image file*");
                }else{
                    $("#ferror").html("");
                }
         
             }); 
              // validating checkbox
            $("#submit").hover(function(){

                // validating checkbox
                var lang=[];
                $(':checkbox:checked').each(function(i){
                     lang[i] = $(this).val();
                      
                });
                if(lang.includes("Telugu") || lang.includes("Hindi")){
                    $("#lerror").html("");
                }else{
                    $("#lerror").html("*Please select atleast 2 languages*");
                }
            });
     });

       

     </script>
     <?php 
      if(isset($_REQUEST['submit'])){
        $name=$_REQUEST['name'];
        $email=$_REQUEST['email'];
        $gender=$_REQUEST['gender'];


        foreach($_REQUEST['languages'] as $key => $value){
            $x=$_REQUEST['languages'];
        }
        $languages=implode(',',$x);
        $country=$_REQUEST['country'];
        $state=$_REQUEST['state'];
        $city=$_REQUEST['city'];

        if(!empty($_FILES['emp_img']) && $_FILES['emp_img']['error']==0){

                  $file_name=time().'_'.$_FILES['emp_img']['name'];
                  $tmp_name=$_FILES['emp_img']['tmp_name'];
                  $target_file='images/'.$file_name;
                  move_uploaded_file($tmp_name,$target_file);
        }
        $sql="UPDATE user_contacts
              SET name='$name',email='$email',gender='$gender',languages='$languages',country='$country',state='$state',city='$city',image='$target_file' where id=$id";

              $result=mysqli_query($conn,$sql);
              if($result){
                echo "<script>
                  window.location.href='form.php';
                </script>";
              }else{
                echo "failed";
              }
      }
    include('footer.php');
     ?>