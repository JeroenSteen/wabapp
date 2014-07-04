<?php
include("../app/config.php");
include("../app/db.php");
$root = "../";
?>

<!DOCTYPE html>
<?php include("../_html.php"); ?>
<head>

    <title>Wab APP</title>
    <meta name="description" content="">

    <?php include("../_head.php"); ?>
</head>
<body>


<div class="container">

    <?php include("../_header.php"); ?>

    <div class="col16 col mt-20">

        <div class="frame">
            <h2> <i class="fa fa-external-link"></i> Widget</h2>
        </div>

        <div id="dashboard" class="frame_light clearfix pb-10">

            <h2 class="ml-20 pt-20"><i class="fa fa-clock-o"></i> Reserveringen</h2>


            <div class="col3in16 col alpha ml-10">
                <p>Datum</p>
            </div>
            <div class="col3in16 col between ml-10">
                <p>Begintijd - Eindtijd</p>
            </div>
            <div class="col3in16 omega ml-10">
                <p>Annuleren</p>
            </div>


        </div>

    </div>


    <?php include("../_footer.php"); ?>

</div>

</body>
</html>