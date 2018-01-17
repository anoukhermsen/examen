<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../css/opmaak.css">
</head>

<?php
/**
 * Created by PhpStorm.
 * User: Anouk Hermsen
 * Date: 16-1-2018
 * Time: 9:00
 */
    session_start();

    include '../../class/Sql.php';
    include '../../class/LoginHandler.php';


(new LoginHandler())->checkLoggedIn();


    $columns = "instituutArchief";
    $table = "instituut";
    $where = 'instituutId';
    $id = $_GET['id'];

    $query = new Sql();


    /*Archiveren of niet*/

    if (isset($_POST['Ja']))
    {

        $values = 0;
        $query->archiveRow($table, $columns, $values, $where, $id);
        echo'de gegevens worden terug gezet';
        header('location: overviewInstitute.php');
    }

    if (isset($_POST['Nee']))
    {
        echo"de gegevens worden niet verwijderd";
        header('location: overviewInstitute.php');
    }
?>


    <body>
        Weet u zeker dat u dit instituut wil terugzetten?
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
