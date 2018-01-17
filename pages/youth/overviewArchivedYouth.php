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
(new LoginHandler())->checkLoggedIn();

include '../../class/Sql.php';
$sql = new Sql();

/*
 * De variable's die er nodig zijn om de informatie te leveren om het naar de database te sturen
 */
$table = "jongere";
$columnSort = "jongereRoepnaam";
$orderBy = "ASC";
$where = "jongereArchief";
$id = 1;
?>


<body id="top">
<a href=../youth/overviewYouth.php>Overzicht jongere</a>
<table>
    <thead>
    <tr>
        <th>Roepnaam</th>
        <th>Tussenvoegsel</th>
        <th>Achternaam</th>
        <th>Geboortedatum</th>
        <th>Inschrijfdatum</th>
        <th>Uitschrijfdatum</th>
        <th>Afspraken aanvragen</th>
        <th>Afspraken overzicht</th>
        <th>Terugzetten</th>
        <th>Verwijderen</th>
        <th>Aantal jongere</th>
    </tr>
    </thead>

    <?php
    foreach ($query->selectFromTable($table, null, $where, $id, null, null, $columnSort, $orderBy) as $value)
    {
        /**Veranderen van amerikaanse datum naar nederlands
         * Van 2001-01-02 naar 02-01-2001*/
        $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $value['jongereInschrijfdatum']);
        $newDateTimeString = $myDateTime->format('d-m-Y H:i:s');

        $myDateTimeUitschrijf = DateTime::createFromFormat('Y-m-d', $value['jongereUitschrijfdatum']);
        $newDateTimeStringUitschrijf = $myDateTimeUitschrijf->format('d-m-Y');

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
                                <td>".$newDateTimeStringUitschrijf."</td>
                                <td><a href=../appointment/createAppointmentData.php?id=". $value['jongereId'] ."><img src='../../img/inschrijven.png'></a></td>
                                <td><a href=../appointment/overviewAppointment.php?id=". $value['jongereId'] ."><img src='../../img/info.png'></a></td>
                                <td><a href=../youth/setbackYouth.php?id=". $value['jongereId'] ."><img src='../../img/back.png'></a></td>
                                <td><a href=../youth/deleteYouth.php?id=". $value['jongereId'] ."><img src='../../img/delete.png'></a></td>
                                
                        ";
    }
                       echo" 
                                <td>".(new Sql())->teltAantalJongeren($id)."</a></td>
                           ";
    ?>

    </tr>
    </tbody>
</table>
</body>
</html>