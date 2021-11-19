<?php  
 require('connection.php'); 
 $output = '';  
 $order = $_POST["order"];  
 if($order == 'desc')  
 {  
      $order = 'asc';  
 }  
 else  
 {  
      $order = 'desc';  
 }  
 $sql = "SELECT * FROM validationform ORDER BY ".$_POST["column_name"]." ".$_POST["order"]."";  
 $result = mysqli_query($conn, $sql);  
 $output .= '  
 <table class="table table-bordered" width="100%">  
      <tr>  
           <th><a class="column_sort" id="S.No." data-order="'.$order.'" href="#">S.No.</a></th>  
           <th><a class="column_sort" id="FirstName" data-order="'.$order.'" href="#">FirstName</a></th>
           <th><a class="column_sort" id="LastName" data-order="'.$order.'" href="#">LastName</a></th>
           <th><a class="column_sort" id="Email" data-order="'.$order.'" href="#">Email</a></th>
           <th><a class="column_sort" id="Phone" data-order="'.$order.'" href="#">Phone</a></th>  
           <th><a class="column_sort" id="Gender" data-order="'.$order.'" href="#">Gender</a></th>  
           <th><a class="column_sort" id="LanguagesKnown" data-order="'.$order.'" href="#">LanguagesKnown</a></th>
           <th><a class="column_sort" id="Image" data-order="'.$order.'" href="#">Image</a></th>
           <th><a class="column_sort" id="Created_at" data-order="'.$order.'" href="#">Created_at</a></th>
           <th><a class="column_sort" id="Modified_at" data-order="'.$order.'" href="#">Modified_at</a></th> 

      </tr>  
 '; 
 $count=1; 
 while($row = mysqli_fetch_array($result))  
 {  
      $output .= '  
      <tr>  
           <td>' . $count . '</td>  
           <td>' . $row["FirstName"] . '</td>
           <td>' . $row["LastName"] . '</td> 
           <td>' . $row["Email"] . '</td>
           <td>' . $row["Phone"] . '</td> 
           <td>' . $row["Gender"] . '</td>  
           <td>' . $row["LanguagesKnown"] . '</td>
           <td><img src="'.$row["Image"].'" height="20px" width="20px"></td>
           <td>'.$row["Created_at"].'</td>
           <td>'.$row["Modified_at"].'</td>    
      </tr>  
      '; 
  $count++; 
 }  
 $output .= '</table>';  
 echo $output;  
 ?>  