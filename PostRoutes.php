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
   case 'Tasks':
      require_once('models/Task.php');
      $controller = new TasksController();
      break;
   case 'Projects':
      require_once('models/Project.php');
      $controller = new ProjectsController();
      break;
}
$controller->{$action}();
?>
