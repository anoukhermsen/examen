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
    session_start();
    include '../../class/Crud.php';
    $query = new Crud();
    include '../../class/LoginHandler.php';
    (new LoginHandler())->checkLoggedIn();
    include '../../class/Menu.php';
    (new Menu())->generateMenu();


    //Variables die worden gebruikt in het inserten in een database
    $columnId = "instituutId";
    $table = "instituut";
    $id = $_GET['id'];

    if (isset($_POST['Ja']))
    {
        echo $query->deleteRow($table, $columnId, $id);

        header('location: overviewArchivedInstitute.php');
    }

    if (isset($_POST['Nee']))
    {
        header('location: overviewArchivedInstitute.php');
    }
    ?>




            <form method="post">

                    Weet u zeker dat u dit instituut wil verwijderen?
                        <br>
                    <?php
                    echo'

                        <input type="submit" value="Ja" name="Ja">
                        <input type="submit" value="Nee" name="Nee">
                    <input type="hidden" name="id" value="'. $_GET['id'] .'">
                    ';
                    ?>
            </form>
        </div>
    </div>

</body>
</html>




