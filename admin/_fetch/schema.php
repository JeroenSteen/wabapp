<?php
ini_set("date.timezone", "Europa/Amsterdam");

include("../../app/db.php");
include("../../app/config.php");

//Datum is specifieke dag waarop men wil reserveren
if(isset($_POST["datum"])){
    $datum = $_POST["datum"];

    $morgen = strtotime($datum) + 60 * 60 * 24; //Morgen
    $overmorgen = strtotime($morgen) + 60 * 60 * 24; //Morgen

    $gisteren = strtotime($datum) - 60 * 60 * 24; //Gisteren
    $eergisteren = strtotime($gisteren) - 60 * 60 * 24; //Eergisteren

    $newMorgen = date("Y-m-d H:i:s", $morgen);
    $newOvermorgen = date("Y-m-d H:i:s", $overmorgen);
    $newGisteren = date("Y-m-d H:i:s", $morgen);
    $newEergisteren = date("Y-m-d H:i:s", $eergisteren);

    //Query's apart voor "dag" key
    $array = array();

    //Morgen
    $query = "SELECT Begintijd, Eindtijd FROM Reservering WHERE Datum='$newMorgen'";
    if($result = $mysqli->query($query)){
        if($result->num_rows > 0){
            while ($row = $result->fetch_array(MYSQL_ASSOC)) {
                $array["morgen"][] = $row;
            }
        } else {
            $array["morgen"][] = "";
        }
    } else {
        $array["morgen"][] = "";
    }

    //Overmorgen
    $query = "SELECT Begintijd, Eindtijd FROM Reservering WHERE Datum='$newOvermorgen'";
    if($result = $mysqli->query($query)){
        if($result->num_rows > 0){
            while ($row = $result->fetch_array(MYSQL_ASSOC)) {
                $array["overmorgen"][] = $row;
            }
        } else {
            $array["overmorgen"][] = "";
        }
    } else {
        $array["overmorgen"][] = "";
    }

    //Gisteren
    $query = "SELECT Begintijd, Eindtijd FROM Reservering WHERE Datum='$newGisteren'";
    if($result = $mysqli->query($query)){
        if($result->num_rows > 0){
            while ($row = $result->fetch_array(MYSQL_ASSOC)) {
                $array["gisteren"][] = $row;
            }
        } else {
            $array["gisteren"][] = "";
        }
    } else {
        $array["gisteren"][] = "";
    }

    //Eergisteren
    $query = "SELECT Begintijd, Eindtijd FROM Reservering WHERE Datum='$newEergisteren'";
    if($result = $mysqli->query($query)){
        if($result->num_rows > 0){
            while ($row = $result->fetch_array(MYSQL_ASSOC)) {
                $array["eergisteren"][] = $row;
            }
        } else {
            $array["eergisteren"][] = "";
        }
    } else {
        $array["eergisteren"][] = "";
    }

    //Vandaag
    $query = "SELECT Begintijd, Eindtijd FROM Reservering WHERE Datum='$datum'";
    if($result = $mysqli->query($query)){
        if($result->num_rows > 0){
            while ($row = $result->fetch_array(MYSQL_ASSOC)) {
                $array["vandaag"][] = $row;
            }
        } else {
            $array["vandaag"][] = "";
        }
    } else {
        $array["vandaag"][] = "";
    }

    //Filteren

    //Tekenen

    echo json_encode($array);

}
