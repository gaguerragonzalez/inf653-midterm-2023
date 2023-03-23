<?php
  class Author {
    // connection and table name
    private $conn;
    private $table = 'authors';

    // author properties
    public $id;
    public $author;


    public $name;

    // constructor
    public function __construct($db) {
      $this->conn = $db;
    }

    // read all authors
    public function read() {
      $query = 'SELECT id, author
                FROM ' . $this->table . '
                ORDER BY id';

      $stmt = $this->conn->prepare($query);

      $stmt->execute();

      return $stmt;
    }
  
    // read one author by id
    public function read_single() {
      $query = 'SELECT
            id,
            author
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
        $this->author = $row['author'];
    }
    
    // add in author
    public function create() {
      // prepare query
      $query = 'INSERT INTO ' .
        $this->table . '(author)
      VALUES
        (:author)';

      $stmt = $this->conn->prepare($query);
      $this->author = htmlspecialchars(strip_tags($this->author));
      $stmt->bindParam(':author', $this->author);

      // execute query
      if ($stmt->execute()) {
        return $this->conn->lastInsertId();
      }

      printf("error: $s\n", $stmt->error);

      return false;
    }

    // edit author
    public function update() {
      // write and execute query
      $query = 'UPDATE ' .
        $this->table . '
      SET
        author = :author
        WHERE
        id = :id';

      $stmt = $this->conn->prepare($query);
      $this->name = htmlspecialchars(strip_tags($this->author));
      $this->id = htmlspecialchars(strip_tags($this->id));
      $stmt-> bindParam(':author', $this->author);
      $stmt-> bindParam(':id', $this->id);

      if ($stmt->execute()) {
        return true;
      }

      printf("Error: $s.\n", $stmt->error);

      return false;
    }

    // delete author
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
