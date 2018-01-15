<?php
    session_start();

    include '../../class/Crud.php';
    include '../../class/LoginHandler.php';

    $query = new Crud();

    //(new LoginHandler())->checkRights();

    /*
     * De variable's die er nodig zijn om de informatie te leveren om het naar de database te sturen
     */
    $columns = array("gebruikersEmail", "gebruikersWachtwoord", "gebruikersVoornaam", "gebruikersTussenvoegsel", "gebruikersAchternaam");
    $table = "gebruikers";
    $where = 'gebruikersId';
    $columnSort = "gebruikersEmail";
    $id = $_GET['id'];


    if(isset($_POST['aanmaken']))
    {
        if(!empty($_POST['gebruikersEmail'] && md5($_POST['gebruikersWachtwoord']) && $_POST['gebruikersVoornaam']&& $_POST['gebruikersTussenvoegsel']&& $_POST['gebruikersAchternaam']))
        {
            if (preg_match("/almere.nl/i", $_POST['gebruikersEmail']))
            {
                $values = array($_POST['gebruikersEmail'], md5($_POST['gebruikersWachtwoord']), $_POST['gebruikersVoornaam'], $_POST['gebruikersTussenvoegsel'], $_POST['gebruikersAchternaam']);
                echo $query->updateRow($table, $columns, $where, $values, $id);
                echo 'Het updaten is gelukt';
                header("refresh:0.5;url=overviewUsers.php");
            }

            else
            {
                echo "Gebruik uw bedrijfs email";
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