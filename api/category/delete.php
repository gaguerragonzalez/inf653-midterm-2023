<?php
  $data = json_decode(file_get_contents("php://input"));

  $category->id = $data->id;

  // delete category
  if ($category->delete()) {
    echo json_encode(
      array('id' => $category->id)
    );
  }
  else {
    echo json_encode(
      array('message' => 'No Categories Found')
    );
  }
