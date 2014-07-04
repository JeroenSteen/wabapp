<?php
include("../../app/db.php");
include("../../app/config.php");

if(isset($_GET["show_id"])){
    $id = $_GET["show_id"];
    $query = "SELECT * FROM Bedrijven WHERE BedrijvenID='$id'";
    if($result = $mysqli->query($query)){}
} else {
    header('Location: index.php');
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
                    Bedrijf <br>
                </p>
            </div>


            <?php
            while ($row = $result->fetch_array(MYSQL_ASSOC)) {
                echo "<h3>Gegevens ".$row["Bedrijfsnaam"].":</h3>";
                echo '<p>Telefoonnummer: '.$row["Telnummer"].'</p>';
                echo '<p>E-mail adres: <A HREF="mailto:'.$row["Email"].'">'.$row["Email"].'</A></p>';
                echo "<h3>Logo:</h3>";
                echo '<p><img src="'.$row["Bedrijfslogo"].'" width="300"/></p>';

            }
            echo '</select>';


            echo '<a class="btn" href="update.php?edit_id='.$id.'">Aanpassen</a>';
            ?>

        </div>
    </div>
</div>

<?php include("../../_footer.php"); ?>

</body>
</html>