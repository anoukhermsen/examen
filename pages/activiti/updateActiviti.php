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

    $query = new Crud();

    //(new LoginHandler())->checkRights();

    /*
     * De variable's die er nodig zijn om de informatie te leveren om het naar de database te sturen
     */
    $columns = array("activiteitNaam", "activiteitStartdatum");
    $table = "activiteit";
    $where = 'activiteitId';
    $columnSort = "activiteitId";
    $id = $_GET['id'];


    if(isset($_POST['aanmaken']))
    {
        if(!empty($_POST['activiteitNaam'] && md5($_POST['activiteitStartdatum'])))
        {
            $values = array($_POST['activiteitNaam'], $_POST['activiteitStartdatum']);
            echo $query->updateRow($table, $columns, $where, $values, $id);
            echo 'Het updaten is gelukt';
            header("refresh:0.5;url=overviewActiviti.php");
        }

        else
        {
            echo"Niet alles is ingevuld, probeer het opnieuw";
        }

    }

    if(isset($_POST['annuleren']))
    {
        echo 'Het toevoegen is geannuleerd';
        header( "refresh:0.5;url=overviewActiviti.php" );
    }

//echo $query->insertIntoTable($table, $columns, $values);
?>

<html>

    <body id="top">

        <?php

            foreach ($query->selectFromTable($table, null, $where, $id, null, null, null, $columnSort) as $value)
            {
        ?>

            <form method="post">
                    <br>
                    Gebruikers Email:
                        <input type='email' name='gebruikersEmail' value='<?php $value['gebruikersEmail'] ?>'>
                            </br>
                    Wachtwoord:
                        <input type='password' name='gebruikersWachtwoord' value='<?php echo $value['gebruikersWachtwoord'] ?>'>
                            </br>
                    Gebruikers Voornaam:
                        <input type='text' name='gebruikersVoornaam' value='<?php echo $value['gebruikersVoornaam'] ?>'>
                            </br>
                    Gebruikers Tussenvoegsel:
                        <input type='text' name='gebruikersTussenvoegsel' value='<?php echo $value['gebruikersTussenvoegsel'] ?>'>
                            </br>
                    Profiel Achternaam:
                        <input type='text' name='gebruikersAchternaam' value='<?php echo $value['gebruikersAchternaam'] ?>'>
                            </br>

                    <br>
                    <input type="submit" name="aanmaken" value="Updaten" style=" color:#FFFFFF; background-color:#00CCBD; border-color:transparent; padding:8px 18px 10px; text-transform:uppercase; font-weight:700; cursor:pointer;">
                    <input type="submit" name="annuleren" value="Annuleren" style=" color:#FFFFFF; background-color:#00CCBD; border-color:transparent; padding:8px 18px 10px; text-transform:uppercase; font-weight:700; cursor:pointer;">
            </form>
        <?php
                }
        ?>