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

    public function redirectPage()
    {
        if(!isset($_SESSION)){
            session_start();
        }

        if(isset($_POST['button-view'])){
            $_SESSION['list_id'] = htmlspecialchars($_POST['list_id']);
            header("LOCATION: ../addEditDetails.php");
            exit(0);
        } elseif(!isset($_POST['button-create'])) {
            header("LOCATION: ../addNewBorrower.inc.php");
            exit(0);
        } else {
            header("LOCATION: ../");
            exit(0);
        }

    }

    public function showDetails()
    {
        if(!isset($_SESSION)){
            session_start();
        }

        $id = $_SESSION['list_id'];

        return $this->getSingleDetails($id);
    }

    public function getRepaymentDetails()
    {
        return $this->getRepayment();
    }

    public function singleRepayment()
    {
        if(!isset($_POST['id'])){
            header("LOCATION: ../");
            exit(0);
        }

        $id = htmlspecialchars($_POST['id']);
        $action = htmlspecialchars($_POST['action']);

        if($action == 'edit') {
            return $this->getSingleRepayment($id);
        } elseif($action == 'delete'){
            return $this->deleteSingleRepayment($id);
        }
    }


}