<?php

//Aanroepen van de gebruikte classes
include '../../class/Crud.php';
$query = new Crud();
include '../../class/LoginHandler.php';
session_start();

(new LoginHandler())->checkRights();

//Variables die worden gebruikt in het selecten vanuit een database

$table = "users";
$columnSort = "userStudentNr";
$orderBy = "ASC";
?>
<!DOCTYPE html>

<html lang="">

<head>
<title>Gebruikers overzicht </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="../../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">

<!-- Top Background Image Wrapper -->
<div class="topspacer bgded overlay" style="background-image:url('../../images/demo/backgrounds/LANparty 1.png');">

  <div class="wrapper row1">
    <header id="header" class="hoc clear">

      <div id="logo" class="fl_left">
        <h1><a href="../index.php">Lanparty</a></h1>
      </div>

      <nav id="mainav" class="fl_right">
        <ul class="clear">
          <li><a class="drop">Aanmaken</a>
            <ul>
              <li><a href="../tournooi/createTournooi.php">Toernooi toevoegen</a></li>
            </ul>
          </li>
          <li class="active"><a class="drop">Overzicht</a>
            <ul>
              <li class="active"><a href="../users/overviewUsers.php">Overzicht gebruikers</a></li>
              <li><a href="../tournooi/overviewTournooi.php">Overzicht toernooi</a></li>
              <li><a href="../participate/overviewParticipant.php">Overzicht inschrijvingen toernooi</a></li>
              <li><a href="../application/overviewPayment.php">Overzicht betalingen</a></li>
            </ul>
          </li>
            <li>
                <a href="../logout.php">Uitloggen</a>
            </li>
        </ul>
      </nav>
    </header>

  </div>

  <div id="breadcrumb" class="hoc clear">

    <h6 class="heading">Gebruikers overzicht</h6>
    <ul>
      <li><a href="#">Login</a></li>
      <li><a href="#">Gebruikers overzicht</a></li>
    </ul>

  </div>

</div>

<div class="wrapper row3">

<br>
        <!-- main body -->
        <!-- ################################################################################################ -->
        <div class="content">
            <div class="scrollable">
<br>



            <table>
                <thead>
                <tr>
                    <th>Student nummer</th>
                    <th>Email</th>
                    <th>Voornaam</th>
                    <th>Achternaam</th>
                    <th>Wachtwoord</th>
                    <th>Profiel foto</th>
                    <th>Aanmelding kerstontbijt</th>
                    <th>Rechten</th>
                    <th>Bewerken</th>
                    <th>Verwijderen</th>
                </tr>
                </thead>
                    <?php


                foreach ($query->selectFromTable($table, null, null, null, null, null,  $columnSort, $orderBy) as $value)
                {
                    if($value['userCB']==1)
                    {
                        $value['userCB'] = "ja";
                    }

                    else
                    {
                        $value['userCB'] = "nee";
                    }

                    if($value['userRights']==1)
                    {
                        $value['userRights'] = "Student";
                    }

                    else
                    {
                        $value['userRights'] = "Admin";
                    }
                    //$columns = array("userEmail", "userSurname", "userLastname", "userStudentNr", "userPassword", "userPhoto", "userRights");
                    echo" 
                    <tbody>
                    <tr>
                        <td>".$value['userStudentNr']."</td>
                        <td>".$value['userEmail']."</td>
                        <td>".$value['userSurname']."</td>
                        <td>".$value['userLastName']."</td>
                        <td>".$value['userPassword']."</td>
                        <td>".$value['userPhoto']."</td>
                        <td>".$value['userCB']."</td>
                        <td>".$value['userRights']."</td>
                        <td><a href=../users/updateUser.php?id=". $value['userId'] ."><img src='../../img/edit.png'></a></td>
                        <td><a href=../users/deleteUser.php?id=". $value['userId'] ."><img src='../../img/delete.png'></a></td>
                        
";


                }
                echo "   
                </tr>
                </tbody>
            </table>";
                ?>



            </div>
        </div>
    </main>
</div>

<!-- End Top Background Image Wrapper -->


<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="../../layout/scripts/jquery.min.js"></script>
<script src="../../layout/scripts/jquery.backtotop.js"></script>
<script src="../../layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>