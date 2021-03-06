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
    include '../../class/Menu.php';
    (new Menu())->generateMenu();

    /*
     * De variable's die er nodig zijn om de informatie te leveren om het naar de database te sturen
     */
    $table = "instituut";
    $columnSort = "instituutNaam";
    $orderBy = "ASC";
    $where = "instituutArchief";
    $id = 0;
?>


    <body id="top">
    <a href=../institute/overviewArchivedInstitute.php>Overzicht gearchiveerde instituten</a>
        <table>
            <thead>
                <tr>
                    <th>Naam instituut</th>
                    <th>Telefoonnummer instituut</th>
                    <th>Bewerken</th>
                    <th>Archiveren</th>
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
                                <td><a href=../institute/updateInstitute.php?id=". $value['instituutId'] ."><img src='../../img/edit.png'></a></td>
                                <td><a href=../institute/archiveInstitute.php?id=". $value['instituutId'] ."><img src='../../img/archiveer.png'></a></td>
                        ";
                }
            ?>

                            </tr>
                        </tbody>
        </table>
    </body>
</html>