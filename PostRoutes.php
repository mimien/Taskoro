<?php
header('Accept: application/json');
header('Content-type: application/json');

require_once('connection.php');

$action = $_POST['action'];
$controller = $_POST['controller'];

require_once('controllers/' . $controller . 'Controller.php');

switch($controller) {
   case 'Users':
      require_once('models/User.php');
      $controller = new UsersController();
      break;
   case 'Obligations':
      require_once('models/Obligation.php');
      $controller = new ObligationsController();
      break;
}
$controller->{$action}();
?>
