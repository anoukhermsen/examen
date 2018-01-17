<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../css/opmaak.css">
</head>

<?php
/**
 * Created by PhpStorm.
 * User: Anouk Hermsen
 * Date: 16-1-2018
 * Time: 9:00
 */
    session_start();

    include '../../class/Crud.php';
    $query = new Crud();
    include '../../class/LoginHandler.php';

(new LoginHandler())->checkLoggedIn();

    /*
     * De variable's die er nodig zijn om de informatie te leveren om het naar de database te sturen
     */
    $table = "jongereinstituut";
    $columnSort = "instituutId";
    $orderBy = "ASC";
    $where = "jongereInstituutArchief";
    $id = 1;
?>


    <body id="top">
    <a href=../youthInstitute/overviewYouthInstitute.php>Overzicht jongere</a>
        <table>
            <thead>
                <tr>
                    <th>Naam instituut</th>
                    <th>Telefoonnummer instituut</th>
                    <th>Terugzetten</th>
                    <th>Verwijderen</th>
                </tr>
            </thead>

            <?php
                foreach ($query->selectFromTable($table, null, $where, $id, null, null,  $columnSort, $orderBy) as $value)
                {
                    echo" 
                        <tbody>
                            <tr>
                                <td>".$value['instituutNaam']."</td>
                                <td>".$value['instituutTel']."</td>
                                <td><a href=../youthInstitute/setbackYouthInstitute.php?id=". $value['instituutId'] ."><img src='../../img/back.png'></a></td>
                                <td><a href=../youthInstitute/deleteYouthInstitute.php?id=". $value['instituutId'] ."><img src='../../img/delete.png'></a></td>
                        ";
                }
            ?>

                            </tr>
                        </tbody>
        </table>
    </body>
</html>