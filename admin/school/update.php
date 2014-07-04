<?php
include("../../app/db.php");
include("../../app/config.php");

//Query voor het ophalen van de schoolnamen
$query = "SELECT SchoolID, Schoolnaam FROM Scholen ORDER BY Schoolnaam ASC";

$result = $mysqli->query($query);

$selectOptions = "";

//Het plaatsen van de schoolnamen in een 'option' element
while($row = mysqli_fetch_assoc($result)){
    $selectOptions .= "<option value=" . $row["SchoolID"] . ">" . $row["Schoolnaam"] . "</option>";
}

if(isset($_POST["submit"]) && !empty($_POST["school"]) && !empty($_POST["tel"]) && !empty($_POST["email"])){
    $id = $_POST["schoolkeuze"];
    $school = $_POST["school"];
    $tel = $_POST["tel"];
    $email = $_POST["email"];

    $query = "UPDATE Scholen SET Schoolnaam='$school', Telnummer='$tel', Email='$email' WHERE SchoolID='$id'";

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

    <script src="../../js/update.js" type="text/javascript"></script>
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

                    <select name="schoolkeuze" id="schoolkeuze" autofocus="true">
                        <option value="">Kies een school</option>
                        <?php echo $selectOptions ?>
                    </select>

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
</div>

<?php include("../../_footer.php"); ?>

</body>
</html>