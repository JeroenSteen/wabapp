<?php

//Tijd is specifiek een begin en eind datum
$begintijd = $_POST["begintijd"];
$eindtijd = $_POST["eindtijd"];

//Query behoort te zoeken naar; midden van begin en eindtijd
$query = "SELECT * FROM Reservering WHERE Begintijd BETWEEN '$begintijd' AND '$eindtijd' OR Eindtijd BETWEEN '$begintijd' AND '$eindtijd';";

if($result = $mysqli->query($query)){

    //Terug: Begin en eindtijd voor reservering
    //overlappen met andere reservering(en)
    if($result->num_rows > 0){
        //Reservering overlapt
        return 1;
    } else {
        //Reservering overlapt niet
        return 0;
    }

}