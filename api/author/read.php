<?php
  $result = $author->read();
  
  $num = $result->rowCount();

  if ($num > 0) {
    $author_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $author_item = array(
        'id' => $id,
        'author' => $author
      );

      array_push($author_arr, $author_item);
    }

    echo json_encode($author_arr);

  }
  else {
    echo json_encode(
      array('message' => 'author_id Not Found')
    );
  }
