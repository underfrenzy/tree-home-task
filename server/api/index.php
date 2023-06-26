<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: GET, POST, DELETE, PUT");

require "../vendor/autoload.php";

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['REQUEST_URI'],'/'));

$controller = $request[1];
$param = $request[2] ?? null;

$controller = new nodes\Controller();

switch ($method) {
    case 'GET':
        if (isset($request[2]) && $request[2] === 'childs') {
            $controller->getChilds($request[3]);
        } else {
            $controller->get($param);
        }
        break;
    case 'POST':
        $postBody = $_POST;
        $controller->post($postBody);
        break;
    case 'PUT':
        $postBody = $_SERVER['REQUEST_BODY'];
        $controller->put($param, $postBody);
        break;
    case 'DELETE':
        $controller->delete($param);
        break;
}
