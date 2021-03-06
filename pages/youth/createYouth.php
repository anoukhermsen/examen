<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../css/opmaak.css">
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: Anouk Hermsen
 * Date: 15-1-2018
 * Time: 14:22
 */
session_start();
    include '../../class/Crud.php';
    $query = new Crud();
    include '../../class/LoginHandler.php';
    (new LoginHandler())->checkLoggedIn();
    include '../../class/Menu.php';
    (new Menu())->generateMenu();


    /*
         Variabelen voor de database
     */
    $table = "jongere";
    $columns = array("jongereRoepnaam", "jongereTussenvoegsel", "jongereAchternaam", "jongereGeboortedatum");





    /*
     INSERT INTO DATABASE.
    */
        if(isset($_POST['aanmaken']))
        {
            if(!empty($_POST['jongereRoepnaam']) && !empty($_POST['jongereAchternaam']) && !empty($_POST['jongereGeboortedatum']))
            {
                $date = new DateTime($_POST['jongereGeboortedatum']);
                $leeftijd = date('Y') - $date->format('Y');

                if ($leeftijd >= 12)
                {
                    $values = array(htmlspecialchars($_POST['jongereRoepnaam']), htmlspecialchars($_POST['jongereTussenvoegsel']), htmlspecialchars($_POST['jongereAchternaam']), htmlspecialchars($_POST['jongereGeboortedatum']));
                    $query->insertIntoTable($table, $columns, $values);
                    echo 'Het toevoegen is gelukt';
                    header("refresh:0.5;url=overviewYouth.php");
                }

                if ($leeftijd < 12)
                {
                    echo "De jongere moet minimaal 12 jaar oud zijn";
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
            //header( "refresh:0.5;url=overviewUsers.php" );
        }


//Formulier jongere toevoegen

        echo '

                <form method="post">
                    Roepnaam:
                        <input type="text" name="jongereRoepnaam">
                            <br>
                    Tussenvoegsel:
                        <input type="text" name="jongereTussenvoegsel">
                           <br>
                    Achternaam:
                        <input type="text" name="jongereAchternaam">
                            <br>
                    Geboortedatum:
                        <input type="date" name="jongereGeboortedatum">
                            <br>
                        <input type="submit" name="aanmaken" value="aanmaken">
                        <input type="submit" name="annuleren" value="annuleren">
                </form>
        
        
        ';
?>



</body>
</html>