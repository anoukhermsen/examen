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
    include '../../class/LoginHandler.php';

    $query = new Crud();

    //(new LoginHandler())->checkRights();

    /*
     * Variabelen voor de database
     */
    $columns = array("instituutNaam", "instituutTel");
    $table = "instituut";
    $where = 'instituutId';
    $id = $_GET['id'];
    $columnSort = "instituutNaam";

/*UPDATE regel en zet weer in database*/
    if(isset($_POST['updaten']))
    {
        if(!empty($_POST['instituutNaam']) && !empty($_POST['instituutTel']))
        {
                $values = array(htmlspecialchars($_POST['instituutNaam']), htmlspecialchars($_POST['instituutTel']));
                echo $query->updateRow($table, $columns, $where, $values, $id);
                echo 'Het updaten is gelukt';
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

//echo $query->insertIntoTable($table, $columns, $values);
?>



    <body id="top">

        <?php

            foreach ($query->selectFromTable($table, null, $where, $id, null, null, null, $columnSort) as $value)
            {
        ?>

                <form method="post">
                    Naam instituut:
                    <input type="text" name="instituutNaam" value="<?php echo $value['instituutNaam'] ?>">
                    <br>
                    Telefoonnummer instituut:
                    <input type="tel" name="instituutTel" value="<?php echo $value['instituutTel'] ?>">
                    <br>
                    <input type="submit" name="updaten" value="Updaten" style=" color:#FFFFFF; background-color:#00CCBD; border-color:transparent; padding:8px 18px 10px; text-transform:uppercase; font-weight:700; cursor:pointer;">
                    <input type="submit" name="annuleren" value="Annuleren" style=" color:#FFFFFF; background-color:#00CCBD; border-color:transparent; padding:8px 18px 10px; text-transform:uppercase; font-weight:700; cursor:pointer;">
            </form>
        <?php
                }
        ?>
    </body>
</html>
