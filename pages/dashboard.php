<?php
/**
 * Created by PhpStorm.
 * User: Anouk Hermsen
 * Date: 16-1-2018
 * Time: 09:36
 */
include '../class/LoginHandler.php';
session_start();
(new LoginHandler())->checkLoggedIn();
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/opmaak.css">
    </head>
    <body>
    <table>
        <th>
            Activiteit
        </th>
        <th>
            Gebruiker
        </th>
        <th>
            Instituut
        </th>
        <th>
            Jongere
        </th>
        <th>

        </th>
        <tr>
            <td>
                <a href="activiti/createActiviti.php">Nieuw activiteit aanmaken</a>
            </td>
            <td>
                <a href="users/createUser.php">Nieuw gebruiker aanmaken</a>
            </td>
            <td>
                <a href="institute/createInstitute.php">Nieuw instituut aanmaken</a>
            </td>
            <td>
                <a href="youth/createYouth.php">Nieuwe jongere aanmaken</a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="activiti/overviewActiviti.php">Overzicht activiteiten</a>
            </td>
            <td>
                <a href="users/overviewUsers.php">Overzicht gebruikers</a>
            </td>
            <td>
                <a href="institute/overviewInstitute.php">Overzicht instituten</a>
            </td>
            <td>
                <a href="youth/overviewYouth.php">Overzicht jongeren</a>
            </td>
            <td>
                <a href="../logout.php">Uitloggen</a>
            </td>
        </tr>

    </table>
    </body>
</html>
