<?php
include("../app/db.php");
include("../app/config.php");

//Gebruik placer default anders check school/bedrijf
if (!isset($_GET["placer"])) {
    $_GET["placer"] = "school";
}
if ($_GET["placer"] == "school") {

    //Query voor het ophalen van de schoolnamen
    $query = "SELECT SchoolID, Schoolnaam, Email FROM Scholen ORDER BY Schoolnaam ASC";
    $result = $mysqli->query($query);

    $selectOptions = "";
    //Het plaatsen van de schoolnamen in een 'option' element
    while ($row = mysqli_fetch_assoc($result)) {
        $selectOptions .= "<option value=" . $row["SchoolID"] . ">" . $row["Schoolnaam"] . "</option>";
    }
} else if ($_GET["placer"] == "bedrijf") {

    //Query voor het ophalen van de schoolnamen
    $query = "SELECT BedrijvenID, Bedrijfsnaam, Email FROM Bedrijven ORDER BY Bedrijfsnaam ASC";
    $result = $mysqli->query($query);

    $selectOptions = "";
    //Het plaatsen van de schoolnamen in een 'option' element
    while ($row = mysqli_fetch_assoc($result)) {
        $selectOptions .= "<option value=" . $row["BedrijvenID"] . ">" . $row["Bedrijfsnaam"] . "</option>";
    }
}

//Haal alle boten op :)
$query = "SELECT BotenID, Bootnaam FROM Boten ORDER BY Bootnaam ASC";
$result = $mysqli->query($query);
$selectBootOptions = "";
//Het plaatsen van de schoolnamen in een 'option' element
while ($row = mysqli_fetch_assoc($result)) {
    $selectBootOptions .= "<option value=" . $row["BotenID"] . ">" . $row["Bootnaam"] . "</option>";
}

//Kijken of de input leeg is of niet
if (isset($_POST["submit"]) && !empty($_POST["placerID"]) && !empty($_POST["datum"]) && !empty($_POST["begin"]) && !empty($_POST["eind"]) && !empty($_POST["boot"]) && !empty($_POST["baan"]) && !empty($_POST["placer"])) {
    $placerID = $_POST["placerID"];
    $_GET["placerID"] = $_POST["placerID"];

    $datum = $_POST["datum"];
    $beginTijd = date("Y-m-d H:i:s", strtotime($datum . " " . $_POST["begin"]));
    $eindTijd = date("Y-m-d H:i:s", strtotime($datum . " " . $_POST["eind"]));
    $bootID = $_POST["boot"];
    $baan = $_POST["baan"];
    $placer = $_POST["placer"];

    //echo "Begin: " . $beginTijd . "\n";
    //echo "Eind: " . $eindTijd;

    if ($_POST["placer"] == "school") {
        $query = "INSERT INTO  Reservering (Boten_BotenID, Scholen_SchoolID, Aantal_mensen, Datum, Begintijd, Eindtijd, Baan, CategorieID) VALUES('$bootID', '$placerID', 8, '$datum', '$beginTijd', '$eindTijd', '$baan', 1)";
        if (!$result = $mysqli->query($query)) {
            printf("Query error: %s", $mysqli->error);
        }

        //Pak e-mail bericht; notificeer school
        $query_school = "SELECT * FROM Scholen WHERE SchoolID='$schoolID'";
        $result_school = $mysqli->query($query_school);
        while ($row_school = mysqli_fetch_assoc($result_school)) {
            $school_naam = $row_school["Schoolnaam"];
            $school_email = $row_school["Email"];
        }

        include("../mail/reservation_placed.php");

        //TODO: Zoek schoolnaam en e-mail op

        $mail_school = $reservation_placed;
        sendMail($school_email, "Uw reservering", $mail_school);
    } else {
        $query = "INSERT INTO  Reservering (Boten_BotenID, Bedrijven_BedrijfID, Aantal_mensen, Datum, Begintijd, Eindtijd, Baan, CategorieID) VALUES('$bootID', '$placerID', 8, '$datum', '$beginTijd', '$eindTijd', '$baan', 1)";
        if (!$result = $mysqli->query($query)) {
            printf("Query error: %s", $mysqli->error);
        }

        $query_bedrijf_info = "SELECT * FROM Bedrijven WHERE BedrijvenID='$bedrijfID'";
        $result_bedrijf_info = $mysqli->query($query_bedrijf_info);
        while ($row_bedrijf_info = mysqli_fetch_assoc($result_bedrijf_info)) {
            $bedrijf_naam = $row_bedrijf_info["Bedrijfsnaam"];
            $bedrijf_email = $row_bedrijf_info["Email"];
        }

        include("../mail/reservation_notify.php");
        include("../mail/sendMail.php");

        //Datum + beginTijd + eindTijd
        $reservation_datum = $datum . ' van ' . $beginTijd . ' t/m ' . $eindTijd;

        //    TODO: Zoek bedrijfsnaam en e-mail op
        $mail_bedrijf = $reservation_notify;

        sendMail($bedrijf_email, "Reservering", $mail_bedrijf);
        sendMail("rowintothefuture@gmail.com", "Reservering", $mail_bedrijf);
    }
}
?>


