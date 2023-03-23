<?php
  $quote->id = $_GET['id'];
  $quote->read_by_id();
  
  if ($quote->quote === null) {
    echo json_encode(
      array('message' => 'No Quotes Found')
    );
    die();
  }

  $quote_arr = array(
    'id' => $quote->id,
    'quote' => $quote->quote,
    'author' => $quote->author_name,
    'category' => $quote->category_name
  );

  echo json_encode($quote_arr);
