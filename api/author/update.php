<?php
  $data = json_decode(file_get_contents("php://input"));
  
  if (!isset($data->id) || !isset($data->author)) {
    echo json_encode(
      array('message' => 'Missing Required Parameters')
    );
    die();
  }

  $author->id = $data->id;
  $author->author = $data->author;

  if($author->update()) {
    echo json_encode(
      array('id' => $author->id, 'author' => $author->author)
    );
  }
