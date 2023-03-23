<?php
  $data = json_decode(file_get_contents("php://input"));
  
  if (!isset($data->id) || !isset($data->quote) || !isset($data->author_id) || !isset($data->category_id)) {
    echo json_encode(
      array('message' => 'Missing Required Parameters')
    );
    die();
  }

  $quote->id = $data->id;
  $quote->quote = $data->quote;
  $quote->author_id = $data->author_id;
  $quote->category_id = $data->category_id;
  
  $update_result = $quote->update();

  if($update_result === "success") {
    echo json_encode(
      array('id' => $quote->id, 'quote' => $quote->quote, 'author_id' => $quote->author_id, 'category_id' => $quote->category_id)
    );
  }
  else if ($update_result === "aid") {
    echo json_encode(
      array('message' => "author_id Not Found")
    );
  }
  else if ($update_result === "cid") {
    echo json_encode(
      array('message' => "category_id Not Found")
    );
  }
  else {
    echo json_encode(
      array('message' => "No Quotes Found")
    );
  }
