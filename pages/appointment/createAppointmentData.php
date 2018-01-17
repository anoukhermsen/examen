<?php
/**
 * Created by PhpStorm.
 * User: melan
 * Date: 17-1-2018
 * Time: 11:45
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
    $table = "jongereafspraak";
    $columns = array("jongereId", "gebruikersId", "jongereAfspraakBesch", "jongereAfspraakdatum");



    /*
     * Het inserten into de data base.
     * In dit stuk code is met behulp van Preg match een beveiliging er op gezet dat alleen een bepaald soort email kan worden toe gevoegt,
     * en met behulp van md5 worden de wachtwoorden beveiligd maar ook met behulp van htmlspecialchars wordt het insurten van de informatie beveiligd zodat hackers niet in de database kunnen komen.
     */
        if(isset($_POST['submit']))
        {
            if(!empty($_POST['jongereBesch']) && !empty($_POST['jongereAfspraakdatum']))
            {
                    $values = array($_GET['id'], $_SESSION['gebruikersId'], htmlspecialchars($_POST['jongereBesch']), htmlspecialchars($_POST['jongereAfspraakdatum']));
                    $query->insertIntoTable($table, $columns, $values);
                    echo 'Het toevoegen is gelukt';
                    header("refresh:0.5;url=../youth/overviewArchivedYouth.php");
            }

            else
            {
                echo"Niet alles is ingevuld, probeer het opnieuw";
            }

        }

        //Het formulier waarbij je de gebruikers kunnen worden toe gevoegd
        echo '
                <form method="post">
                    Beschrijving van het gesprek:<br>
                        <textarea name="jongereBesch" cols="25" rows="5"></textarea>
                            <br>
                    Datum van afspraak:
                        <input type="date" name="jongereAfspraakdatum">
                            <br>
                        <input type="submit" name="submit">
                </form>
        
        
        ';
?>



