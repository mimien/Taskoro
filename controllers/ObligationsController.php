<?php

class ObligationsController
{

    // POST FUNCTIONS

    public function updateInterval()
    {
        $oID = $_POST["oID"];

        $operationOk = Obligation::updateInterval($oID);
        if ($operationOk) {
            echo json_encode(array('ok' => True));
        } else {
            echo json_encode(array('ok' => False));
        }
    }

    public function showOne()
    {
        $oID = $_POST["oID"];

        $obligationData = Obligation::showOne($oID);
        echo json_encode($obligationData);
    }

    public function create()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $uID = $_SESSION['ID'];
        $name = $_POST['name'];
        $notes = $_POST['notes'];
        $duedate = $_POST['date'];

        $operationOk = Obligation::add($uID, $name, $notes, $duedate);
        if ($operationOk) {
            echo json_encode(array('succesful' => True));
        } else {
            echo json_encode(
                array(
                    'succesful' => False
                )
            );
        }
    }

    // GET FUNCTIONS
    public function createPage()
    {
        require_once('views/obligations/create.php');
    }

    public function infoPage()
    {
        require_once('views/obligations/show.php');
    }

    public function table()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $obligations = Obligation::sFromUser($_SESSION['ID']);
        require_once('views/obligations/table.php');
    }
}

?>