<?php
  $data = json_decode(file_get_contents("php://input"));
  
  if (!isset($data->id) || !isset($data->category)) {
    echo json_encode(
      array('message' => 'Missing Required Parameters')
    );
    die();
  }

  $category->id = $data->id;
  $category->category = $data->category;

  if($category->update()) {
    echo json_encode(
      array('id' => $category->id, 'category' => $category->category)
    );
  }
