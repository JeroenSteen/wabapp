<?php
include("app/config.php");
include("app/db.php");
?>

<!DOCTYPE html>
<?php include("_html.php"); ?>
<head>

    <title>Wab APP</title>
    <meta name="description" content="">

    <?php include("_head.php"); ?>
</head>
<body>


<div class="container">

    <?php include("_header.php"); ?>

    <div class="col16 col mt-20">
        <div class="frame">



            <div class="fdb">
                <p>
                    Welkom bij de app van de Willem Alexander baan.<br>
                </p>
            </div>

            <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                <fieldset>
                    <legend>
                        Inloggen <i class="fa fa-key"></i>
                    </legend>
                    <label for="email">E-Mail</label>
                    <input type="email" name="email" id="email" autofocus/>
                    <label for="">Wachtwoord</label>
                    <input type="password" name="pass" id="pass"/><br>

                    <input class="btn" type="submit" name="inloggen" value="Inloggen"/>
                </fieldset>
            </form>




        </div>
    </div>

<?php include("_footer.php"); ?>

</div>

</body>
</html>