<?php
  $data = json_decode(file_get_contents("php://input"));
  
  if (!isset($data->author)) {
    echo json_encode(
      array('message' => 'Missing Required Parameters')
    );
    die();
  }
  
  $author->author = $data->author;

  echo json_encode(
    array('id' => $author->create(), 'author' => $author->author)
  );