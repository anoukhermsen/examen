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

    /*
     * De variable's die er nodig zijn om de informatie te leveren om het naar de database te sturen
     */
    $table = "activiteit";
    $columnSort = "activiteitId";
    $orderBy = "ASC";
?>

<html>

    <body id="top">
        <table>
            <thead>
                <tr>
                    <th>Activiteits Naam</th>
                    <th>Activiteits Startdatum</th>
                    <th>Bewerken</th>
                    <th>Archiveren</th>
                </tr>
            </thead>

            <?php
                foreach ($query->selectFromTable($table, null, null, null, null, null,  $columnSort, $orderBy) as $value)
                {
                    /*
                     * Het genereren van de datum van het Engelse/Amerikaanse begrip naar het Nederlands
                     */
                    $myDateTime = DateTime::createFromFormat('Y-m-d', $value['activiteitStartdatum']);
                    $newDateString = $myDateTime->format('d-m-Y');
                    //$columns = array("userEmail", "userSurname", "userLastname", "userStudentNr", "userPassword", "userPhoto", "userRights");
                    echo" 
                        <tbody>
                            <tr>
                                <td>".$value['activiteitNaam']."</td>
                                <td>".$newDateString."</td>
                                <td><a href=../activiti/setbackActiviti.php?id=". $value['activiteitId'] ."><img src='../../img/back.png'></a></td>
                                <td><a href=../activiti/deleteActiviti.php?id=". $value['activiteitId'] ."><img src='../../img/delete.png'></a></td>
                        ";
                }
            ?>

                            </tr>
                        </tbody>
        </table>
    </body>
</html>