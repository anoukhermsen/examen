<?php
/**
 * Created by PhpStorm.
 * User: melan
 * Date: 15-1-2018
 * Time: 13:45
 */
session_start();
    include '../../class/Crud.php';
    $query = new Crud();
    include '../../class/LoginHandler.php';
    (new LoginHandler())->checkLoggedIn();
    include '../../class/Menu.php';
    (new Menu())->generateMenu();





    /*
     * De variable's die er nodig zijn om de informatie te leveren om het naar de database te sturen
     */
    $table = "activiteit";
    $columns = array("activiteitNaam", "activiteitStartdatum");



    /*
     * Het inserten into de data base.
     * In dit stuk code is met behulp van Preg match een beveiliging er op gezet dat alleen een bepaald soort email kan worden toe gevoegt,
     * en met behulp van md5 worden de wachtwoorden beveiligd maar ook met behulp van htmlspecialchars wordt het insurten van de informatie beveiligd zodat hackers niet in de database kunnen komen.
     */
        if(isset($_POST['submit']))
        {
            if(!empty($_POST['activiteitNaam']) && !empty($_POST['activiteitStartdatum']))
            {
                $values = array(htmlspecialchars($_POST['activiteitNaam']), ($_POST['activiteitStartdatum']));
                $query->insertIntoTable($table, $columns, $values);
                echo 'Het toevoegen is gelukt';
                header("refresh:0.5;url=overviewActiviti.php");
            }

            else
            {
                echo"Niet alles is ingevuld, probeer het opnieuw";
            }

        }

        //Het formulier waarbij je de gebruikers kunnen worden toe gevoegd
        echo '
                <form method="post">
                    Activiteits Naam:
                        <input type="text" name="activiteitNaam">
                            <br>
                    Begin datum:
                        <input type="date" name="activiteitStartdatum">
                           <br>
                        <input type="submit" name="submit">
                </form>
        
        
        ';
?>



