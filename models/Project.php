<?php

/**
 * Created by PhpStorm.
 * User: emiliocornejo
 * Date: 6/28/17
 * Time: 08:15
 */
class Project
{

    public function __construct($id, $userID, $name, $notes, $dueDate)
    {
        $this->id = $id;
        $this->userID = $userID;
        $this->name = $name;
        $this->notes = $notes;
        $this->dueDate = $dueDate;
    }

    public static function add($uID, $name, $notes, $dueDate)
    {
        $db = Db::get();
        $insertProject = "INSERT INTO Projects(userID, name, notes, dueDate)"
            . " VALUES('$uID', '$name', '$notes', '$dueDate');";
        $operationOk = $db->query($insertProject);
        return $operationOk;
    }

    public static function sFromUser($uID)
    {
        $db = Db::get();
        $selectProjects = "SELECT * FROM Projects WHERE userID = '$uID'";

        $res = $db->query($selectProjects);

        if ($res->num_rows > 0) {
            $userProjects = array();

            while ($project = $res->fetch_assoc()) {
                $userProjects[] = new Project(
                    $project['projectID'],
                    $project['userID'],
                    $project['name'],
                    $project['notes'],
                    $project['dueDate']
                );
            }
            return $userProjects;
        } else {
            return null;
        }
    }

    public static function tasksFrom($pID)
    {
        $db = Db::get();
        $selectProjects = "SELECT * FROM Tasks WHERE userID = '$uID'";

        $res = $db->query($selectProjects);

        if ($res->num_rows > 0) {
            $userProjects = array();

            while ($project = $res->fetch_assoc()) {
                $userProjects[] = new Project(
                    $project['projectID'],
                    $project['userID'],
                    $project['name'],
                    $project['notes'],
                    $project['dueDate']
                );
            }
            return $userProjects;
        } else {
            return null;
        }
    }
}