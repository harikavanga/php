<?php
if(isset($_POST["country"])){
    $country = $_POST["country"];
     
    // Define country and city array
    $countryArr = array(
                    "usa" => array("New Yourk", "Los Angeles", "California"),
                    "india" => array("Maharashtra", "Telangana", "karnataka"),
                    "uk" => array("London", "Manchester", "Liverpool")
                );
     
    // Display city dropdown based on country name
    if($country !== 'Select'){
        echo "<label>state:</label>";
        echo "<select name='state'>";
        foreach($countryArr[$country] as $value){
            echo "<option value='".$value."'>". $value . "</option>";
        }
        echo "</select>";
    } 
}

?>