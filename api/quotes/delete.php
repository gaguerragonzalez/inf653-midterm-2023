<?php
  $data = json_decode(file_get_contents("php://input"));

  $quote->id = $data->id;

  // delete category
  if ($quote->delete()) {
    echo json_encode(
      array('id' => $quote->id)
    );
  }
  else {
    echo json_encode(
      array('message' => 'No Quotes Found')
    );
  }
