<?php
  $data = json_decode(file_get_contents("php://input"));
  
  if (!isset($data->quote) || !isset($data->author_id) || !isset($data->category_id)) {
    echo json_encode(
      array('message' => 'Missing Required Parameters')
    );
    die();
  }
  
  $quote->quote = $data->quote;
  $quote->author_id = $data->author_id;
  $quote->category_id = $data->category_id;

  echo json_encode(
    array('id' => $quote->create(), 'quote' => $quote->quote, 'author_id' => $quote->author_id, 'category_id' => $quote->category_id)
  );