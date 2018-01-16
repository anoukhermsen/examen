<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../css/opmaak.css">
</head>

<?php
/**
 * Created by PhpStorm.
 * User: Anouk Hermsen
 * Date: 15-1-2018
 * Time: 14:22
 */
    session_start();

    include '../../class/Sql.php';
    include '../../class/LoginHandler.php';


(new LoginHandler())->checkLoggedIn();


    $columns = "jongereArchief";
    $table = "jongere";
    $where = 'jongereId';
    $id = $_GET['id'];

    $query = new Sql();


    /*Archiveren of niet*/

    if (isset($_POST['Ja']))
    {

        $values = 1;
        $query->archiveRow($table, $columns, $values, $where, $id);
        echo'de gegevens worden gearchiveerd';
        header('location: overviewYouth.php');
    }

    if (isset($_POST['Nee']))
    {
        echo"de gegevens worden niet verwijderd";
        header('location: overviewYouth.php');
    }
?>


    <body>
        Weet u zeker dat u deze gebruiker wil archiveren?
        <br>

            <?php
                echo'
                    <form method="post">
                      <input type="submit" value="Ja" name="Ja">
                      <input type="submit" value="Nee" name="Nee">
                      <input type="hidden" name="id" value="'. $_GET['id'] .'">
                    </form>
                    ';
            ?>
    </body>
</html>
