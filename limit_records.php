<?php 
require('connection.php');
session_start();
?>
<?php
if(isset($_REQUEST['page'])){
     $page=$_REQUEST['page'];
}else{
     $page=1;
}
$output='';  
$order="desc";
 if(isset($_REQUEST['order']))
    {
        $order=$_REQUEST['order'];
        if($order=='desc'){
        
            $order='asc';
        }
        else{
            
            $order='desc';
        }
    }
        
        if(isset($_REQUEST['column'])){
            echo $_REQUEST['column'];
        }



             $username=$_SESSION['username'];

             $sql="SELECT * FROM users where username='$username'";
             $result=mysqli_query($conn,$sql);
             while($row = mysqli_fetch_assoc($result)){
                  $id=$row['id'];
             }

             if(!empty($_REQUEST['text'])){
                 $text=$_REQUEST['text'];
                $sql="SELECT * FROM user_contacts where user_id=$id AND  name like '%$text%' or email like '%$text%' or gender like '%$text%' or languages like '%$text%' or country like '%$text%'or state like '%$text%' or city like '%$text%'";
            }else{
              $sql="SELECT * FROM user_contacts where user_id=$id";
             } 
              $result=mysqli_query($conn,$sql);
              $result_num_rows=mysqli_num_rows($result);

              // pagination
              $per_page_record=3;
              $result_num_pages=ceil($result_num_rows/$per_page_record);
              
              
              $start_from=($page-1)*$per_page_record;
           
             if(!empty($_REQUEST['text'])){
                $text=$_REQUEST['text'];


                $sql="SELECT * FROM user_contacts where user_id=$id AND  name like '%$text%' or email like '%$text%' or gender like '%$text%' or languages like '%$text%' or country like '%$text%'or state like '%$text%' or city like '%$text%' or created_at like '%$text%' or modified_at like '%$text%' LIMIT $start_from,$per_page_record";   

                if(isset($_REQUEST['column']) && isset($_REQUEST['order'])){

                    $sql="SELECT * FROM user_contacts where user_id=$id AND  name like '%$text%' or email like '%$text%' or gender like '%$text%' or languages like '%$text%' or country like '%$text%'or state like '%$text%' or city like '%$text%' or created_at like '%$text%' or modified_at like '%$text%' ORDER BY ".$_POST["column"]." ".$_POST['order']." LIMIT $start_from,$per_page_record";
                }

             }
              else{

                 $sql="SELECT * FROM user_contacts where user_id=$id LIMIT $start_from,$per_page_record";

                 if(isset($_REQUEST['column']) && isset($_REQUEST['order'])){
                    $sql="SELECT * FROM user_contacts where user_id=$id  ORDER BY ".$_POST["column"]." ".$_POST['order']." LIMIT $start_from,$per_page_record";
                 }
              }
                            
              $result_records=mysqli_query($conn,$sql);
              $result_num_records=mysqli_num_rows($result_records);
    
              $output .= '  
                     <table width="100%"" height="50%"" class="table table-bordered">  
                     <tr>  
                         <th><a class="column_sort" id="name"  data-order="'.$order.'" href="#">name</a></th>
                         <th><a class="column_sort" id="email" data-order="'.$order.'" href="#">email</a></th>
                         <th><a class="column_sort" id="gender" data-order="'.$order.'" href="#">gender</a></th>
                         <th><a class="column_sort" id="languages" data-order="'.$order.'" href="#">languages</a></th>
                         <th><a class="column_sort" id="country" data-order="'.$order.'" href="#">country</a></th>
                         <th><a class="column_sort" id="state" data-order="'.$order.'" href="#">state</a></th>
                         <th><a class="column_sort" id="city" data-order="'.$order.'" href="#">city</a></th>
                         <th><u>image</u></th>
                         <th><a class="column_sort" id="created_at" data-order="'.$order.'" href="#">created_at</a></th>
                         <th><a class="column_sort" id="modified_at" data-order="'.$order.'" href="#">modified_at</a></th>
                         <th><u>actions</u></th>
                     </tr>';
              if($result_num_records>0){
              while($row = mysqli_fetch_assoc($result_records)){
               $output.="<tbody>
                            <tr>
                              <td>".$row["name"]."</td>
                              <td>".$row["email"]."</td>
                              <td>".$row["gender"]."</td>
                              <td>".$row["languages"]."</td>
                              <td>".$row["country"]."</td>
                              <td>".$row["state"]."</td>
                              <td>".$row["city"]."</td>
                              <td><img src='".$row['image']."' width='20px' height='20px'></td>
                              <td>".$row["created_at"]."</td>
                              <td>".$row["modified_at"]."</td>
                              <td>
                                <button class='btn-link'><a href='edit.php?update_id=".$row["id"]."'><i class='fas fa-pencil-alt'></i></a></button>
                                <button class='btn-danger'><a  href='delete.php?delete_id=".$row["id"]."'  onclick='return confirm_delete()'><i class='far fa-trash-alt'></i></a></button>
                              </td>
                            </tr>
                        </tbody>";
                      
              }
              $output.="</table>";

              if($page>1){
                $previous=$page-1;
                $output.="<button class='btn-info'  id='".$previous."'><i class='fas fa-angle-double-left'></i></button>";
              }
               if($page<$result_num_pages){
                $next=$page+1;
                $output.="<button class='btn-info' id='".$next."'><i class='fas fa-angle-double-right'></i></button>";
              }
            

              for($page=1;$page<=$result_num_pages;$page++){
                if(isset($_REQUEST['text'])){
                    $output.="<button class='btn-success' align='center' id='".$page."'>".$page."</button>"." ";
                }
                else{
                     $output.="<button class='btn-info' align='center' id='".$page."'>".$page."</button>"." ";
                }
              }
              if($page<=$result_num_pages){
                $next=$page+1;
                $output.="<button class='btn-info' id='".$next."'>>></button>";
              }
              
            echo $output;
        }else{
            echo "<tr><td colspan='11'>No records available</td><tr>";
        }
              	
include('footer.php');
?>