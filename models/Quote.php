<?php 
  class Quote {
    private $conn;
    private $table = 'quotes';

    // properties
    public $id;
    public $quote;
    public $author_id;
    public $category_id;

    
    public $name;
    public $author_name;
    public $category_name;

    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Quotes
    public function read() {
      $query = 'SELECT a.author as author_name, c.category as category_name, q.id, q.author_id, q.category_id, q.quote
                FROM ' . $this->table . ' q
                LEFT JOIN
                  authors a ON q.author_id = a.id
                LEFT JOIN
                  categories c ON q.category_id = c.id
                ';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Quote
    public function read_by_id() {
      // Create query
      $query = 'SELECT a.author as author_name, c.category as category_name, q.id, q.author_id, q.category_id, q.quote
      FROM ' . $this->table . ' q
      LEFT JOIN
        authors a ON q.author_id = a.id
      LEFT JOIN
        categories c ON q.category_id = c.id
      WHERE q.id = :id;
      ';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(':id', $this->id);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$row) {
        return false;
      } 

      // Set properties
      $this->quote = $row['quote'];
      $this->author_name = $row['author_name'];
      $this->category_name = $row['category_name'];
    }

    public function read_by_foreign_keys() {
      // Create query
      if ($this->author_id >= 0 && $this->category_id >= 0) {
        $query = 'SELECT a.author as author_name, c.category as category_name, q.id, q.author_id, q.category_id, q.quote
                  FROM ' . $this->table . ' q
                  LEFT JOIN
                    authors a ON q.author_id = a.id
                  LEFT JOIN
                    categories c ON q.category_id = c.id
                  WHERE a.id = :author_id AND c.id = :category_id
        ';
      }
      else if ($this->author_id === -1) {
        $query = 'SELECT a.author as author_name, c.category as category_name, q.id, q.author_id, q.category_id, q.quote
                  FROM ' . $this->table . ' q
                  LEFT JOIN
                    authors a ON q.author_id = a.id
                  LEFT JOIN
                    categories c ON q.category_id = c.id
                  WHERE c.id = :category_id
        ';
      }
      else if ($this->category_id === -1) {
        $query = 'SELECT a.author as author_name, c.category as category_name, q.id, q.author_id, q.category_id, q.quote
                  FROM ' . $this->table . ' q
                  LEFT JOIN
                    authors a ON q.author_id = a.id
                  LEFT JOIN
                    categories c ON q.category_id = c.id
                  WHERE a.id = :author_id
        ';
      }
      

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      if ($this->author_id >= 0) {
        $stmt->bindParam('author_id', $this->author_id);
      }
      if ($this->category_id >= 0) {
        $stmt->bindParam('category_id', $this->category_id);
      }

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Create Post
    public function create() {
      // Create query
      $query = 'INSERT INTO ' . $this->table . '
                (quote, author_id, category_id) 
                VALUES(:quote, :author_id, :category_id)';
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->quote = htmlspecialchars(strip_tags($this->quote));
      $this->author_id = htmlspecialchars(strip_tags($this->author_id));
      $this->category_id = htmlspecialchars(strip_tags($this->category_id));

      // Bind data
      $stmt->bindParam(':quote', $this->quote);
      $stmt->bindParam(':author_id', $this->author_id);
      $stmt->bindParam(':category_id', $this->category_id);

      // Execute query
      if($stmt->execute()) {
        return $this->conn->lastInsertId();
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Post
    public function update() {
      // Create query
      $query = 'UPDATE ' . $this->table . '
                SET quote = :quote, author_id = :author_id, category_id = :category_id
                WHERE id = :id';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->quote = htmlspecialchars(strip_tags($this->quote));
      $this->author_id = htmlspecialchars(strip_tags($this->author_id));
      $this->category_id = htmlspecialchars(strip_tags($this->category_id));
      $this->id = htmlspecialchars(strip_tags($this->id));

      // Bind data
      $stmt->bindParam(':quote', $this->quote);
      $stmt->bindParam(':author_id', $this->author_id);
      $stmt->bindParam(':category_id', $this->category_id);
      $stmt->bindParam(':id', $this->id);

      // Execute query
      $stmt->execute();
      return $stmt->rowCount();
    }

    // Delete Post
    public function delete() {
      // Create query
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->id = htmlspecialchars(strip_tags($this->id));

      // Bind data
      $stmt->bindParam(':id', $this->id);

      // Execute query
      $stmt->execute()

      return $stmt->rowCount();
    }
    
  }