<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/opmaak.css">
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: melan
 * Date: 16-1-2018
 */
include 'class/LoginHandler.php';
session_start();
session_destroy();
if(isset($_POST['loginButton']))
{
    if((new LoginHandler())->logIn($_POST['gebruikersEmail'], $_POST['gebruikersWachtwoord']))
    {
        echo  'Welkom';
    }

    else
    {
        echo 'U heeft uw gebruikersnaam of wachtwoord niet goed ingevuld!';
    }
}
?>

<html>
    <form method="post">
            Username:
                <input class="btmspace-15" name="gebruikersEmail" type="text" value="" placeholder="Email">
            Password:
                <input class="btmspace-15" name="gebruikersWachtwoord" type="password" value="" placeholder="Password">
                <input name="loginButton" type="submit" value="submit">
    </form>
</body>
</html>