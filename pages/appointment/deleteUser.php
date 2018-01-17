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
 * Time: 10:13
 */

//Aanroepen van de gebruikte classes
include '../../class/Crud.php';
$query = new Crud();
include '../../class/LoginHandler.php';
session_start();

(new LoginHandler())->checkLoggedIn();



//Variables die worden gebruikt in het inserten in een database
$columnId = "gebruikersId";
$table = "gebruikers";
$id = $_GET['id'];

if (isset($_POST['Ja']))
{
    echo $query->deleteRow($table, $columnId, $id);

    header('location: overviewArchivedUsers.php');
}

if (isset($_POST['Nee']))
{
    header('location: overviewArchivedUsers.php');
}
?>




            <form method="post">
                <fieldset>

                    Weet u zeker dat u deze gebruiker wil verwijderen?
                        <br>
                    <?php
                    echo'

                        <input type="submit" value="Ja" name="Ja" style=" color:#FFFFFF; background-color:#00CCBD; border-color:transparent; padding:8px 18px 10px; text-transform:uppercase; font-weight:700; cursor:pointer;">
                        <input type="submit" value="Nee" name="Nee" style=" color:#FFFFFF; background-color:#00CCBD; border-color:transparent; padding:8px 18px 10px; text-transform:uppercase; font-weight:700; cursor:pointer;">
                    <input type="hidden" name="id" value="'. $_GET['id'] .'">
                    ';
                    ?>
                </fieldset>
            </form>
        </div>
    </div>

</body>
</html>




