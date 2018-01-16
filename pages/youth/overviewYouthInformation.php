<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../css/opmaak.css">
</head>

<?php
 /* Created by PhpStorm.
 * User: melan
 * Date: 16-1-2018
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
    $where = "jongereId";
    $id = $_GET['id'];
?>


    <body id="top">
    <?php
        foreach ($query->selectFromTable($table, null, $where, $id, null, null, $columnSort, $orderBy) as $value)
        {
            echo "<h1>".$value['jongereRoepnaam']." ".$value['jongereTussenvoegsel']." ".$value['jongereAchternaam']."</h1>";
        }
    ?>

        <table>
            <thead>
                <tr>
                    <th>Inschrijfdatum</th>
                    <th>Afgerond</th>
                    <th>Informatie overzicht</th>
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
                                <td><a href=../youth/createYouthInstitute.php?id=". $value['jongereId'] ."><img src='../../img/instituut.png'></a></td>
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