<!DOCTYPE html>
<?php include ("../_html.php"); ?>
<head>

    <title>Wab APP</title>
    <meta name="description" content="">

    <?php
    $root = "../";
    include ("../_head.php");
    ?>
    <link href=<?php echo $root . "css/ui-lightness/jquery-ui-1.10.4.custom.css" ?> rel="stylesheet">
    <link href=<?php echo $root . "css/schema.css" ?> rel="stylesheet">
    <link href=<?php echo $root . "js/vendor/jquery.fs.tipper.css" ?> rel="stylesheet">
    <script src=<?php echo $root . "js/vendor/jquery.fs.tipper.min.js" ?>></script>
    <link href=<?php echo $root . "css/timepicker/jquery.timepicker.css" ?> rel="stylesheet">
    <script src=<?php echo $root . "js/jquery-ui-1.10.4.custom.js" ?>></script>
    <script src=<?php echo $root . "js/jquery.timepicker.js" ?>></script>
    <script src=<?php echo $root . "js/reservation.js" ?>></script>
	<style>
	.tipper {
		z-index: 100000000;
	}
	</style>
</head>
<body>


<div class="container">
    <?php include ("../_header.php"); ?>

    <div class="col16 col mt-20">
        <div class="frame clearfix">

            <div class="fdb">
                <p>
                    Reserveren roeien<br>
                </p>
            </div>

            <form id="formulier" method="POST" action="">
                <fieldset>
                    <legend>Vul het moment in wanneer de klas kan roeien.</legend>

                    <!--Waardes moeten gehaald worden uit de database-->
                    <select name="placerID" id="placerID" autofocus="autofocus">
                        <?php if ($_GET["placer"] == "school"){
                        echo "<option value=''>Kies een school</option>";
                        } else {
                        echo "<option value=''>Kies een bedrijf</option>";
                        }?>

                        <?php echo $selectOptions; ?>
                    </select>

                    <label for="datum">Datum</label>
                    <input type="text" name="datum" id="datum"/>

                    <!--Regex voor controleren invulling van tijd: (([0-1][0-9]|[2][0-3]):([0-5][0-9])) Gebruik voor browsers zonder 'time' input support-->
                    <label for="begin">Begintijd</label>
                    <input type="text" name="begin" id="begin"/>

                    <label for="eind">Eindtijd</label>
                    <input type="text" name="eind" id="eind"/>


                    <label for="boot">Boot</label>
                    <select name="boot" id="boot">
                         <?php echo $selectBootOptions; ?>
                    </select>

                    <label for="baan">Baan</label>
                    <select name="baan" id="baan">
                        <option value="WAB1">WAB1</option>
                        <option value="WAB2">WAB2</option>
                        <option value="WAB3">WAB3</option>
                        <option value="WAB4">WAB4</option>
                        <option value="WAB5">WAB5</option>
                    </select>

                    <input type="hidden" name="placer" id="placer" value="<?php echo $_GET['placer']; ?>"/>

                    <input class="btn" type="submit" name="submit" value="Reserveren"/>
                </fieldset>
            </form>

            <div id="schema">
                <!--

                Na klikken op datum;
                POST - voor datum (dag.php); actie op begin/eind
                POST - voor schema (schema.php); actie in schema div

                -->
            </div>


        </div>
    </div>
</div>

<?php include ("../_footer.php"); ?>

</body>
</html>