<?php
  $data = json_decode(file_get_contents("php://input"));
  
  if (!isset($data->category)) {
    echo json_encode(
      array('message' => 'Missing Required Parameters')
    );
    die();
  }
  
  $category->category = $data->category;

  echo json_encode(
    array('id' => $category->create(), 'category' => $category->category)
  );