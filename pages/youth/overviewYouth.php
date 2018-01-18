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
    include '../../class/Sql.php';
    $sql = new Sql();
    include '../../class/LoginHandler.php';
    (new LoginHandler())->checkLoggedIn();
    include '../../class/Menu.php';
    (new Menu())->generateMenu();

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
    <a href=../youth/overviewArchivedYouth.php>Overzicht gearchiveerde jongere</a>

        <form method="post">
            <input type="submit" name="showAll" value="toon allemaal">
            <input type="submit" name="minderJarig" value="tot 18">
            <input type="submit" name="meerderJarig" value="vanaf 18">
        </form>

        <table>
            <thead>
                <tr>
                    <th>Roepnaam</th>
                    <th>Tussenvoegsel</th>
                    <th>Achternaam</th>
                    <th>Leeftijd</th>
                    <th>Inschrijfdatum</th>
                    <th>Inschrijven voor een Activiteit</th>
                    <th>Inschrijven voor een Instituut</th>
                    <th>Informatie overzicht</th>
                    <th> </th>
                    <th>Bewerken</th>
                    <th>Archiveer</th>
                </tr>
            </thead>

            <?php
            if (isset($_POST['minderJarig']))
            {
                foreach ($sql->leeftijdBerekenenMinderJarig() as $value)
                {
                    /**Veranderen van amerikaanse datum naar nederlands
                     * Van 2001-01-02 naar 02-01-2001*/
                    $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $value['jongereInschrijfdatum']);
                    $newDateTimeString = $myDateTime->format('d-m-Y H:i:s');

                    /*
                     * Het omzetten van de datum van geboorte naar de leeftijd zelf
                     */
                    $dateOfBirth = $value['jongereGeboortedatum'];
                    $today = date("Y-m-d");
                    $diff = date_diff(date_create($dateOfBirth), date_create($today));

                    echo " 
                        <tbody>
                            <tr>
                                <td>" . $value['jongereRoepnaam'] . "</td>
                                <td>" . $value['jongereTussenvoegsel'] . "</td>
                                <td>" . $value['jongereAchternaam'] . "</td>
                                <td>" . $diff->format('%y') . "</td>
                                <td>" . $newDateTimeString . "</td>
                                <td><a href=../youthActiviti/createYouthActiviti.php?id=" . $value['jongereId'] . "><img src='../../img/inschrijven.png'></a></td>
                                <td><a href=../youthInstitute/createYouthInstitute.php?id=" . $value['jongereId'] . "><img src='../../img/instituut.png'></a></td>
                                <td><a href=../youth/overviewYouthInformation.php?id=" . $value['jongereId'] . "><img src='../../img/info.png'></a></td>
                                <td></td>
                                <td><a href=../youth/updateYouth.php?id=" . $value['jongereId'] . "><img src='../../img/edit.png'></a></td>
                                <td><a href=../youth/archiveYouth.php?id=" . $value['jongereId'] . "><img src='../../img/archiveer.png'></a></td>
                                
                                
                        ";
                }
            }

            elseif (isset($_POST['meerderJarig']))
            {
                foreach ($sql->leeftijdBerekenenMeerderJarig() as $value)
                {
                    /**Veranderen van amerikaanse datum naar nederlands
                     * Van 2001-01-02 naar 02-01-2001*/
                    $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $value['jongereInschrijfdatum']);
                    $newDateTimeString = $myDateTime->format('d-m-Y H:i:s');

                    /*
                     * Het omzetten van de datum van geboorte naar de leeftijd zelf
                     */
                    $dateOfBirth = $value['jongereGeboortedatum'];
                    $today = date("Y-m-d");
                    $diff = date_diff(date_create($dateOfBirth), date_create($today));

                    echo " 
                        <tbody>
                            <tr>
                                <td>" . $value['jongereRoepnaam'] . "</td>
                                <td>" . $value['jongereTussenvoegsel'] . "</td>
                                <td>" . $value['jongereAchternaam'] . "</td>
                                <td>" . $diff->format('%y') . "</td>
                                <td>" . $newDateTimeString . "</td>
                                <td><a href=../youthActiviti/createYouthActiviti.php?id=" . $value['jongereId'] . "><img src='../../img/inschrijven.png'></a></td>
                                <td><a href=../youthInstitute/createYouthInstitute.php?id=" . $value['jongereId'] . "><img src='../../img/instituut.png'></a></td>
                                <td><a href=../youth/overviewYouthInformation.php?id=" . $value['jongereId'] . "><img src='../../img/info.png'></a></td>
                                <td></td>
                                <td><a href=../youth/updateYouth.php?id=" . $value['jongereId'] . "><img src='../../img/edit.png'></a></td>
                                <td><a href=../youth/archiveYouth.php?id=" . $value['jongereId'] . "><img src='../../img/archiveer.png'></a></td>
                                
                                
                        ";
                }
            }

            else
            {
                echo "Totaal aantal jongeren: ".(new Sql())->teltAantalJongeren($id);
                foreach ($query->selectFromTable($table, null, $where, $id, null, null, $columnSort, $orderBy) as $value)
                {
                    /*
                     * Het omzetten van de datum van geboorte naar de leeftijd zelf
                     */
                    $dateOfBirth = $value['jongereGeboortedatum'];
                    $today = date("Y-m-d");
                    $diff = date_diff(date_create($dateOfBirth), date_create($today));
                    
                    /*
                     * Veranderen van amerikaanse datum naar nederlands
                     * Van 2001-01-02 naar 02-01-2001
                     */
                    $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $value['jongereInschrijfdatum']);
                    $newDateTimeString = $myDateTime->format('d-m-Y H:i:s');

                    echo " 
                        <tbody>
                            <tr>
                                <td>" . $value['jongereRoepnaam'] . "</td>
                                <td>" . $value['jongereTussenvoegsel'] . "</td>
                                <td>" . $value['jongereAchternaam'] . "</td>
                                <td>" . $diff->format('%y'). "</td>
                                <td>" . $newDateTimeString . "</td>
                                <td><a href=../youthActiviti/createYouthActiviti.php?id=" . $value['jongereId'] . "><img src='../../img/inschrijven.png'></a></td>
                                <td><a href=../youthInstitute/createYouthInstitute.php?id=" . $value['jongereId'] . "><img src='../../img/instituut.png'></a></td>
                                <td><a href=../youth/overviewYouthInformation.php?id=" . $value['jongereId'] . "><img src='../../img/info.png'></a></td>
                                <td></td>
                                <td><a href=../youth/updateYouth.php?id=" . $value['jongereId'] . "><img src='../../img/edit.png'></a></td>
                                <td><a href=../youth/archiveYouth.php?id=" . $value['jongereId'] . "><img src='../../img/archiveer.png'></a></td>
                                
                                
                        ";
                }
            }

            ?>

                            </tr>
                        </tbody>
        </table>
    </body>
</html>