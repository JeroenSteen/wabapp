<?php
include("../../app/db.php");
include("../../app/config.php");

if(isset($_POST["submit"])){
    $id = $_POST["id"];
    $bedrijf = $_POST["bedrijf"];
    $tel = $_POST["tel"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];

    $query = "UPDATE Bedrijven SET Telnummer='$tel', Contactpersoon='$contact', Email='$email', Bedrijfslogo='', Bedrijfsnaam='$bedrijf' WHERE BedrijvenID='$id'";
    $mysqli->query($query);
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



            <?php
            if (isset($_POST['edit_id']) || isset($_GET['edit_id'])) {
                if (isset($_POST['edit_id'])){
                    $edit_id = $_POST['edit_id'];
                } else {
                    $edit_id = $_GET['edit_id'];
                }

                $query_edit = "SELECT * FROM Bedrijven Where BedrijvenID='$edit_id'";
                if($result_edit = $mysqli->query($query_edit)){}
                while ($row = $result_edit->fetch_array(MYSQL_ASSOC)){
                ?>
                <form method="POST" action="">
                    <fieldset>
                        <legend>Verander hier een bedrijf zijn gegevens</legend>

                        <input type="hidden" name="id" id="id" value="<?php echo $row["BedrijvenID"]; ?>"/>

                        <label for="bedrijf">Bedrijfsnaam</label>
                        <input type="text" name="bedrijf" id="bedrijf" value="<?php echo $row["Bedrijfsnaam"]; ?>" autofocus="true"/>

                        <label for="tel">Telefoonnummer</label>
                        <input type="tel" name="tel" id="tel" value="<?php echo $row["Telnummer"]; ?>"/>

                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" value="<?php echo $row["Email"]; ?>"/>

                        <a class="btn" href="delete.php">Uitschrijven</a>
                        <input class="btn" type="submit" name="submit" id="submit" value="Pas aan"/>
                    </fieldset>
                </form>
            <?php
            }} else {
                echo '<label for="bedrijf">Aanpassen bedrijf</label>';
                echo '<select name="bedrijf" id="bedrijf" required="true">';
                while ($row = $result->fetch_array(MYSQL_ASSOC)) {
                    echo '<option value="' . $row["BedrijvenID"] . '">' . $row["Bedrijfsnaam"] . '</option>';
                }
                echo '</select>';
            } ?>



        </div>
    </div>
</div>

<?php include("../../_footer.php"); ?>

</body>
</html>