<?php

class TasksController
{

    // POST FUNCTIONS

    public function updateInterval()
    {
        $oID = $_POST["oID"];

        $operationOk = Task::updateInterval($oID);
        if ($operationOk) {
            echo json_encode(array('ok' => True));
        } else {
            echo json_encode(array('ok' => False));
        }
    }

    public function showOne()
    {
        $oID = $_POST["oID"];

        $obligationData = Task::showOne($oID);
        echo json_encode($obligationData);
    }


    public function complete()
    {
        $oID = $_POST["taskID"];

        $obligationData = Task::complete($oID);
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
        $pID = $_POST['projectId'];

        if ($pID == -1) {
            $operationOk = Task::add($uID, $name, $notes, $duedate);
        } else {
            $operationOk = Task::ofProjectAdd($pID, $name, $notes, $duedate);
        }
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
        require_once('views/tasks/create.php');
    }

    public function infoPage()
    {
        require_once('views/tasks/show.php');
    }

    public function table()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $tasks = Task::sFromUser($_SESSION['ID']);
        require_once('views/tasks/table.php');
    }

    public static function fromProject($pID)
    {
        $tasks = Task::sFromProject($pID);
        require_once('views/tasks/fromProject.php');
    }
}