<?php
/**
 * Created by PhpStorm.
 * User: Anouk Hermsen
 * Date: 16-1-2018
 * Time: 09:36
 */
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
            Instituut aan jongere koppelen
        </th>
        <th>
            Activiteit aan jongere koppelen
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
            <td>
                <a href="youthInstitute/createYouthInstitute.php">Jongere toevoegen aan een instituut</a>
            </td>

            <td>
                <a href="youthActiviti/createYouthActiviti.php">Jongere toevoegen aan een activiteit</a>
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
                <a href="youthInstitute/overviewYouthInstitute.php">Overzicht welke jongere zit bij welk instituut</a>
            </td>
            <td>
                <a href="youthActiviti/overviewYouthActiviti.php">Overzicht welke jongere doet welke activiteit</a>
            </td>
        </tr>

    </table>
    </body>
</html>
