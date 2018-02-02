<?php

include_once('../location/database.php');

if(isset($_POST["state_id"]) && !empty($_POST["state_id"])){
    $query = $db->query("SELECT * FROM cities WHERE state_id = ".$_POST['state_id']." AND status = 1 ORDER BY city_name ASC");
    $rowCount = $query->num_rows;
    if($rowCount > 0){
        echo '<option value="">Select city</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
        }
    } else{
        echo '<option value="">City not available</option>';
    }
}

if(isset($_POST["city_id"]) && !empty($_POST["city_id"])){
    $query = $db->query("SELECT t_org, timing_id FROM timing WHERE t_city_id = ".$_POST['city_id']." ORDER BY t_org ASC");
    $rowCount = $query->num_rows;
    if($rowCount > 0){
        echo '<option value="">Select Canteen / Agency</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['t_org'].'">'.$row['t_org'].'</option>';            
        }
    }else{
        echo '<option value="">Data not available</option>';
    }
}
?>
