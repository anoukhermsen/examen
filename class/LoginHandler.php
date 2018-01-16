<?php

 include_once 'DBConfi.php';

class LoginHandler extends DBConfi
{
    private $gebruikersEmail;
    private $gebruikersWachtwoord;
    private $gebruikersId;
    /*Haalt ook gegevens uit de DBConfi.php*/
    public function __construct()
    {
        parent::__construct();
    }

    /*Gegevens van de gebruikers uit de database halen en kijken of het wachtwoord en de gebruikersnaam met de gegevens uit de textfields met elkaar overeenkomen
    SESSION op TRUE zetten en rechten geven aan de gebruiker*/
    public function logIn($gebruikersEmail, $gebruikersWachtwoord)
    {
        $this->openConnection();
        $this->setGebruikersWachtwoord($gebruikersWachtwoord);//SELECT * FROM `gebruikers` WHERE `gebruikersEmail``gebruikersWachtwoord`
        $stmt = $this->getConn()->prepare('SELECT * FROM `gebruikers` WHERE gebruikersEmail= :gebruikersEmail AND gebruikersWachtwoord= :gebruikersWachtwoord');
        $stmt->bindParam(':gebruikersEmail', $gebruikersEmail);
        $stmt->bindParam(':gebruikersWachtwoord', $this->getGebruikersWachtwoord());
        $stmt->execute();

        var_dump($gebruikersEmail);
        var_dump($gebruikersWachtwoord);

//        $this->setUserRights(($stmt->fetch()['cusRights']));
//        $this->setUserId(($stmt->fetch()['cusId']));


        $this->closeConnection();


        if ($stmt->rowCount() != 0) // Kijkt of er een hit is gevonden in de DB met de username en password
        {
            session_start();
            $_SESSION['login'] = true;
            foreach ($stmt->fetchAll() AS $hit)
            {

                $_SESSION['gebruikersId'] = $hit['gebruikersId'];
                header('location: pages/dashboard.php');
            }
        }

        else
        {
            return false;
        }
    }



    /*Checken of je bent ingelogd en je inloggegevens kloppen en je daarna doorsturen naar een andere pagina*/
    public function checkLoggedIn()
    {
        if(isset($_SESSION['login']) && $_SESSION['login'] == true)  //Kijkt of de Session is ingesteld en true isl
        {
                header('location: ../dashboard.php');
        }

        else
        {
            header('Location:../login.php');
        }
    }

    /*Uitlog functie, session verwijderen en je doorsturen naar een andere pagina*/
    public function logOut()
    {
        session_destroy();
        header('location: index.php');
    }
///////////////////////////////////////////////////////////////Getters en Setters///////////////////////////////////////

    /*Gebruikers email*/
    public function getGebruikersEmail()
    {
        return $this->gebruikersEmail;
    }

    public function setGebruikersEmail($gebruikersEmail)
    {
        $this->gebruikersEmail = $gebruikersEmail;
    }

    /*Gebruikers password met md5*/
    public function getGebruikersWachtwoord()
    {

        return $this->gebruikersWachtwoord;
    }

    public function setGebruikersWachtwoord($gebruikersWachtwoord)
    {
        $this->gebruikersWachtwoord = md5($gebruikersWachtwoord);
        //$this->password = $password;
    }

    /*Gebruikers id*/
    public function getGebruikersId()
    {
        return $this->gebruikersId;
    }

    public function setGebruikersId($gebruikersId)
    {
        $this->gebruikersId = $gebruikersId;
    }

}