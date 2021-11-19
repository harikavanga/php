

<?php
require('connection.php');
$output='';
$count=1;


         
	     $str_search=$_REQUEST['search'];
         if(!empty($_REQUEST['search'])){
	     $sql="SELECT * FROM validationform WHERE FirstName LIKE '%$str_search%' OR LastName LIKE '%$str_search%' OR Email LIKE '%$str_search%' OR Phone LIKE '%$str_search%' OR Gender LIKE  '%$str_search%'";

	     $result=$conn->query($sql);
             $output .= "  
            <table class='table table-bordered' style='width:100%;'>  
                <tr>  
                    <th>S.No.</th>
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Languagesknown</th>
                    <th>Image</th>
                    <th>Created_at</th>
                    <th>Modified_at</th>
                    <th>Action</th>
                </tr>  
        ";
	     
		 while($row=mysqli_fetch_assoc($result)){
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
        $output .= '</table>';
        echo $output;
    }
    
    else{
        $page=1;
        $per_page_record=5;
        $start_from=($page-1)*$per_page_record;
        $sql="SELECT * FROM validationform LIMIT $start_from,$per_page_record";
        $result=mysqli_query($conn,$sql);
         $output .= "  
            <table class='table table-bordered' style='width:100%;'>  
                <tr>  
                    <th>S.No.</th>
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Languagesknown</th>
                    <th>Image</th>
                    <th>Created_at</th>
                    <th>Modified_at</th>
                    <th>Action</th>
                </tr>  
        ";
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
        $output .= '</table><br /><div class="botom" align="center">'; 
          $sql="Select * from validationform";
          $result = $conn->query($sql);
          $result_num_rows=mysqli_num_rows($result);
          $per_page_record=5;
          $result_num_pages=ceil($result_num_rows/$per_page_record);
            for($i=1; $i<=$result_num_pages; $i++)  
            {

               $output .= "<button><span class='pagination_link'  id='".$i."'>".$i."</span></button>"." ";  
               
            }  
            $output .= '</div>';  
        echo $output;
    }
 ?>
         
    

   
       
        
           
