<?php
/**
 * Created by PhpStorm.
 * User: melan
 * Date: 15-1-2018
 * Time: 13:45
 */

    include '../../class/Sql.php';
    include '../../class/LoginHandler.php';

    session_start();

    $query = new Sql();

    /*
     * Het inserten into de data base.
     * In dit stuk code is met behulp van Preg match een beveiliging er op gezet dat alleen een bepaald soort email kan worden toe gevoegt,
     * en met behulp van md5 worden de wachtwoorden beveiligd maar ook met behulp van htmlspecialchars wordt het insurten van de informatie beveiligd zodat hackers niet in de database kunnen komen.
     */
        if(isset($_POST['submit']))
        {
            if(!empty($_POST['gebruikersEmail']) && !empty($_POST['gebruikersWachtwoord']) && !empty($_POST['gebruikersVoornaam']) && !empty($_POST['gebruikersAchternaam']))
            {
                if (preg_match("/almere.nl/i", $_POST['gebruikersEmail']))
                {
                    $values = array(htmlspecialchars($_POST['gebruikersEmail']), htmlspecialchars(md5($_POST['gebruikersWachtwoord'])), htmlspecialchars($_POST['gebruikersVoornaam']), htmlspecialchars($_POST['gebruikersTussenvoegsel']), htmlspecialchars($_POST['gebruikersAchternaam']));
                    $query->insertIntoTable($table, $columns, $values);
                    echo 'Het toevoegen is gelukt';
                    header("refresh:0.5;url=overviewActiviti.php");
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

        //Het formulier waarbij je de gebruikers kunnen worden toe gevoegd
        echo '
                <form method="post">
                    Gebruikers Email:
                        <input type="text" name="gebruikersEmail">
                            <br>
                    Gebruikers Wachtwoord:
                        <input type="password" name="gebruikersWachtwoord">
                           <br>
                    Gebruikers Voornaam:
                        <input type="text" name="gebruikersVoornaam">
                            <br>
                    Gebruikers Tussenvoegsel:
                        <input type="text" name="gebruikersTussenvoegsel">
                            <br>
                    Gebruikers Achternaam:
                        <input type="text" name="gebruikersAchternaam">
                            <br>
                        <input type="submit" name="submit">
                </form>
        
        
        ';
?>



