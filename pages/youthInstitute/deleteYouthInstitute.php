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

session_start();
//Aanroepen van de gebruikte classes
include '../../class/Crud.php';
$query = new Crud();
include '../../class/LoginHandler.php';
(new LoginHandler())->checkLoggedIn();
include '../../class/Menu.php';
(new Menu())->generateMenu();

//Variables die worden gebruikt in het inserten in een database
$columnId = "instituutId";
$table = "jongereinstituut";
$id = $_GET['id'];

if (isset($_POST['Ja']))
{
    echo $query->deleteRow($table, $columnId, $id);

    header('location: overviewArchivedYouthInstitute.php');
}

if (isset($_POST['Nee']))
{
    header('location: overviewArchivedYouthInstitute.php');
}
?>




            <form method="post">
                <fieldset>

                    Weet u zeker dat u deze jongere wil verwijderen?
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

</body>
</html>




