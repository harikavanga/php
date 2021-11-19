
<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="title">
            <h1>validationform</h1>
        </div>
        <div class="form">
            <form action="insert.php" method="POST" name="validationform" enctype="multipart/form-data" onsubmit="return validation()">
                <div class="firstname">
                    <label for="firstname">FirstName :</label>
                    <input type="text" id="firstname" name="firstname" autofocus><br>
                    <div class="error" id="ferror"></div><br>
                </div>
                <div class="lastname">
                    <label for="lastname">Lastname :</label>
                    <input type="text" id="lastname" name="lastname"><br>
                    <span class="error" id="lerror"></span><br>
                </div>
                <div class="email">
                    <label for="email">Email :</label>
                    <input type="text" id="email" name="email"><br>
                    <span class="error" id="eerror"></span><br>
                </div>
                <div class="phone">
                    <label for="phone">phone :</label>
                    <input type="text" id="phone" name="phone"><br>
                    <span class="error" id="perror"></span><br>
                </div>
                <div class="gender">
                    <label for="gender">Gender :</label>
                    <input type="radio" id="gender" name="gender" value="male">Male 
                    <input type="radio" id="gender" name="gender" value="female" checked>Female
                    <br><br>
                </div>
                <div class="lang">
                    <label for="lang">Languages Known :</label>
                    <select name="lang[]" id="lang" multiple>
                         <option value="English">English</option>
                         <option value="Hindi">Hindi</option>
                         <option value="Telugu">Telugu</option>
                     </select><br><br>
                     <span class="error" id="langerror"></span>
                </div>
                <div class="image">
                    <label for="image">Upload Image :</label>
                    <input type="file" id="image" name="image" accept="image/*"><br>
                    <span class="error" id="imgerror"></span><br>
                </div>
                <div class="submit">
                    <input type="submit" name="submit" value="submit">
                </div>
            </form>
        </div>
    </body>
</html>
<script>
    // creating a funtion to show error message
    function error(elementid, message){
        document.getElementById(elementid).innerHTML=message;
        
    }
    // creating a funtion for validation
    function validation(){
        
        // validation of firstname
        var firstname=document.validationform.firstname.value;
        var regex=/^([a-zA-Z]+)$/;
        if(regex.test(firstname)===false){
            error("ferror","please enter valid name");
            return false;
        }else{
            error("ferror","");
        }
        
        //validation of lastname
        var lastname=document.validationform.lastname.value;
        var regx=/^([a-zA-Z]+)$/;
        if(regx.test(lastname)===false){
            error("lerror","please enter valid name")
            return false;
        }else{
            error("lerror","");
        }

        // validation of email
        var email=document.validationform.email.value;
        var regexp=/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}/;
        if(regexp.test(email)===false){
            error("eerror","please enter valid email");
            return false;
        }else{
            error("eerror","");
        }

        // validation of phone number
        var phone=document.validationform.phone.value;
        var reg=/^[1-9]\d{9}$/;
        if(reg.test(phone)===false){
            error("perror","please enter valid phone number");
            return false;
        }else{
            error("perror","");
        }
        var gender=document.validationform.gender.value;

        // validation of languages
        var lang=[];
        var fav=document.getElementById("lang").options.length;
        for(var i=0;i<fav;i++){
            if(document.getElementById("lang").options[i].selected===true){
                lang.push(document.getElementById("lang").options[i].value);
            }
        }
         if(lang.length<2){
             error("langerror","please select atleast 2 languages");
             return false;
         }else{
             error("langerror","");
         }

         // validation of image file
         var img=document.validationform.image.value;
         var arr_img_path=img.split(".");
         var lastelement=arr_img_path.pop();

         //defining array with file extensions
         var arr_extensions=["jpg","jpeg","png"];
         if(!arr_extensions.includes(lastelement)){
            error("imgerror","files only with (.jpg,.jpeg,.png) extentions are allowed");
            return false;
         }else{
            error("imgerror","");
         }
          
                
    }
</script>
