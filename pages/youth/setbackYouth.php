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

    include '../../class/Sql.php';
    include '../../class/LoginHandler.php';


(new LoginHandler())->checkLoggedIn();

    /*
     * De variable's die er worden gebruikt om de gekozen gebruiker te kunnen verwijderen door middel van het gebruiken van een $_GET id
     */
    $columns = "jongereArchief";
    $table = "jongere";
    $where = 'jongereId';

    $id = $_GET['id'];

    $query = new Sql();

    if (isset($_POST['Ja']))
    {
        $values = 0;
        $query->archiveRow($table, $columns, $values, $where, $id);
        header('location: overviewYouth.php');
    }

    if (isset($_POST['Nee']))
    {
        header('location: overviewYouth.php');
    }
?>


Weet u zeker dat u deze jongere wil terugzetten?
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
