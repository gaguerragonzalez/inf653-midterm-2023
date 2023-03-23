<?php
  $author->id = isset($_GET['id']) ? $_GET['id'] : die();

  $author->read_single();
  
  if ($author->author === null) {
    echo json_encode(
      array('message' => 'author_id Not Found')
    );
    die();
  }

  $author_arr = array(
    'id' => $author->id,
    'author' => $author->author
  );

  echo json_encode($author_arr);
