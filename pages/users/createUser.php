<?php
    include '../../class/Crud.php';
    include '../../class/LoginHandler.php';



session_start();
    $table = "users";
    $columns = array("userEmail", "userSurname", "userLastName", "userStudentNr", "userPassword",  "userPhoto", "userCB", "userRights");




    $query = new Crud();




//Ook nieuwe invoice maken
    if(isset($_POST['aanmaken']))
    {
        if(!empty($_POST['userEmail']) && !empty($_POST['userSurname']) && !empty($_POST['userLastName']) && !empty($_POST['userStudentNr']) && !empty($_POST['userPassword']) && !empty($_POST['userPhoto']))
        {
            if (preg_match("/student.landstede.nl/i", $_POST['userEmail']))
            {
                $values = array(htmlspecialchars($_POST['userEmail']), htmlspecialchars($_POST['userSurname']), htmlspecialchars($_POST['userLastName']), htmlspecialchars($_POST['userStudentNr']), htmlspecialchars(md5($_POST['userPassword'])), htmlspecialchars($_POST['userPhoto']), htmlspecialchars($_POST['userCB']), 1);
                $query->insertIntoTable($table, $columns, $values);
                echo 'Het toevoegen is gelukt';
                header("refresh:0.5;url=overviewUsers.php");
            }

            else
            {
                echo "Gebruik uw schoolmail";
            }
        }

        else
        {
            echo"Niet alles is ingevuld, probeer het opnieuw";
        }

    }
    if(isset($_POST['annuleren']))
    {
        echo 'Het toevoegen is geannuleerd';
        header( "refresh:0.5;url=overviewUsers.php" );
    }

    //echo $query->insertIntoTable($table, $columns, $values);
?>

    <!DOCTYPE html>

    <html lang="">

    <head>
        <title>Inschrijven voor lanparty</title>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="../../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    </head>
    <body id="top">

<?php

?>
    <!-- Top Background Image Wrapper -->
    <div class="topspacer bgded overlay" style="background-image:url('../../images/demo/backgrounds/LANparty 1.png');">

        <div class="wrapper row1">
            <header id="header" class="hoc clear">

                <div id="logo" class="fl_left">
                    <h1><a href="../index.php">Lanparty</a></h1>

                </div>

                <nav id="mainav" class="fl_right">
                    <ul class="clear">
                        <li><a class="drop">Aanmaken</a>
                            <ul>
                                <li><a href="../tournooi/createTournooi.php">Toernooi toevoegen</a></li>
                            </ul>
                        </li>
                        <li><a class="drop">Overzicht</a>
                            <ul>
                                <li><a href="overviewUsers.php">Overzicht gebruikers</a></li>
                                <li><a href="../tournooi/overviewTournooi.php">Overzicht toernooi</a></li>
                                <li><a href="../participate/overviewParticipant.php">Overzicht inschrijvingen toernooi</a></li>
                                <li><a href="../application/overviewPayment.php">Overzicht betalingen</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="../logout.php">Uitloggen</a>
                        </li>
                    </ul>
                </nav>
            </header>

        </div>


        <div id="breadcrumb" class="hoc clear">

            <h6 class="heading">Inschrijven voor lanparty</h6>
            <ul>
                <li><a href="#">Inschrijven voor lanparty</a></li>
            </ul>

        </div>

    </div>
<?php

?>

    <div id="login">

        <div class="one_quarter">
            <h6 class="heading"></h6>
            <p class="btmspace-30"></p>
            <form method="post">
                <fieldset>
                <br>
                    Email:
                    <input class="btmspace-15" type="email" name="userEmail">
                    Voornaam:
                    <input class="btmspace-15"  type="text" name="userSurname">
                    Achternaam:
                    <input class="btmspace-15" type="text" name="userLastName">
                    Student nummer:
                    <input class="btmspace-15" type="text" name="userStudentNr">
                    Wachtwoord:
                    <input class="btmspace-15" type="password" name="userPassword">
                    Foto:
                    <input type="file" name="userPhoto" id="img">
                    Inschrijven voor kerstontbijt:
                    <br>
                    Ja <input type="radio" name="userCB" value="1" style=" color:#FFFFFF; background-color:#00CCBD; border-color:transparent; padding:8px 18px 10px; text-transform:uppercase; font-weight:700; cursor:pointer;">
                    Nee <input type="radio" name="userCB" value="0" style=" color:#FFFFFF; background-color:#00CCBD; border-color:transparent; padding:8px 18px 10px; text-transform:uppercase; font-weight:700; cursor:pointer;">
                    <input type="submit" name="aanmaken" value="Aanmaken" style=" color:#FFFFFF; background-color:#00CCBD; border-color:transparent; padding:8px 18px 10px; text-transform:uppercase; font-weight:700; cursor:pointer;">
                    <input type="submit" name="annuleren" value="Annuleren" style=" color:#FFFFFF; background-color:#00CCBD; border-color:transparent; padding:8px 18px 10px; text-transform:uppercase; font-weight:700; cursor:pointer;">
                </fieldset>
            </form>
        </div>
    </div>
    <!-- End Top Background Image Wrapper -->


    <a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
    <!-- JAVASCRIPTS -->
    <script src="../../layout/scripts/jquery.min.js"></script>
    <script src="../../layout/scripts/jquery.backtotop.js"></script>
    <script src="../../layout/scripts/jquery.mobilemenu.js"></script>
    </body>
    </html>




