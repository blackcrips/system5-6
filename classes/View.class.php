<?php

class  View extends Model
{

    public function getAllData()
    {
        if(!isset($_POST['request-data'])){
            header("LOCATION: ./");
            exit(0);
        }

        exit(json_encode($this->getDatas()));
    }

    public function getUserData()
    {
        if(!isset($_SESSION)){
            session_start();
        }

        $userEmail = $_SESSION['login-details']['user-email'];
        return $this->getLoginUserData($userEmail);
    }

    public function showDetails()
    {
        if(!isset($_POST['list_id'])){
            header("LOCATION: ../status403.php");
            exit(0);
        } else {
            header("LOCATION: ../addEditDetails.php");
            exit(0);
        }

    }


}