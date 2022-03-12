<?php
header('Content-type: json/application');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Credentials: true');

require 'actions.php';
require 'connections.php';

$method = $_SERVER['REQUEST_METHOD'];
$route = $_GET['route'];

$params = explode('/', $route);
$type = $params[0];
$id = $params[1];


if($method === 'GET') {
    if ($type === 'news') {
        if (isset($id)) {
            getNewsById($connect, $id);
        } else {
            getNews($connect);
        }
    }
}elseif ($method === 'POST') {
    if($type === 'news') {
        addNews($connect, $_POST);
    }
}elseif ($method === 'PATCH') {
    if($type === 'news') {
        if(isset($id)) {
            $data = file_get_contents('php://input');
            $data = json_decode($data, true);
            updateNews($connect, $id, $data);
        }
    }
}elseif ($method === 'DELETE') {
    if($type === 'news') {
        if(isset($id)) {
            deleteNews($connect, $id);
        }
    }
}





?>