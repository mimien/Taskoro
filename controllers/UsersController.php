<?php

class UsersController
{
    // POST FUNCTIONS
    public function create()
    {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $operationOk = User::add($name, $email, $password);
        if ($operationOk) {
            echo json_encode(array('succesful' => True));
        } else {
            echo json_encode(
                array(
                    'succesful' => False,
                    'name' => $name
                )
            );
        }
    }

    public function verify()
    {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $userData = User::verifyCorrect($email, $password);
        if ($userData['ok']) {
            session_start();
            $_SESSION['ID'] = $userData['userID'];
            unset($userData['userID']);
        }
        echo json_encode($userData);
    }

    // GET FUNCTIONS
    public function main()
    {
            require_once('views/users/layout.php');
    }

    public function registerPage()
    {
        require_once('views/users/register.php');
    }

    public function loginPage()
    {
        require_once('views/users/login.php');
    }

    public function logout()
    {
        session_start();
        if (isset($_SESSION['ID'])) {
            session_destroy();
        }
        echo 'Logged out';
    }
}

?>