<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../css/opmaak.css">
</head>
<?php
/**
 * Created by PhpStorm.
 * User: Anouk Hermsen
 * Date: 16-1-2018
 * Time: 10:10
 */


    session_start();

    include '../../class/Crud.php';
    $query = new Crud();
    include '../../class/LoginHandler.php';

(new LoginHandler())->checkLoggedIn();

    /*
     * De variable's die er nodig zijn om de informatie te leveren om het naar de database te sturen
     */
    $table = "gebruikers";
    $columnSort = "gebruikersEmail";
    $orderBy = "ASC";
    $where = "gebruikersArchief";
    $id = 1;
?>



    <body id="top">

    <a href=../users/overviewUsers.php>Overzicht gebruikers</a>
        <table>
            <thead>
                <tr>
                    <th>Gebruikers Email</th>
                    <th>Gebruikers Voornaam</th>
                    <th>Gebruikers Tussenvoegsel</th>
                    <th>Gebruikers Achternaam</th>
                    <th>Terugzetten</th>
                    <th>Verwijderen</th>
                </tr>
            </thead>

            <?php
            /* SELECT * FROM 'gebruikers' WHERE 'gebruikersArchief' = 0*/
                foreach ($query->selectFromTable($table, null, $where, $id, null, null, $columnSort, $orderBy) as $value)
                {
                    //$columns = array("userEmail", "userSurname", "userLastname", "userStudentNr", "userPassword", "userPhoto", "userRights");
                    echo" 
                        <tbody>
                            <tr>
                                <td>".$value['gebruikersEmail']."</td>
                                <td>".$value['gebruikersVoornaam']."</td>
                                <td>".$value['gebruikersTussenvoegsel']."</td>
                                <td>".$value['gebruikersAchternaam']."</td>
                                <td><a href=../users/setbackUser.php?id=". $value['gebruikersId'] ."><img src='../../img/back.png'></a></td>
                                <td><a href=../users/deleteUser.php?id=". $value['gebruikersId'] ."><img src='../../img/delete.png'></a></td>
                        ";
                }
            ?>

                            </tr>
                        </tbody>
        </table>
    </body>
</html>