<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../css/opmaak.css">
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: Anouk Hermsen
 * Date: 16-1-2018
 * Time: 9:00
 */
    session_start();

    include '../../class/Crud.php';
    include '../../class/LoginHandler.php';
    include '../../class/Sql.php';

    $query = new Crud();
    $sql = new Sql();

(new LoginHandler())->checkLoggedIn();

    /*
     * Variabelen voor de database
     */
    $table = 'jongereinstituut';
    $columns = array('instituutId', 'jongereId', 'instituutStartdatum');
    $where = 'jongereId';
    $id = $_GET['id'];

/*UPDATE regel en zet weer in database*/
    if(isset($_POST['updaten']))
    {
        $values = array($_POST['instituutId'], $_GET['id'], $_POST['instituutStartdatum']);
        $query->updateRow($table, $columns, $where, $values, $id);

        echo 'Het toevoegen is gelukt<br>';
        header("refresh:0.5;url= ../youth/overviewYouthInformation.php?id='$id'");


    }

    if(isset($_POST['annuleren']))
    {
        echo 'Het updaten is geannuleerd <br>';

        header( "refresh:0.5;url=../youth/overviewYouthInformation.php?id='$id'");
    }

//echo $query->insertIntoTable($table, $columns, $values);
?>



    <body id="top">
    Naam instituut: <br>
    <form method="post">
    <select name='instituutId'>
        <?php

            foreach ($sql->selectFromInstituutFetch() as $value)
            {


            //De dropdown waarmee je de Categorieën gemakkelijk kunt selecteren
            echo "
            
            <option value='".$value['instituutId']."'>".$value['instituutNaam']."</option>
        
        
            <br><br> ";
            }
            echo "
        </select>
        <br>
            Startdatum: <br>
            <input type='date' name='instituutStartdatum'>
            <br>
            <input type='submit' name='updaten' value='updaten'>
            <input type='submit' name='annuleren' value='annuleren'> 
            </form>
            ";
        ?>
    </body>
</html>
