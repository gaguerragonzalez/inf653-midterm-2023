<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  $method = $_SERVER['REQUEST_METHOD'];

  if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit();
  }
  
  // instantiate database and category objects
  include_once '../../config/Database.php';
  include_once '../../models/Category.php';
  $database = new Database();
  $db = $database->connect();
  $category = new Category($db);

  if ($method === 'GET') {
    if (isset($_GET['id'])) {
        require_once('read_single.php');
    }
    else {
        require_once('read.php');
    }
  }
  else if ($method === 'POST') {
    require_once('create.php');
  }
  else if ($method === 'PUT') {
    require_once('update.php');
  }
  else if ($method === 'DELETE') {
    require_once('delete.php');
  }
