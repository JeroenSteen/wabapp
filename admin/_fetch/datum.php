<?php

include("../../app/db.php");
include("../../app/config.php");

//Dag en Tijd combined; SQL return true/false 1/0
$datum = $_POST["datum"];

//Tijd is specifiek een begin en eind datum
$begintijd = $_POST["begintijd"];
$eindtijd = $_POST["eindtijd"];

//Query behoort te zoeken naar; datum (dag) + midden van begin en eindtijd
$query = "SELECT * FROM Reservering WHERE Datum='$datum' AND Begintijd BETWEEN '$begintijd' AND '$eindtijd' OR Eindtijd BETWEEN '$begintijd' AND '$eindtijd'";

if($result = $mysqli->query($query)){

    //Terug: Dag is al eens eerder gereserveerd +
    //Begin en eindtijd voor reservering
    //overlappen met andere reservering(en)

    if($result->num_rows > 0){
        //Dag is mogelijk nog vrij; Reservering tijd overlapt

        while ($row = $result->fetch_array(MYSQL_ASSOC)) {
            echo json_encode($row);
        }

        //return 1;
    } else {
        //Dag is helemaal vrij; Reservering tijd overlapt niet
        echo "0";
    }
} else {
    echo "0";
}