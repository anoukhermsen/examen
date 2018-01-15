<?php

 include_once 'DBConfi.php';

class LoginHandler extends DBConfi
{
    private $userMail;
    private $userPassword;
    private $userRights;
    private $userId;
    /*Haalt ook gegevens uit de DBConfi.php*/
    public function __construct()
    {
        parent::__construct();
    }

    /*Gegevens van de gebruikers uit de database halen en kijken of het wachtwoord en de gebruikersnaam met de gegevens uit de textfields met elkaar overeenkomen
    SESSION op TRUE zetten en rechten geven aan de gebruiker*/
    public function logIn($userEmail, $userPassword)
    {
        $this->openConnection();
        $this->setUserPassword($userPassword);//SELECT * FROM `users` WHERE `userEmail` = "test@test.nl"
        $stmt = $this->getConn()->prepare('SELECT * FROM `users` WHERE userEmail= :userEmail AND userPassword= :userPassword');
        $stmt->bindParam(':userEmail', $userEmail);
        $stmt->bindParam(':userPassword', $this->getUserPassword());
        $stmt->execute();


//        $this->setUserRights(($stmt->fetch()['cusRights']));
//        $this->setUserId(($stmt->fetch()['cusId']));


        $this->closeConnection();


        if ($stmt->rowCount() != 0) // Kijkt of er een hit is gevonden in de DB met de username en password
        {

            session_start();
            $_SESSION['login'] = true;
            foreach ($stmt->fetchAll() AS $hit)
            {
                $this->setUserRights($hit['userRights']);
                $_SESSION['userId'] = $hit['userId'];
            }

            if ($this->getUserRights() == 0)
            {
                $_SESSION['userRights'] = 0;
                header('location: users/overviewUsers.php');
            }

            if ($this->getUserRights() == 1) {
                $_SESSION['userRights'] = 1;
                header('location:customer/overviewCustomer.php');
                //echo "hoi";
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
            if ($_SESSION['userRights'] == 0)
            {
                $_SESSION['userRights'] = 0;
                header('location: ../dashboard.php');
            }

            if ($_SESSION['userRights'] == 1)
            {
                $_SESSION['userRights'] = 1;
                header('location: /overviewUsers.php');
            }
        }

        else
        {
            header('Location:../login.php');
        }
    }

    /*Checken of je bent ingelogd en daarna bekijken of je op deze pagina mag komen en je anders terug sturen*/
    public function checkRights()
    {
        if(isset($_SESSION['login']) && $_SESSION['login'] == true)  //Kijkt of de Session is ingesteld en true isl
        {
            if ($_SESSION['userRights'] == 1)
            {
                //$_SESSION['userRights'] = 1;
                header('location: ../index.php');
                exit();
            }

            if ($_SESSION['userRights'] == 0)
            {
                //$_SESSION['userRights'] = 0;
            }
        }

        else
        {
            header('Location:../login.php');
            exit();
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
    public function getUserMail()
    {
        return $this->userMail;
    }

    public function setUserMail($userMail)
    {
        $this->userMail = $userMail;
    }

    /*Gebruikers password met md5*/
    public function getUserPassword()
    {

        return $this->userPassword;
    }

    public function setUserPassword($userPassword)
    {
        $this->userPassword = md5($userPassword);
        //$this->password = $password;
    }

    /*Gebruikers rechten*/
    public function getUserRights()
    {
        return $this->userRights;
    }

    public function setUserRights($userRights)
    {
        $this->userRights = $userRights;
    }

    /*Gebruikers id*/
    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

}