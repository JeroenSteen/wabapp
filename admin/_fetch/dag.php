<?php

include("../../app/db.php");
include("../../app/config.php");

//Datum is specifieke dag waarop men wil reserveren
if(isset($_POST["datum"])){
    $datum = $_POST["datum"];

    $query = "SELECT Begintijd, Eindtijd FROM Reservering WHERE Datum='$datum'";
    if($result = $mysqli->query($query)){
        if($result->num_rows > 0){
            $array = array();
            while ($row = $result->fetch_array(MYSQL_ASSOC)) {
                array_push($array, $row);
            }
            echo json_encode($array);
        }
    }
}
