<?php
include("../../app/db.php");
include("../../app/config.php");

//Mogelijk nog de 'submit' knop blokkeren na het toevoegen
if(isset($_POST["submit"]) && !empty($_POST["school"]) && !empty($_POST["tel"]) && !empty($_POST["email"])){
    $school = $_POST["school"];
    $tel = $_POST["tel"];
    $email = $_POST["email"];

    $query = "INSERT INTO  Scholen (Schoolnaam, Telnummer, Email) VALUES('$school', '$tel', '$email')";

    $result = $mysqli->query($query);

    header("Location:" . $_SERVER['PHP_SELF']);
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
                    School <br>
                </p>
            </div>

            <form method="POST" action="">
                <fieldset>
                    <legend>Voeg hier een school met bijbehorende gegevens toe</legend>

                    <label for="school">School</label>
                    <input type="text" name="school" id="school" autofocus="true"/>

                    <label for="tel">Telefoonnummer</label>
                    <input type="tel" name="tel" id="tel"/>

                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email"/>

                    <input class="btn" type="submit" name="submit" id="submit"value="Toevoegen"/>
                </fieldset>
            </form>
        </div>
    </div>
    <?php include("../../_footer.php"); ?>
</div>



</body>
</html>