<?php
include("../../app/db.php");
include("../../app/config.php");

//Update
if(isset($_POST["submit"])){
    $id = $_POST["bedrijf"];
    header('Location: update.php?edit_id='.$id);
}

//Show meer info
if(isset($_POST["show"])){
    $id = $_POST["bedrijf"];
    header('Location: show.php?show_id='.$id);
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
                    Bedrijven <br>
                </p>
            </div>

            <h3>Alle bedrijven</h3>

            <form method="POST" action="">
                <fieldset>
                    <select name="bedrijf" id="bedrijf" required="true">
                        <?php
                        while ($row = $result->fetch_array(MYSQL_ASSOC)) {

                            echo '<option value="' . $row["BedrijvenID"] . '">' . $row["Bedrijfsnaam"] . '</option>';
                        }
                        ?>
                    </select>
                    <input class="btn" type="submit" name="show" id="show" value="Meer info"/>
                    <input class="btn" type="submit" name="submit" id="submit" value="Aanpassen"/>
                </fieldset>
            </form>


        </div>
    </div>
</div>

<?php include("../../_footer.php"); ?>

</body>
</html>