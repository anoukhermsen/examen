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
    include '../../class/Crud.php';
    $query = new Crud();
    include '../../class/LoginHandler.php';
    (new LoginHandler())->checkLoggedIn();
    include '../../class/Menu.php';
    (new Menu())->generateMenu();




    $table = 'jongereinstituut';
    $columns = array('instituutId', 'jongereId', 'instituutStartdatum');


    /*
     * Het inserten into de data base.
     * In dit stuk code is met behulp van Preg match een beveiliging er op gezet dat alleen een bepaald soort email kan worden toe gevoegt,
     * en met behulp van md5 worden de wachtwoorden beveiligd maar ook met behulp van htmlspecialchars wordt het insurten van de informatie beveiligd zodat hackers niet in de database kunnen komen.
     */
    if(isset($_POST['submit']))
    {
        $values = array($_POST['instituutId'], $_GET['id'], $_POST['instituutStartdatum']);
        $query->insertIntoTable($table, $columns, $values);

        echo 'Het toevoegen is gelukt';
        header("refresh:0.5;url= ../youth/overviewYouth.php");
    }

    //Het formulier waarbij je de gebruikers kunnen worden toe gevoegd
    echo "<form method='post'>
                    <select name='instituutId'>
                 ";//INSERT INTO jongereinstituut(instituutId, jongereId) VALUES (2, 4)
                    $tables = 'instituut';
    foreach ($sql->selectFromInstituutFetch() as $value)
    {


        //De dropdown waarmee je de Categorieën gemakkelijk kunt selecteren
        echo "
    
                                <option value='".$value['instituutId']."'>".$value['instituutNaam']."</option>
                                
    
                           <br><br> ";
    }
        echo "
                            
                        <input type='date' name='instituutStartdatum'>
                            <br>
                        <input type='submit' name='submit' value='submit'>
                </form>
           ";

?>



