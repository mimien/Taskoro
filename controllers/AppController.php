<?php

class AppController
{
    public function home()
    {
        session_start();
        if (!isset($_SESSION['ID'])) {
            return call('Users', 'main');
        }

        require_once("views/app/layout.php");
    }

    public function error404()
    {
        header('HTTP/1.0 404 Not Found');
        echo '<h1>404 Not Found</h1>';
        die('The page that you have requested could not be found.');
    }
}

?>