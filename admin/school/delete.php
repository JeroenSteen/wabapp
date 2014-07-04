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

if(isset($_POST["submit"]) && !empty($_POST["school"])){
    $school = $_POST["school"];

    $query = "DELETE FROM Scholen WHERE SchoolID='$school'";

    $mysqli->query($query);

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

    <div class="sixteen columns mt-20">
        <div class="frame">

            <div class="fdb">
                <p>
                    School <br>
                </p>
            </div>

            <form method="POST" action="">
                <fieldset>
                    <legend>Verwijderen van een school</legend>

                    <label for="school">School</label>
                    <!--Waardes moeten gehaald worden uit de database-->
                    <select name="school" id="school" autofocus="true" required="true">
                        <?php echo $selectOptions ?>
                    </select>

                    <input class="btn" type="submit" name="submit" id="submit"value="Verwijderen"/>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php include("../../_footer.php"); ?>

</body>
</html>