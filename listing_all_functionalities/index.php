<?php
require('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/840f47181e.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
  <body>
    <script>
       
        function confirmdelete(){
            return confirm('Are you sure you want to delete Employee?');
        }
    </script> 
       <h1 class="title">ValidationForm</h1> 
          <div class="add">
             <button class="btn btn-primary"><a href="form.php">Add Record</a></button>
             <button class="btn btn-primary" id="export"><a href="">Export</a></button>
             <button class="btn btn-primary"><a href="export.php">Export</a></button>
          </div><br>
          <div class="create">
              <label for="create">Created at :</label><br>
              <input type="date" id="create" name="create">
          </div><br>
          <div class="'modify">
              <label for="modify">Modified at :</label><br>
              <input type="date" id="modify" name="modify">
              <input type="submit" name="date_search" id="date_search" value="search">
          </div>
          <div class="search">
             <form action="filterrecords.php" method="post">
                <input type="text" id="search" name="search" placeholder="search here" autofocus><br><br>
             </form>
          </div>

    <script>

        $(document).ready(function(){ 

          //to call function before click
          load_data();

          function load_data(page){
         
            // console.log(page);    
          
            $.ajax({  
               url:"paginaton.php",  
               method:"GET",  
               data:{page:page},
               success:function(data){  
                    $('#pagination_data').html(data);  
               }  
            });    
          }
          function filter_data(txt){

             $.ajax({  
               url:"filterrecords.php",  
               method:"GET",  
               data:{search:txt},
               success:function(data){  
                    $('#pagination_data').html(data);  
               }  
            });
          }
          function date_search(date_created,date_modified){

               // alert("hello");
               $.ajax({  
               url:"date_search.php",  
               method:"GET",  
               data:{date_created:date_created,date_modified:date_modified},
               success:function(data){  
                    $('#pagination_data').html(data);  
               }  
            });

          }
          
               $(document).on('click','.pagination_link', function(){  
         
                     var page = $(this).attr("id");
                     load_data(page);
               });
               $("#search").keyup(function(){

                     var txt=$(this).val();
                     filter_data(txt);
                     
                     
               });
               $(document).on('click','#date_search',function(){

                     var date_created=$("#create").val();
                     var date_modified=$("#modify").val();
                     // var date_search=$(this).val();
                     date_search(date_created,date_modified);

               });
               $(document).on('click', '.column_sort', function(){  

                     var column_name = $(this).attr("id");  
                     var order = $(this).data("order");  
                
                            $.ajax({  
                                url:"sorting.php",  
                                method:"POST",  
                                data:{column_name:column_name, order:order},  
                                success:function(data){
                                    $('#employee_table').html(data);  
                                   
                                } 
                            });

                });
               $(document).on('click','#export',function(){

                $.ajax({

                    url:'export.php',
                    method:'GET',
                    success:function(respone){
                        alert(respone);
                    }

                });
               });
                                 
                              
        }); 
                       
                       
    </script>

       <div id="pagination_data"></div>

  </body>
</html>
