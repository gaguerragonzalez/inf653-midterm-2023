<?php
  $data = json_decode(file_get_contents("php://input"));

  $author->id = $data->id;

  // delete author
  if ($author->delete()) {
    echo json_encode(
      array('id' => $author->id)
    );
  }
  else {
    echo json_encode(
      array('message' => 'No Authors Found')
    );
  }
