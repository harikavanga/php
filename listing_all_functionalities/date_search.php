<?php 

   require('connection.php');
   $date_created=$_REQUEST['date_created'];
   $date_modified=$_REQUEST['date_modified'];

    $output='';
    $count=1;
    

   if(!empty($date_created)){

      $sql="SELECT * FROM validationform WHERE Created_at LIKE '%$date_created%'";
   }
   else if(!empty($date_modified)){
      $sql="SELECT * FROM validationform WHERE Modified_at LIKE '%$date_modified%'";
   }
  

   // $sql="SELECT * FROM validationform WHERE Created_at LIKE '%$date_created%' OR Modified_at LIKE '%$date_modified%'";
   $result=mysqli_query($conn, $sql);
   if($result->num_rows>0){

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
   }else{

    echo "No records available";
   }


?>