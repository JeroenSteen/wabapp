<?php

//Baan voor bepaalde tijd
$boot = $_POST["boot"];

$query = "SELECT * FROM Reservering WHERE Boten_BotenID='$boot'";
if($result = $mysqli->query($query)){

    //Terug: Boot is beschikbaar
    if($result->num_rows > 0){
        //Boot is niet vrij
        return 1;
    } else {
        //Boot is wel vrij
        return 0;
    }

}