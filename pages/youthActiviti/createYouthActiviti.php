<?php
/**
 * Created by PhpStorm.
 * User: melan
 * Date: 15-1-2018
 * Time: 13:45
 */

    include '../../class/Sql.php';
    include '../../class/Crud.php';
    include '../../class/LoginHandler.php';

    session_start();

    $query = new Crud();
    $sql = new Sql();

    $table = 'jongereActiviteit';
    $columns = array('activiteitId', 'jongereId');


    /*
     * Het inserten into de data base.
     * In dit stuk code is met behulp van Preg match een beveiliging er op gezet dat alleen een bepaald soort email kan worden toe gevoegt,
     * en met behulp van md5 worden de wachtwoorden beveiligd maar ook met behulp van htmlspecialchars wordt het insurten van de informatie beveiligd zodat hackers niet in de database kunnen komen.
     */
        if(isset($_POST['submit']))
        {
                    $values = array($_POST['activiteitId'], $_GET['id']);
                    $query->insertIntoTable($table, $columns, $values);
                    echo 'Het toevoegen is gelukt';
                    //header("refresh:0.5;url=overviewActiviti.php");

        }

        //Het formulier waarbij je de gebruikers kunnen worden toe gevoegd
        echo "<form method='post'>
                <select name='activiteitId'>
             ";
                $tables = 'activiteit';
                foreach ($sql->selectFromFetch() as $value)
                {


                    //De dropdown waarmee je de Categorieën gemakkelijk kunt selecteren
                    echo "

                            <option value='".$value['activiteitId']."'>".$value['activiteitNaam']."</option>
                            

                        ";
                }
                echo "
                    <input type='submit' name='submit' value='submit'>
            </form>"

?>


