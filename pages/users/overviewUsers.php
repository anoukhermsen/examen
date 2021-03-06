<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../css/opmaak.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: melan
 * Date: 15-1-2018
 * Time: 13:45
 */

    session_start();

    include '../../class/Sql.php';
    $sql = new Sql();
    include '../../class/LoginHandler.php';
    (new LoginHandler())->checkLoggedIn();
    include '../../class/Menu.php';
    (new Menu())->generateMenu();



    /*
     * De variable's die er nodig zijn om de informatie te leveren om het naar de database te sturen
     */
    $table = "gebruikers";
    $columnSort = "gebruikersEmail";
    $orderBy = "ASC";
    $where = "gebruikersArchief";
    $id = $_SESSION['gebruikersId'];
    $archief = 0;

?>






    <a href=../users/overviewArchivedUsers.php>Overzicht gearchiveerde gebruikers</a>
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
            /* SELECT * FROM 'gebruikers' WHERE 'gebruikersArchief' = 0*/
                foreach ($sql->gebruikersSort($id, $archief) as $value)
                {

                    //$columns = array("userEmail", "userSurname", "userLastname", "userStudentNr", "userPassword", "userPhoto", "userRights");
                    echo" 
                        <tbody>
                            <tr>
                                <td>".$value['gebruikersEmail']."</td>
                                <td>".$value['gebruikersVoornaam']."</td>
                                <td>".$value['gebruikersTussenvoegsel']."</td>
                                <td>".$value['gebruikersAchternaam']."</td>
                                <td><a href=../users/updateUser.php?id=". $value['gebruikersId'] ."><img src='../../img/edit.png'></a></td>
                        
                                   <td><a href=../users/archiveUser.php?id=". $value['gebruikersId'] ."><img src='../../img/archiveer.png'></a></td>";
                }

                ?>

                            </tr>
                        </tbody>
        </table>
    </body>
</html>