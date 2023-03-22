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
  
  // instantiate database and quote objects
  include_once '../../config/Database.php';
  include_once '../../models/Quote.php';
  $database = new Database();
  $db = $database->connect();
  $quote = new Quote($db);

  if ($method === 'GET') {
    if (isset($_GET['id'])) {
        require_once('read_by_id.php');
    }
    else if (isset($_GET['author_id']) || isset($_GET['author_id'])) {
      require_once('read_by_foreign_keys.php');
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
