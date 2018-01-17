<?php
/**
 * Created by PhpStorm.
 * User: Anouk Hermsen
 * Date: 17-1-2018
 * Time: 12:18
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand">Jongeren kansrijk</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Activiteiten <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../activiti/createactiviti">Activiteit toevoegen</a></li>
          <li><a href="#">Activiteiten overzicht</a></li>
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Medewerkers <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Medewerker toevoegen</a></li>
          <li><a href="#">Medewerkers overzicht</a></li>
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Instituten <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Instituten toevoegen</a></li>
          <li><a href="#">Instituten overzicht</a></li>
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Jongeren <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Jongeren toevoegen</a></li>
          <li><a href="#">Jongeren overzicht</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Loguit</a></li>
    </ul>
  </div>
</nav>


</body>
</html>