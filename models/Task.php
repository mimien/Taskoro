<?php

class Task
{
    public $id;
    public $name;
    public $notes;
    public $currentInterval;
    public $dueDate;
    public $isComplete;

    public function __construct($id, $name, $notes, $currentInterval, $dueDate, $isComplete)
    {
        $this->id = $id;
        $this->name = $name;
        $this->notes = $notes;
        $this->currentInterval = $currentInterval;
        $this->dueDate = $dueDate;
        $this->isComplete = $isComplete;
    }

    public static function sFromUser($uID)
    {
        $db = Db::get();
        $selectTasks = "SELECT * FROM Tasks WHERE userID = '$uID'";

        $res = $db->query($selectTasks);

        if ($res->num_rows > 0) {
            $userTasks = array();

            while ($task = $res->fetch_assoc()) {
                $userTasks[] = new Task(
                    $task['taskID'],
                    $task['name'],
                    $task['notes'],
                    $task['currentInterval'],
                    $task['dueDate'],
                    $task['isComplete']
                );
            }
            return $userTasks;
        } else {
            return null;
        }
    }

    public static function sFromProject($pID)
    {
        $db = Db::get();
        $selectTasks = "SELECT * FROM Tasks WHERE projectID = '$pID'";

        $res = $db->query($selectTasks);

        if ($res->num_rows > 0) {
            $userTasks = array();

            while ($task = $res->fetch_assoc()) {
                $userTasks[] = new Task(
                    $task['taskID'],
                    $task['name'],
                    $task['notes'],
                    $task['currentInterval'],
                    $task['dueDate'],
                    $task['isComplete']
                );
            }
            return $userTasks;
        } else {
            return null;
        }
    }

    public static function add($uID, $name, $notes, $duedate)
    {
        $db = Db::get();
        $insertUser = "INSERT INTO Tasks(userID, name, notes, currentInterval, dueDate, isComplete)"
            . " VALUES('$uID', '$name', '$notes', 1, '$duedate', 0);";
        $operationOk = $db->query($insertUser);
        return $operationOk;
    }

    public static function ofProjectAdd($pID, $name, $notes, $duedate)
    {
        $db = Db::get();
        $insertUser = "INSERT INTO Tasks(projectID, name, notes, currentInterval, dueDate, isComplete)"
            . " VALUES('$pID', '$name', '$notes', 1, '$duedate', 0);";
        $operationOk = $db->query($insertUser);
        return $operationOk;
    }

    public static function updateInterval($taskID)
    {
        $db = Db::get();
        $incrementInterval = "UPDATE Tasks SET currentInterval = currentInterval + 1"
            . " WHERE taskID = $taskID";
        $operationOk = $db->query($incrementInterval);
        return $operationOk;
    }

    public static function showOne($taskID)
    {
        $db = Db::get();
        $selectOne = "SELECT * FROM Tasks WHERE taskID = $taskID";

        $res = $db->query($selectOne);
        if ($res->num_rows > 0) {
            while ($task = $res->fetch_assoc()) {
                $taskData = array(
                    'name' => $task['name'],
                    'notes' => $task['notes'],
                    'currentInterval' => $task['currentInterval'],
                    'dueDate' => $task['dueDate']
                );
            }
        }
        return $taskData;
    }

    public static function complete($taskID)
    {
        $db = Db::get();
        $completeTask = "UPDATE Tasks SET isComplete = 1"
            . " WHERE taskID = $taskID";
        $operationOk = $db->query($completeTask);
        return $operationOk;
    }
}
?>