<?php
include("../../app/db.php");
include("../../app/config.php");

//Bedrijven opvragen
$query = "SELECT * FROM Bedrijven";
if($result = $mysqli->query($query)){}

//Categorieën opvragen
$query_categorie = "SELECT * FROM Categorie";
if($result_categorie = $mysqli->query($query_categorie)){}

//Create; add boot to bedrijf
if(isset($_POST['add'])){
    $soort = $_POST["soort"];

    $allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPG", "JPEG", "PNG");
    $temp = explode(".", $_FILES["image"]["name"]);
    $extension = end($temp);

    //Afbeelding uploaden
    if ((($_FILES["image"]["type"] == "image/gif")
            || ($_FILES["image"]["type"] == "image/jpeg")
            || ($_FILES["image"]["type"] == "image/jpg")
            || ($_FILES["image"]["type"] == "image/pjpeg")
            || ($_FILES["image"]["type"] == "image/x-png")
            || ($_FILES["image"]["type"] == "image/png"))
        && ($_FILES["image"]["size"] < 5000000)
        && in_array($extension, $allowedExts)
    ) {
        if ($_FILES["image"]["error"] > 0) {
            echo "Return Code: " . $_FILES["image"]["error"] . "<br>";
        } else {
            if (file_exists("upload/" . $_FILES["image"]["name"])) {
                echo $_FILES["image"]["name"] . " already exists. ";
            } else {
                move_uploaded_file($_FILES["image"]["tmp_name"], "upload/" . $_FILES["image"]["name"]);
                //echo "Stored in: " . "upload/" . $_FILES["image"]["name"];



                $image = $_FILES["image"]["name"];
            }
        }
    } else {
        echo "Invalid file";
    }

    $bedrijfID = $_POST["bedrijf"];
    $maxAantal = $_POST["aantal"];
    $naam = $_POST["naam"];
    $categorie = $_POST["categorie"];

    $query_create = "INSERT INTO Boten (Soort, Boot_image, Bedrijven_BedrijvenID, MaxAantal, Bootnaam, CategorieID) VALUES ('$soort','$image','$bedrijfID','$maxAantal','$naam', '$categorie')";
    $mysqli->query($query_create);
}

//Update

//Delete
if(isset($_GET['del'])){
    $id = $_GET["del"];
    $query_del = "DELETE FROM Boten WHERE BotenID='$id'";
    $mysqli->query($query_del);
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
        <div class="frame clearfix">

            <div class="fdb">
                <p>
                    Boten toekennen <br>
                </p>
            </div>



        <div class="col8 col alpha">
            <h3>Koppel bedrijf aan nieuwe boten</h3>

            <form method="POST" action="" enctype="multipart/form-data">
                <fieldset>
                    <select name="bedrijf" id="bedrijf" required="true">
                        <?php
                        while ($row = $result->fetch_array(MYSQL_ASSOC)) {

                            echo '<option value="' . $row["BedrijvenID"] . '">' . $row["Bedrijfsnaam"] . '</option>';
                        }
                        ?>
                    </select>
                </fieldset>
                <fieldset>
                    <label for="categorie">Categorie</label>
                    <select name="categorie" id="categorie" required="true">
                        <?php
                        while ($row_categorie = $result_categorie->fetch_array(MYSQL_ASSOC)) {

                            echo '<option value="' . $row_categorie["CategorieID"] . '">' . $row_categorie["CategorieNaam"] . '</option>';
                        }
                        ?>
                    </select>
                </fieldset>

        </div>

        <div class="col8 omega">
                <fieldset>
                    <label for="naam">Bootnaam</label>
                    <input type="text" name="naam" id="naam"/>

                    <label for="soort">Boottype</label>
                    <input type="text" name="soort" id="soort"/>

                    <label for="image">Afbeelding</label>
                    <input type="file" name="image" id="image"/>

                    <label for="aantal">Max. aantal</label>
                    <input type="text" name="aantal" id="aantal"/>

                    <br><br>

                    <input class="btn" type="submit" name="add" id="add" value="Toevoegen"/>
                </fieldset>
            </form>

        </div>
    </div>

    <div class="col16 mt-20">
        <div class="frame clearfix">

            <div class="fdb">
                <p>
                    Boten verwijderen <br>
                </p>
            </div>

        <?php
        //Bedrijven opvragen
        $query_boten = "SELECT * FROM Boten";
        if($result_boten = $mysqli->query($query_boten)){
            while ($boot = $result_boten->fetch_array(MYSQL_ASSOC)) {
                $id = $boot["Bedrijven_BedrijvenID"];
                $query_bedrijf = "SELECT Bedrijfsnaam FROM Bedrijven WHERE BedrijvenID='$id'";
                if($result_bedrijf = $mysqli->query($query_bedrijf)){
                    while ($bedrijf = $result_bedrijf->fetch_array(MYSQL_ASSOC)) {
                        echo '<h3>'.$boot["Bootnaam"].' - '.$bedrijf["Bedrijfsnaam"].' <a href="?del='.$boot["BotenID"].'"><strong>X</strong></a></h3>';
                    }

                }

            }
        }
        ?>
        </div>
    </div>

    </div>
    <?php include("../../_footer.php"); ?>
</div>



</body>
</html>