<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../css/opmaak.css">
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: Anouk Hermsen
 * Date: 16-1-2018
 * Time: 9:00
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
    $table = "instituut";
    $columns = array("instituutNaam", "instituutTel");





    /*
     INSERT INTO DATABASE.
    */
        if(isset($_POST['aanmaken']))
        {
            if(!empty($_POST['instituutNaam']) && !empty($_POST['instituutTel']))
            {
                    $values = array(htmlspecialchars($_POST['instituutNaam']), htmlspecialchars($_POST['instituutTel']));
                    $query->insertIntoTable($table, $columns, $values);
                    echo 'Het toevoegen is gelukt';
                    header("refresh:0.5;url=overviewInstitute.php");


            }

            else
            {
                echo"Niet alles is ingevuld, probeer het opnieuw";
            }

        }

        if(isset($_POST['annuleren']))
        {
            echo 'Het toevoegen is geannuleerd';
            header( "refresh:0.5;url=overviewInstitute.php" );
        }


//Formulier jongere toevoegen

        echo '

                <form method="post">
                    Naam instituut:
                        <input type="text" name="instituutNaam">
                            <br>
                    Telefoonnummer instituut:
                        <input type="tel" name="instituutTel">
                           <br>
                        <input type="submit" name="aanmaken" value="aanmaken">
                        <input type="submit" name="annuleren" value="annuleren">
                </form>
        
        
        ';
?>



</body>
</html>