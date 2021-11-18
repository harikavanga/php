<?php
if(isset($_POST["state"])){
    $state = $_POST["state"];

    // Define country and city array
    $stateArr = array(
                    "New Yourk" => array("albany","utica"),
                    "Los Angeles" => array("santa monica","torrance"),
                    "California" => array("irvine","sanjose"),
                    "Maharashtra"=>array("pune","nagpur"),
                    "Telangana"=>array("karimnagar","hyderabad"),
                    "karnakata"=>array("bangolore","vijayapura"),
                    "London"=>array("bristol","blackpool"),
                    "Manchester"=>array("wigan","boltan"),
                    "Liverpool"=>array("clubmoor","childwall"),
                );
     
    // Display city dropdown based on country name
    if($state !== 'Select'){
        echo "<label>City:</label>";
        echo "<select name='city'>";
        foreach($stateArr[$state] as $value){
            echo "<option value='".$value."'>". $value . "</option>";
        }
        echo "</select>";
    } 
}
?>