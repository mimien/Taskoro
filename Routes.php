<?php

// check if there is a http get request if not go to to app home
if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
} else if (isset($_POST['action'])) {

} else {
    $controller = 'App';
    $action = 'home';
}
/**
 * Function to run a controller's action
 */
function call($controller, $action)
{
    require_once('controllers/' . $controller . 'Controller.php');

    // Creates a new instance of the needed controller
    // Includes the model if the controller needs it
    switch ($controller) {
        case 'App':
            $controller = new AppController();
            break;
        case 'Obligations':
            require_once('models/Obligation.php');
            $controller = new ObligationsController();
            break;
        case 'Users':
            require_once('models/User.php');
            $controller = new UsersController();
            break;
    }

    $controller->{$action}();
}

// A list of all available http get requests (controller) pointing to their posible actions
$controllers = array(
    'App' => ['home', 'error404'],
    'Obligations' => ['table', 'createPage', 'infoPage'],
    'Users' => ['main', 'registerPage', 'loginPage', 'logout']
);

/* 
   Checks that the requested controller and its action is in the list above 
   otherwise it will redirect to the 404 not found page
*/
if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call('App', 'error404');
    }
} else {
    call('App', 'error404');
}
?>
