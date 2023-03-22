<?php
  $category->id = isset($_GET['id']) ? $_GET['id'] : die();

  $category->read_single();
  
  if ($category->category === null) {
    echo json_encode(
      array('message' => 'category_id Not Found')
    );
    die();
  }

  $category_arr = array(
    'id' => $category->id,
    'category' => $category->category
  );

  echo json_encode($category_arr);
