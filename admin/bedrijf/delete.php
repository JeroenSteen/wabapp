<?php
include("../../app/db.php");
include("../../app/config.php");

if(isset($_POST["submit"])){
    $id = $_POST["bedrijf"];
    "DELETE FROM Bedrijven WHERE BedrijvenID='$id'";
}

$query = "SELECT * FROM Bedrijven";
if($result = $mysqli->query($query)){}

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
                    Bedrijf <br>
                </p>
            </div>

            <form method="POST" action="">
                <fieldset>
                    <legend>Verwijderen van een bedrijf</legend>

                    <label for="bedrijf">Bedrijf</label>

                    <select name="bedrijf" id="bedrijf" required="true">
                    <?php
                    while ($row = $result->fetch_array(MYSQL_ASSOC)){

                        echo '<option value="'.$row["BedrijvenID"].'">'.$row["Bedrijfsnaam"].'</option>';
                    }
                    ?>
                    </select>

                    <input class="btn" type="submit" name="submit" id="submit" value="Verwijderen"/>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php include("../../_footer.php"); ?>

</body>
</html>