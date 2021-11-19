      
      <?php
       
      require('connection.php');
      $output ='';
       $per_page_record=5;
        
        if(isset($_REQUEST['page'])){
            $page=$_REQUEST['page'];
        }else{
            $page=1;
        }

        $start_from=($page-1)*$per_page_record;
        $sql="SELECT * FROM validationform LIMIT $start_from,$per_page_record";
        $result=mysqli_query($conn,$sql);
         $output .= '  
            <div class="table-responsive" id="employee_table">  
                     <table class="table table-bordered" width="100%">  
                          <tr>  
                               <th><a class="column_sort" id="Id" data-order="desc" href="#">S.No.</a></th>  
                               <th><a class="column_sort" id="FirstName" data-order="desc" href="#">FirstName</a></th> 
                               <th><a class="column_sort" id="LastName" data-order="desc" href="#">LastName</a></th>
                               <th><a class="column_sort" id="Email" data-order="desc" href="#">Email</a></th>
                               <th><a class="column_sort" id="Phone" data-order="desc" href="#">Phone</a></th> 
                               <th><a class="column_sort" id="Gender" data-order="desc" href="#">Gender</a></th>  
                               <th><a class="column_sort" id="LanguagesKnown" data-order="desc" href="#">LanguagesKnown</a></th>
                               <th><a class="column_sort" id="Image" data-order="desc" href="#">Image</a></th>
                               <th><a class="column_sort" id="Created_at" data-order="desc" href="#">Created_at</a></th>
                               <th><a class="column_sort" id="Modified_at" data-order="desc" href="#">Modified_at</a></th> 
                               <th><a class="column_sort" id="Actions" data-order="desc" href="#">Actions</a></th>   
                          </tr>   
        '; 
        $count=($start_from+1);
        while($row = mysqli_fetch_assoc($result))  
        { 

            $output .= ' 
                <tbody id="myTable">
                    <tr>  
                        <td>'.$count.'</td>
                        <td>'.$row["FirstName"].'</td>
                        <td>'.$row["LastName"].'</td>
                        <td>'.$row["Email"].'</td>
                        <td>'.$row["Phone"].'</td>
                        <td>'.$row["Gender"].'</td>
                        <td>'.$row["LanguagesKnown"].'</td>
                        <td><img src="'.$row["Image"].'" height="20px" width="20px"></td>
                        <td>'.$row["Created_at"].'</td>
                        <td>'.$row["Modified_at"].'</td>
                        <td>
                           <div>
                                <button><a href="edit.php?editid='.$row['Id'].'"><i class="fas fa-pencil-alt"></i></a></button>
                                <button onclick="return confirmdelete()"><a href="delete.php?delid='.$row['Id'].'"><i class="far fa-trash-alt"></i></a></button>
                           </div>
                        </td>
                    </tr>
                </tbody>  
            '; 
            $count++; 
        } 

         $output .= '</table><br /><div class="botom" align="right">'; 
          $sql="Select * from validationform";
          $result = $conn->query($sql);
          $result_num_rows=mysqli_num_rows($result);
          $per_page_record=5;
          $result_num_pages=ceil($result_num_rows/$per_page_record);
          if($page>1){

            $previous=$page-1;
            $output.="<button><span class='pagination_link'  id='".$previous."'><i class='fas fa-angle-double-left'></i></span></button>"." ";
          }

            for($i=1; $i<=$result_num_pages; $i++)  
            {

               $output .= "<button><span class='pagination_link'  id='".$i."'>".$i."</span></button>"." ";  
               
            }  
           if($page>=1 && $page<$result_num_pages){
              
              $next=$page+1;
              $output.="<button><span class='pagination_link'  id='".$next."'><i class='fas fa-angle-double-right'></i></span></button>";

           } 
            $output .= '</div>'; 

        echo $output;
       
         
    ?>
