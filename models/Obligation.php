<?php

class Obligation
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
        $selectObligations = "SELECT * FROM Obligations WHERE userID = '$uID'";

        $res = $db->query($selectObligations);

        if ($res->num_rows > 0) {
            $userObligations = array();

            while ($obligation = $res->fetch_assoc()) {
                $userObligations[] = new Obligation(
                    $obligation['obligationID'],
                    $obligation['name'],
                    $obligation['notes'],
                    $obligation['currentInterval'],
                    $obligation['dueDate'],
                    $obligation['isComplete']
                );
            }
            return $userObligations;
        } else {
            return null;
        }
    }

    public static function add($uID, $name, $notes, $duedate)
    {
        $db = Db::get();
        $insertUser = "INSERT INTO Obligations(userID, name, notes, currentInterval, dueDate, isComplete)"
            . " VALUES('$uID', '$name', '$notes', 1, '$duedate', 0);";
        $operationOk = $db->query($insertUser);
        return $operationOk;
    }

    public static function updateInterval($oID)
    {
        $db = Db::get();
        $incrementInterval = "UPDATE Obligations SET currentInterval = currentInterval + 1"
            . " WHERE obligationId = $oID";
        $operationOk = $db->query($incrementInterval);
        return $operationOk;
    }

    public static function showOne($oID)
    {
        $db = Db::get();
        $selectOne = "SELECT * FROM Obligations WHERE obligationId = $oID";

        $res = $db->query($selectOne);
        if ($res->num_rows > 0) {
            while ($obligation = $res->fetch_assoc()) {
                $obligationData = array(
                    'name' => $obligation['name'],
                    'notes' => $obligation['notes'],
                    'currentInterval' => $obligation['currentInterval'],
                    'dueDate' => $obligation['dueDate']
                );
            }
        }
        return $obligationData;
    }
}

?>