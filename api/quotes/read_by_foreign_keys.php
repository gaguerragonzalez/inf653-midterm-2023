<?php
  $quote->author_id = -1;
  $quote->category_id = -1;
  if (isset($_GET['author_id'])) {
    $quote->author_id = $_GET['author_id'];
  }
  if (isset($_GET['category_id'])) {
    $quote->category_id = $_GET['category_id'];
  }
  $result = $quote->read_by_foreign_keys();
  
  $num = $result->rowCount();

  if ($num > 0) {
    $quote_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $quote_item = array(
        'id' => $id,
        'quote' => $quote,
        'author' => $author_name,
        'category' => $category_name
      );

      array_push($quote_arr, $quote_item);
    }

    echo json_encode($quote_arr);

  }
  else {
    echo json_encode(
      array('message' => 'No Quotes Found')
    );
  }
