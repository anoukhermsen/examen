<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../css/opmaak.css">
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: melan
 * Date: 15-1-2018
 * Time: 13:45
 */

    session_start();

    include '../../class/Crud.php';
    include '../../class/LoginHandler.php';
    include '../../class/sql.php';

    $query = new Crud();

(new LoginHandler())->checkLoggedIn();

    /*
     * De variable's die er nodig zijn om de informatie te leveren om het naar de database te sturen
     */
    $columns = array("activiteitAfgerond");
    $table = "jongereactiviteit";
    $where = 'jongereId';
    $id = $_GET['id'];



    if(isset($_POST['updaten']))
    {
        if(!isset($_POST['Afgerond']))
            {
                echo "vul ja of nee in";
            }

            elseif(isset($_POST['Afgerond']))
            {
                //Werkt niet
                $values = array($_POST['Afgerond']);
                echo $query->updateRow($table, $columns, $where, $values, $id);
                header( "refresh:0.5;url=../youth/overviewYouthInformation.php?id='$id'");


                echo "gelukt";
            }

    }




    if(isset($_POST['annuleren']))
    {
        echo 'Het updaten is geannuleerd';
        header( "refresh:0.5;url=../youth/overviewYouthInformation.php?id='$id'");
    }

//echo $query->insertIntoTable($table, $columns, $values);
?>

<html>

    <body id="top">

        <?php

                echo "<form method='post'>

                    <br>
                    Afgerond:<br>
                    Ja <input type='radio' name='Afgerond' value='1'>
                    Nee <input type='radio' name='Afgerond' value='0'>
                    <br>
                    <input type='submit' name='updaten' value='updaten'>
                    <input type='submit' name='annuleren' value='annuleren'> 
                    </form>
                    ";
