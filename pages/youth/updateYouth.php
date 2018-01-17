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
     * Variabelen voor de database
     */
    $columns = array("jongereRoepnaam", "jongereTussenvoegsel", "jongereAchternaam", "jongereGeboortedatum");
    $table = "jongere";
    $where = 'jongereId';
    $id = $_GET['id'];
    $columnSort = "jongereRoepnaam";

/*UPDATE regel en zet weer in database*/
    if(isset($_POST['updaten']))
    {
        if(!empty($_POST['jongereRoepnaam']) && !empty($_POST['jongereAchternaam']) && !empty($_POST['jongereGeboortedatum']))
        {
                $values = array(htmlspecialchars($_POST['jongereRoepnaam']), htmlspecialchars($_POST['jongereTussenvoegsel']), htmlspecialchars($_POST['jongereAchternaam']), htmlspecialchars($_POST['jongereGeboortedatum']));
                echo $query->updateRow($table, $columns, $where, $values, $id);
                echo 'Het updaten is gelukt';
                header("refresh:0.5;url=overviewYouth.php");

        }


        else
        {
            echo"Niet alles is ingevuld, probeer het opnieuw";
        }

    }

    if(isset($_POST['annuleren']))
    {
        echo 'Het toevoegen is geannuleerd';
        header( "refresh:0.5;url=overviewYouth.php" );
    }

//echo $query->insertIntoTable($table, $columns, $values);
?>



    <body id="top">

        <?php

            foreach ($query->selectFromTable($table, null, $where, $id, null, null, null, $columnSort) as $value)
            {
        ?>

                <form method="post">
                    Roepnaam:
                    <input type="text" name="jongereRoepnaam" value="<?php echo $value['jongereRoepnaam'] ?>">
                    <br>
                    Tussenvoegsel:
                    <input type="text" name="jongereTussenvoegsel" value="<?php echo $value['jongereTussenvoegsel'] ?>">
                    <br>
                    Achternaam:
                    <input type="text" name="jongereAchternaam" value="<?php echo $value['jongereAchternaam'] ?>">
                    <br>
                    Geboortedatum:
                    <input type="date" name="jongereGeboortedatum" value="<?php echo $value['jongereGeboortedatum'] ?>">
                    <br>
                    <input type="submit" name="updaten" value="Updaten" style=" color:#FFFFFF; background-color:#00CCBD; border-color:transparent; padding:8px 18px 10px; text-transform:uppercase; font-weight:700; cursor:pointer;">
                    <input type="submit" name="annuleren" value="Annuleren" style=" color:#FFFFFF; background-color:#00CCBD; border-color:transparent; padding:8px 18px 10px; text-transform:uppercase; font-weight:700; cursor:pointer;">
            </form>
        <?php
                }
        ?>
    </body>
</html>
