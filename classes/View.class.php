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


}