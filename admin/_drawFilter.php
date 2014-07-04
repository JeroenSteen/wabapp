<?php

//Reservations.js stuurt bij klikken op datum/dag
//Een ajax call, naar Schema.php
//Waar de data wordt opgevraagd
//Deze data, wordt met de Filter
//uiteindelijk gefilterd en getekend!

//Reserveringen per dag     -   $_POST['data']
if (isset($_POST['data'])) {
//Permuatie's kwartieren    -   json_encode($GLOBALS["times"]);
    $GLOBALS["times"] = [];

    function addTime($time)
    {
        array_push($GLOBALS["times"], $time);
    }

    $minutes = ["00", "15", "30", "45"];

    for ($i = 0; $i < 24; $i++) {
        if ($i == 0) {
            $i = "00";

            addTime($i . ":" . $minutes[0]);
            addTime($i . ":" . $minutes[1]);
            addTime($i . ":" . $minutes[2]);
            addTime($i . ":" . $minutes[3]);

            $i = 0;
        } else {
            $a = $i;
            if ($i < 10) {
                $i = "0" . $a;
            } else {
                $i = "" . $a;
            }

            addTime($i . ":" . $minutes[0]);
            addTime($i . ":" . $minutes[1]);
            addTime($i . ":" . $minutes[2]);
            addTime($i . ":" . $minutes[3]);

            $i = $a;
        }
    }

//2014-06-29    - dag
//00:15 :00     - zonder seconden
//begin tot loopen einde (eindtijd)
    function filterReservations($reservations)
    {
        $schemaDagMarkUp = '<ul class="schema_dag">';

        //Vraag dag op
        $dag = substr($reservations[0]["Begintijd"], 0, 11);
        rtrim($dag, " ");

        //Doorloop alle tijden
        foreach ($GLOBALS["times"] as $time) {
            foreach ($reservations as $reservation) {

                //Tijd uit Begintijd
                $beginTime = substr($reservation["Begintijd"], 11, 5);
                //Tijd komt niet voor
                if ($time != $beginTime) {
                    $schemaDagMarkUp = $schemaDagMarkUp . '<li class="schema_kwartier open" data-title="'.$reservation["Begintijd"].'" data-tipper-options="{&#34;direction&#34;:&#34;top&#34;}"></li>';
                } else {
                    $schemaDagMarkUp = $schemaDagMarkUp . '<li class="schema_kwartier closed" data-title="'.$reservation["Begintijd"].'" data-tipper-options="{&#34;direction&#34;:&#34;top&#34;}"></li>';
                }
            }
        }

        $schemaDagMarkUp = $schemaDagMarkUp . '</ul>';
        return $schemaDagMarkUp;
    }

    $eergisteren = filterReservations($_POST['data']['eergisteren']);
    $gisteren = filterReservations($_POST['data']['gisteren']);
    $vandaag = filterReservations($_POST['data']['vandaag']);
    $morgen = filterReservations($_POST['data']['morgen']);
    $overmorgen = filterReservations($_POST['data']['overmorgen']);


    echo $eergisteren . "" . $gisteren . "" . $vandaag . "" . $morgen . "" . $overmorgen;

}