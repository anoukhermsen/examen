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

    //(new LoginHandler())->checkRights();

    /*
     * De variable's die er nodig zijn om de informatie te leveren om het naar de database te sturen
     */
    $table = "gebruikers";
    $columnSort = "gebruikersEmail";
    $orderBy = "ASC";
?>

<html>

    <body id="top">
        <table>
            <thead>
                <tr>
                    <th>Gebruikers Email</th>
                    <th>Gebruikers Voornaam</th>
                    <th>Gebruikers Tussenvoegsel</th>
                    <th>Gebruikers Achternaam</th>
                    <th>Bewerken</th>
                    <th>Archiveren</th>
                </tr>
            </thead>

            <?php
                foreach ($query->selectFromTable($table, null, null, null, null, null,  $columnSort, $orderBy) as $value)
                {
                    //$columns = array("userEmail", "userSurname", "userLastname", "userStudentNr", "userPassword", "userPhoto", "userRights");
                    echo" 
                        <tbody>
                            <tr>
                                <td>".$value['gebruikersEmail']."</td>
                                <td>".$value['gebruikersVoornaam']."</td>
                                <td>".$value['gebruikersTussenvoegsel']."</td>
                                <td>".$value['gebruikersAchternaam']."</td>
                                <td><a href=../users/updateActiviti.php?id=". $value['gebruikersId'] ."><img src='../../img/edit.png'></a></td>
                                <td><a href=../users/deleteUser.php?id=". $value['gebruikersId'] ."><img src='../../img/archiveer.png'></a></td>
                        ";
                }
            ?>

                            </tr>
                        </tbody>
        </table>
    </body>
</html>