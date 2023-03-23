<?php
  $result = $category->read();
  
  $num = $result->rowCount();

  if ($num > 0) {
    $category_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $category_item = array(
        'id' => $id,
        'category' => $category
      );

      array_push($category_arr, $category_item);
    }

    echo json_encode($category_arr);

  }
  else {
    echo json_encode(
      array('message' => 'category_id Not Found')
    );
  }
