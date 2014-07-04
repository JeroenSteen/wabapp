<?php

//Baan voor bepaalde tijd
$baan = $_POST["baan"];

$query = "SELECT * FROM Reservering WHERE Baan='$baan'";
if($result = $mysqli->query($query)){

    //Terug: Baan is op die tijd al gekozen
    if($result->num_rows > 0){
        //Baan is niet vrij
        return 1;
    } else {
        //Baan is wel vrij
        return 0;
    }

}