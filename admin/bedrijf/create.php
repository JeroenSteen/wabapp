<?php
include("../../app/db.php");
include("../../app/config.php");

if(isset($_POST["submit"])){
    $bedrijf = $_POST["bedrijf"];
    $tel = $_POST["tel"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];

    $query = "INSERT INTO Bedrijven (Telnummer, Contactpersoon, Email, Bedrijfslogo, Bedrijfsnaam) VALUES ('$tel','$contact','$email','','$bedrijf')";
    $mysqli->query($query);

    $fdb = "Het bedrijf ".$bedrijf." is succesvol toegevoegd!";
}


?>


<!DOCTYPE html>
<?php include("../../_html.php"); ?>
<head>

    <title>Wab APP</title>
    <meta name="description" content="">

    <?php
    $root = "../../";
    include("../../_head.php");
    ?>
</head>
<body>


<div class="container">
    <?php include("../../_header.php"); ?>

    <div class="col16 col mt-20">
        <div class="frame">

            <div class="fdb">
                <p>
                    Bedrijf <br>
                </p>
            </div>

            <h3>
            <?php
            if(isset($fdb)){echo $fdb;}
            ?>
            </h3>

            <form method="POST" action="">
                <fieldset>
                    <legend>Voeg hier een bedrijf met bijbehorende gegevens toe</legend>

                    <label for="bedrijf">Bedrijfsnaam</label>
                    <input type="text" name="bedrijf" id="bedrijf" autofocus="true"/>

                    <label for="tel">Telefoonnummer</label>
                    <input type="tel" name="tel" id="tel"/>

                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email"/>

                    <input class="btn" type="submit" name="submit" id="submit" value="Toevoegen"/>
                </fieldset>
            </form>
        </div>
    </div>
    <?php include("../../_footer.php"); ?>
</div>



</body>
</html>