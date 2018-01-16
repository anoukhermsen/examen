<?php
/**
 * Created by PhpStorm.
 * User: melan
 * Date: 15-1-2018
 * Time: 13:45
 */

    session_start();

    include '../../class/Sql.php';
    $query = new Sql();
    include '../../class/LoginHandler.php';


    //(new LoginHandler())->checkRights();

    /*
     * De variable's die er worden gebruikt om de gekozen gebruiker te kunnen verwijderen door middel van het gebruiken van een $_GET id
     */
    $columns = "jongereActiviteitArchief";
    $table = "jongereActiviteit";
    $where = 'jongereActiviteitId';
    $columnSort = "jongereActiviteitId";
    $id = $_GET['id'];

    if (isset($_POST['Ja']))
    {
        $values = 1;
        $query->archiveRow($table, $columns, $values, $where, $id);
        header('location:  ../youth/overviewYouth.php');
    }

    if (isset($_POST['Nee']))
    {
        header('location: ../youth/overviewYouth.php');
    }
?>

<html>
    <body>
        Weet u zeker dat u deze gebruiker wil verwijderen?
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
