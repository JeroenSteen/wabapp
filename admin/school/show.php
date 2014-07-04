<?php
include("../../app/db.php");
include("../../app/config.php");

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

            <p>Gegevens school</p>
            <input class="btn" type="submit" value="Aanpassen"/>
        </div>
    </div>
    <?php include("../../_footer.php"); ?>
</div>



</body>
</html>