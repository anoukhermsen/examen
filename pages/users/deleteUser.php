<?php

    session_start();

    include '../../class/Crud.php';
    $query = new Crud();
    include '../../class/LoginHandler.php';


    (new LoginHandler())->checkRights();

    /*
     * De variable's die er worden gebruikt om de gekozen gebruiker te kunnen verwijderen door middel van het gebruiken van een $_GET id
     */
    $columnId = "gebruikersId";
    $table = "gebruikers";
    $id = $_GET['id'];

    if (isset($_POST['Ja']))
    {
        echo $query->deleteRow($table, $columnId, $id);

        header('location: overviewUsers.php');
    }

    if (isset($_POST['Nee']))
    {
        header('location: overviewUsers.php');
    }
?>

<html>
    <body>
        Weet u zeker dat u deze gebruiker wil verwijderen?
        <br>

            <?php
                echo'
                      <input type="submit" value="Ja" name="Ja" style=" color:#FFFFFF; background-color:#00CCBD; border-color:transparent; padding:8px 18px 10px; text-transform:uppercase; font-weight:700; cursor:pointer;">
                      <input type="submit" value="Nee" name="Nee" style=" color:#FFFFFF; background-color:#00CCBD; border-color:transparent; padding:8px 18px 10px; text-transform:uppercase; font-weight:700; cursor:pointer;">
                      <input type="hidden" name="id" value="'. $_GET['id'] .'">
                    ';
            ?>
    </body>
</html>
