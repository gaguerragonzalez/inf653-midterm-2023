<?php
  class Category {
    // connection and table name
    private $conn;
    private $table = 'categories';

    // category properties
    public $id;
    public $category;


    public $name;

    // constructor
    public function __construct($db) {
      $this->conn = $db;
    }

    // read all categories
    public function read() {
      $query = 'SELECT id, category
                FROM ' . $this->table . '
                ORDER BY id';

      $stmt = $this->conn->prepare($query);

      $stmt->execute();

      return $stmt;
    }
  
    // read one category by id
    public function read_single() {
      $query = 'SELECT
            id,
            category
          FROM
            ' . $this->table . '
        WHERE id = :id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$row) {
          return false;
        }

        // set properties
        $this->id = $row['id'];
        $this->category = $row['category'];
    }
    
    // add in category
    public function create() {
      // prepare query
      $query = 'INSERT INTO ' .
        $this->table . '(category)
      VALUES
        (:category)';

      $stmt = $this->conn->prepare($query);
      $this->category = htmlspecialchars(strip_tags($this->category));
      $stmt->bindParam(':category', $this->category);

      // execute query
      if ($stmt->execute()) {
        return $this->conn->lastInsertId();
      }

      printf("error: $s\n", $stmt->error);

      return false;
    }

    // edit category
    public function update() {
      // write and execute query
      $query = 'UPDATE ' .
        $this->table . '
      SET
        category = :category
        WHERE
        id = :id';

      $stmt = $this->conn->prepare($query);
      $this->name = htmlspecialchars(strip_tags($this->category));
      $this->id = htmlspecialchars(strip_tags($this->id));
      $stmt-> bindParam(':category', $this->category);
      $stmt-> bindParam(':id', $this->id);

      $stmt->execute();
      return $stmt->rowCount();
    }

    // delete category
    public function delete() {
      // write and execute query
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
      $stmt = $this->conn->prepare($query);
      $this->id = htmlspecialchars(strip_tags($this->id));
      $stmt-> bindParam(':id', $this->id);
      
      $stmt->execute();
      
      return $stmt->rowCount();
    }
  }
