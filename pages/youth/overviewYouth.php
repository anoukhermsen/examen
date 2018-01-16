<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../css/opmaak.css">
</head>

<?php
/**
 * Created by PhpStorm.
 * User: Anouk Hermsen
 * Date: 15-1-2018
 * Time: 14:22
 */
    session_start();

    include '../../class/Crud.php';
    $query = new Crud();
    include '../../class/LoginHandler.php';

    //(new LoginHandler())->checkRights();

    /*
     * De variable's die er nodig zijn om de informatie te leveren om het naar de database te sturen
     */
    $table = "jongere";
    $columnSort = "jongereRoepnaam";
    $orderBy = "ASC";
    $where = "jongereArchief";
    $id = 0;
?>


    <body id="top">
        <table>
            <thead>
                <tr>
                    <th>Roepnaam</th>
                    <th>Tussenvoegsel</th>
                    <th>Achternaam</th>
                    <th>Geboortedatum</th>
                    <th>Inschrijfdatum</th>
                    <th>Inschrijven voor een Activiteit</th>
                    <th>Inschrijven voor een Instituut</th>
                    <th>Bewerken</th>
                    <th>Archiveren</th>
                </tr>
            </thead>

            <?php
                foreach ($query->selectFromTable($table, null, $where, $id, null, null, $columnSort, $orderBy) as $value)
                {
                    /**Veranderen van amerikaanse datum naar nederlands
                     * Van 2001-01-02 naar 02-01-2001*/
                    $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $value['jongereInschrijfdatum']);
                    $newDateTimeString = $myDateTime->format('d-m-Y H:i:s');
                    $myDate = DateTime::createFromFormat('Y-m-d', $value['jongereGeboortedatum']);
                    $newDateString = $myDate->format('d-m-Y');
                    echo" 
                        <tbody>
                            <tr>
                                <td>".$value['jongereRoepnaam']."</td>
                                <td>".$value['jongereTussenvoegsel']."</td>
                                <td>".$value['jongereAchternaam']."</td>
                                <td>".$newDateString."</td>
                                <td>".$newDateTimeString."</td>
                                <td><a href=../youthActiviti/createYouthActiviti.php?id=". $value['jongereId'] ."><img src='../../img/inschrijven.png'></a></td>
                                <td><a href=../youthInstitute/createYouthInstitute.php?id=". $value['jongereId'] ."><img src='../../img/instituut.png'></a></td>
                                <td><a href=../youth/updateYouth.php?id=". $value['jongereId'] ."><img src='../../img/edit.png'></a></td>
                                <td><a href=../youth/archiveYouth.php?id=". $value['jongereId'] ."><img src='../../img/archiveer.png'></a></td>
                                
                        ";
                }
            ?>

                            </tr>
                        </tbody>
        </table>
    </body>
</html>