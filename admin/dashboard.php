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

        <div id="dashboard" class="frame_light clearfix">

            <h2 class="ml-20 pt-20"><i class="fa fa-dashboard"></i> Dashboard</h2>

            <div class="col8 col alpha">
                <div class="row ml-20 mr-20 mt-20">
                    <div class="fdb">
                        <p>
                            Bedrijven<br>
                        </p>
                    </div>

                    <p>
                        <a href="<?php echo $root; ?>admin/bedrijf/index.php">
                            <img src="<?php echo $root; ?>img/bedrijf.png" height="200"/>
                        </a>
                    </p>
                </div>
                <div class="row ml-20 mr-20 mt-20">

                        <ul class="dashboard_menu">
                            <li>
                                <a class="btn" href="<?php echo $root; ?>admin/bedrijf/create.php">Nieuw bedrijf</a>
                            </li>
                            <li>
                                <a class="btn" href="<?php echo $root; ?>admin/bedrijf/delete.php">Uitschrijven</a>
                            </li>
                            <li>
                                <a class="btn" href="<?php echo $root; ?>admin/reservation.php?placer=bedrijf">Reservering plaatsen</a>
                            </li>
                            <li>
                                <a class="btn" href="<?php echo $root; ?>admin/bedrijf/boten.php">Boten</a>
                            </li>
                        </ul>

                </div>
            </div>
            <div class="col8 col omega">
                <div class="row ml-20 mr-20 mt-20">
                    <div class="fdb">
                        <p>
                            Scholen<br>
                        </p>
                    </div>

                    <p>
                        <a href="<?php echo $root; ?>admin/school/index.php">
                            <img src="<?php echo $root; ?>img/school.png" height="200"/>
                        </a>
                    </p>
                </div>
                <div class="row ml-20 mr-20 mt-20">

                        <ul>
                            <li>
                                <a class="btn" href="<?php echo $root; ?>admin/school/create.php">Nieuwe school</a>
                            </li>
                            <li>
                                <a class="btn" href="<?php echo $root; ?>admin/reservation.php?placer=school">Reservering plaatsen</a>
                            </li>
                            <li>
                                <a class="btn" href="<?php echo $root; ?>admin/school/show.php">Scholen</a>
                            </li>
                        </ul>


                </div>
            </div>
        </div>

        <div class="frame">
            <h2>Content</h2>
        </div>

    </div>


    <?php include("../_footer.php"); ?>

</div>

</body>
</html>