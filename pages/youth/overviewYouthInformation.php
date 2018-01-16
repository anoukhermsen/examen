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
    include '../../class/Sql.php';
    include '../../class/LoginHandler.php';

    $query = new Crud();
    $sql = new Sql();

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

        <h2>Activiteiten Tabel</h2>

        <table>
            <thead>
                <tr>
                    <th>Activiteits Naam</th>
                    <th>Inschrijfdatum</th>
                    <th>Afgerond</th>
                    <th>Bewerken</th>
                    <th>Archiveren</th>
                </tr>
            </thead>

            <?php
                foreach ($sql->joinJongereActiviteit($id) as $value)
                {
                    if ($value['activiteitAfgerond'] == 0)
                    {
                        $value['activiteitAfgerond'] =  "Nee";
                    }

                    else
                    {
                        $value['activiteitAfgerond'] =  "Ja";
                    }
                    /**Veranderen van amerikaanse datum naar nederlands
                     * Van 2001-01-02 naar 02-01-2001*/
                    $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s' , $value['activiteitInschrijfdatum']);
                    $newDateTimeString = $myDateTime->format('d-m-Y H:i:s');

                    echo" 
                        <tbody>
                            <tr>
                                <td>".$value['activiteitNaam']."</td>
                                <td>".$newDateTimeString."</td>
                                <td>".$value['activiteitAfgerond']."</td>
                                <td><a href=../youthActiviti/createYouthActiviti.php?id=". $value['jongereId'] ."><img src='../../img/inschrijven.png'></a></td>
                                <td><a href=../youthInstitute/createYouthInstitute.php?id=". $value['jongereId'] ."><img src='../../img/instituut.png'></a></td>
                        ";

                }
             ?>

                            </tr>
                        </tbody>
        </table>

    <h2>Instituut Tabel</h2>

    <table>
        <thead>
        <tr>
            <th>Instituut Naam</th>
            <th>Start datum</th>
            <th>Bewerken</th>
            <th>Archiveren</th>
        </tr>
        </thead>

        <?php
        foreach ($sql->joinJongereInstituut($id) as $value)
        {
             /**Veranderen van amerikaanse datum naar nederlands
             * Van 2001-01-02 naar 02-01-2001*/
            $myDateTime = DateTime::createFromFormat('Y-m-d' , $value['instituutStartdatum']);
            $newDateTimeString = $myDateTime->format('d-m-Y');

            echo" 
                        <tbody>
                            <tr>
                                <td>".$value['instituutNaam']."</td>
                                <td>".$newDateTimeString."</td>
                                <td><a href=../youthActiviti/createYouthActiviti.php?id=". $value['jongereId'] ."><img src='../../img/inschrijven.png'></a></td>
                                <td><a href=../youthInstitute/createYouthInstitute.php?id=". $value['jongereId'] ."><img src='../../img/instituut.png'></a></td>
                        ";

        }
        ?>

        </tr>
        </tbody>
    </table>
    </body>
</html>