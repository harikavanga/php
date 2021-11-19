<?php 
include('header_welcome.php');

 ?>
 
     <div class="container">
      
     	<form action="" name="user_contacts" method="post" id="user_contacts" enctype="multipart/form-data">
            <input type="hidden" name="username" value="<?php echo $_SESSION['user_name']; ?>">
     		<div class="form-group">
     			<label for="name">Name :</label>
     			<input type="text" id="name" name="name" required>
                <span id="nerror" class="error"> </span>
     		</div><br>
     		<div class="form-group"> 
     			<label for="email">Email :</label>
     			<input type="text" id="email" name="email" required>
                <span id="eerror" class="error"> </span>
     		</div><br>
     		<div class="form-group">
     			<label for="gender">Gender :</label>
     			<input type="radio" id="male" name="gender" value="male"> 
     			   <label for="male">Male</label>
     			<input type="radio" id="female" name="gender" value="female" checked>
     			   <label for="female">Female</label>     
     		</div><br>
     		<div class="form-group">
     			<label for="languges">Languages :</label>
     			<input type="checkbox" id="lang1" name="languages[]" value="English" checked>
     			   <label for="english">English</label>
     			<input type="checkbox" id="lang2" name="languages[]" value="Hindi">
     			   <label for="hindi">Hindi</label>
     			<input type="checkbox" id="lang3" name="languages[]" value="Telugu">
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
                <button id="cancel">Cancel</button>
            </div>
     	</form>
     </div>

     <div class="user_contacts"><br>

        <h4 class="title"><u>User Contacts</u></h4><br>
        <button class="btn-primary">Add</button>
        <input type="search" name="search_records" id="search" placeholder="search here">
        <button class="btn-basic" id="srch">search</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span style="float: right;"><input type="date" id="created_at" class="date_search">
        <input type="date" id="modified_at" class="date_search">
        <button class="btn-basic" id="search_date">search</button></span>
        <script> 
            function confirm_delete(){
                confirm("Are you sure you want to delete the contact?");
            }
        </script>
        <br><br>
          <div class="table_contacts"> </div>   
     </div> 

 <!--   </body> -->
<script>
   $(document).ready(function(){
    $(".container").hide();

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


       
      
        // validations using jquery

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

                var lang=[];
                $(':checkbox:checked').each(function(i){
                     lang[i] = $(this).val();
                      
                });
                if(lang.includes("Telugu") || lang.includes("Hindi")){
                    $("#lerror").html("");
                }else{
                    $("#lerror").html("*Please select atleast 2 languages*");
                }

                // validating dependent dropdown  

                var country=$("#country").val();
                var state=$("#state").val();
                var city=$("#city").val();
                if(country==""){
                    $("#cerror").html("*Please select country*");
                } 
                if(state==""){
                    $("#serror").html("*Please select state*");
                } 
                if(city==""){
                    $("#cityerror").html("*Please select city*");
                }        
                
            });
            
            // adding and listing using hide and show methods
            $(".container").hide();
            $(document).on('click','.btn-primary',function(){
                $(".user_contacts").hide();
                $(".container").show();
            });

            //displaying listing after clicking cancel 
            $(document).on('click','#cancel',function(){
                $(".container").hide();
                $(".user_contacts").show();
            });
            

            // onsubmit functionality
            $(document).on('click','#submit',function(){
                $.ajax({
                    url:'insert.php',
                    method:'POST',
                    data:$("#user_contacts").serialize(),
                    success:function(data){
                        alert("check your details");
                    }
                });
            });


            load_data();

            function load_data(page){
                 $.ajax({

                    url:'limit_records.php',
                    method:'POST',
                    data:{page:page},
                    success:function(data){
                        $(".table_contacts").html(data);
                    }
                 });
            }

            // pagination
    
            $(document).on('click','.btn-info',function(){
                 
                 var page=$(this).attr("id");
                
                 load_data(page);
            
            });

            // pagination for searched records
            $(document).on('click','.btn-success',function(){
                 
                 var page=$(this).attr("id");
                 var text=$("#search").val();

                 $.ajax({

                    url:'limit_records.php',
                    method:'POST',
                    data:{page:page,text:text},
                    success:function(data){
                        $(".table_contacts").html(data);
                    }
                 });
            
            });
            // searching
            $(document).on('click','#srch',function(){
                   
                   var text=$("#search").val();
                  
                   $.ajax({
                      
                      url:'limit_records.php',
                      method:'POST',
                      data:{text:text},
                      success:function(data){
                        $(".table_contacts").html(data);
                      }
                   });
                  
            });

            // sorting
            $(document).on('click','.column_sort',function(){

                    var column=$(this).attr('id');
                    var order=$(this).data("order");

                        $.ajax({
                           url:"limit_records.php",
                           method:"POST",
                           data:{column:column,order:order},
                            success:function(data){

                                $('#table_contacts').html(data);
                                
                            }
                        });
             });
            // $(document).on('click','#search_date',function(){

            //     var created_at=("#created_at").val();
            //     var modified_at=("#modified_at").val();
            //     date_search(created_at,modified_at);

            // });
            // function date_search(date_created,date_modified){
                 
            //      $.ajax({
            //         url:'limit_records.php',
            //         method:'POST',
            //         data:{date_created:date_created,date_modified:date_modified},
            //         success:function(data){
            //             $(".table_contacts").html(data);
            //           }
            //      });
            // }

            // logout functionality
            
            
           
    });
        
 
</script>
<?php include('footer.php'); ?>