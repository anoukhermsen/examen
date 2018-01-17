<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../css/opmaak.css">
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: melan
 * Date: 15-1-2018
 * Time: 13:45
 */

    session_start();

    include '../../class/Crud.php';
    $query = new Crud();

    include '../../class/LoginHandler.php';
    (new LoginHandler())->checkLoggedIn();

    include '../../class/Sql.php';
    $sql = new Sql();

    include '../../class/Menu.php';
    (new Menu())->generateMenu();
    /*
     * De variable's die er nodig zijn om de informatie te leveren om het naar de database te sturen
     */
    $table = "jongereafspraak";
    $columnSort = "jongereAfspraakId";
    $orderBy = "ASC";
    $where = "jongereId";
    $id = $_GET['id'];
    $gebruikersId = $_SESSION['gebruikersId'];
?>


        <table>
            <thead>
                <tr>
                    <th>Medewerker</th>
                    <th>Afspraaks aantekeningen</th>
                    <th>Datum van afspraak</th>
                </tr>
            </thead>

            <?php
            /* SELECT * FROM 'gebruikers' WHERE 'gebruikersArchief' = 0*/
                foreach ($sql->joinJongereAfspraak($id, $gebruikersId) as $value)
                {
                    $myDate = DateTime::createFromFormat('Y-m-d', $value['jongereAfspraakdatum']);
                    $newDateString = $myDate->format('d-m-Y');

                    //$columns = array("userEmail", "userSurname", "userLastname", "userStudentNr", "userPassword", "userPhoto", "userRights");
                    echo" 
                        <tbody>
                            <tr>
                                <td>".$value['gebruikersVoornaam']."</td>
                                <td>".$value['jongereAfspraakBesch']."</td>
                                <td>".$newDateString."</td>
                        ";
                }
            ?>

                            </tr>
                        </tbody>
        </table>
    </body>
</html>