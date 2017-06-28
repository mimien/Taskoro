<?php

/**
 * Created by PhpStorm.
 * User: emiliocornejo
 * Date: 6/28/17
 * Time: 08:22
 */
class ProjectsController
{
    // POST FUNCTIONS
    public function showOne()
    {
        $oID = $_POST["oID"];

        $obligationData = Task::showOne($oID);
        echo json_encode($obligationData);
    }


    public function complete()
    {
        $oID = $_POST["oID"];

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
        $dueDate = $_POST['date'];

        $operationOk = Project::add($uID, $name, $notes, $dueDate);
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
        require_once('views/projects/create.php');
    }

    public function infoPage()
    {
        require_once('views/tasks/show.php');
    }

    public function all()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $projects = Project::sFromUser($_SESSION['ID']);
        require_once('views/projects/all.php');
    }
}