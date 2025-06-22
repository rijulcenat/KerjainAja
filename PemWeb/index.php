<?php




$c = $_GET['c'] ?? 'Lowongan';

$m = $_GET['m'] ?? 'watch';

$controllerFile = 'controller/' . $c . 'Controller.php';

if (file_exists($controllerFile)) {
  require_once($controllerFile);

  $controllerName = $c . 'Controller';

  if (class_exists($controllerName)) {

    $controller = new $controllerName();

    if (method_exists($controller, $m)) {
      $controller->$m();
    } else {
      die("Error: Method '$m' tidak ditemukan pada controller '$controllerName'.");
    }
  } else {
    die("Error: Class '$controllerName' tidak ditemukan pada file '$controllerFile'.");
  }
} else {
  die("Error: Controller dengan nama '$c' tidak ditemukan.");
}


